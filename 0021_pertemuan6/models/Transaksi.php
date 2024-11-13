<?php
class Transaksi {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    public function create($pelanggan_id, $tanggal, $produk_ids, $jumlah) {
        try {
            $this->db->beginTransaction();

            // 1. Insert transaksi utama
            $query = "INSERT INTO transaksi (pelanggan_id, tanggal, total) VALUES (?, ?, 0)";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$pelanggan_id, $tanggal]);
            
            $transaksi_id = $this->db->lastInsertId();
            $total = 0;

            // 2. Insert detail transaksi dan update stok
            $query_detail = "INSERT INTO detail_transaksi (transaksi_id, produk_id, jumlah, harga) VALUES (?, ?, ?, ?)";
            $query_update_stok = "UPDATE produk SET stok = stok - ? WHERE id = ?";
            
            foreach ($produk_ids as $index => $produk_id) {
                // Get product details
                $stmt = $this->db->prepare("SELECT * FROM produk WHERE id = ?");
                $stmt->execute([$produk_id]);
                $produk = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$produk) {
                    throw new Exception("Produk tidak ditemukan!");
                }

                // Calculate subtotal
                $subtotal = $produk['harga'] * $jumlah[$index];
                $total += $subtotal;

                // Insert detail
                $stmt = $this->db->prepare($query_detail);
                $stmt->execute([
                    $transaksi_id,
                    $produk_id,
                    $jumlah[$index],
                    $produk['harga']
                ]);

                // Update stock
                $stmt = $this->db->prepare($query_update_stok);
                $stmt->execute([
                    $jumlah[$index],
                    $produk_id
                ]);
            }

            // 3. Update total transaksi
            $query_update_total = "UPDATE transaksi SET total = ? WHERE id = ?";
            $stmt = $this->db->prepare($query_update_total);
            $stmt->execute([$total, $transaksi_id]);

            $this->db->commit();
            return true;

        } catch (Exception $e) {
            $this->db->rollBack();
            error_log($e->getMessage());
            throw $e;
        }
    }

    // Mendapatkan semua transaksi dengan detail pelanggan
    public function getAll() {
        $query = "SELECT t.*, p.nama as nama_pelanggan, 
                         (SELECT SUM(dt.jumlah * dt.harga) 
                          FROM detail_transaksi dt 
                          WHERE dt.transaksi_id = t.id) as total
                  FROM transaksi t 
                  JOIN pelanggan p ON t.pelanggan_id = p.id 
                  ORDER BY t.tanggal DESC, t.id DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mendapatkan transaksi berdasarkan ID
    public function getById($id) {
        $query = "SELECT t.*, p.nama as nama_pelanggan,
                         (SELECT SUM(dt.jumlah * dt.harga) 
                          FROM detail_transaksi dt 
                          WHERE dt.transaksi_id = t.id) as total
                  FROM transaksi t 
                  JOIN pelanggan p ON t.pelanggan_id = p.id 
                  WHERE t.id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Mendapatkan detail transaksi
    public function getDetailTransaksi($id) {
        $query = "SELECT dt.*, p.nama as nama_produk, p.harga as harga_produk
                  FROM detail_transaksi dt 
                  JOIN produk p ON dt.produk_id = p.id 
                  WHERE dt.transaksi_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Update transaksi
    public function update($id, $data) {
        try {
            $this->db->beginTransaction();

            // Update transaksi utama
            $query = "UPDATE transaksi SET 
                     pelanggan_id = ?,
                     tanggal = ?
                     WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([
                $data['pelanggan_id'],
                $data['tanggal'],
                $id
            ]);

            // Jika ada perubahan detail transaksi
            if (isset($data['detail'])) {
                // Hapus detail lama
                $this->deleteDetailTransaksi($id);

                // Insert detail baru
                $query = "INSERT INTO detail_transaksi (transaksi_id, produk_id, jumlah, harga) 
                         VALUES (?, ?, ?, ?)";
                $stmt = $this->db->prepare($query);

                $total = 0;
                foreach ($data['detail'] as $detail) {
                    $produk = $this->getProductById($detail['produk_id']);
                    $subtotal = $produk['harga'] * $detail['jumlah'];
                    $total += $subtotal;

                    $stmt->execute([
                        $id,
                        $detail['produk_id'],
                        $detail['jumlah'],
                        $produk['harga']
                    ]);
                }

                // Update total
                $query = "UPDATE transaksi SET total = ? WHERE id = ?";
                $stmt = $this->db->prepare($query);
                $stmt->execute([$total, $id]);
            }

            $this->db->commit();
            return true;

        } catch (Exception $e) {
            $this->db->rollBack();
            error_log($e->getMessage());
            return false;
        }
    }

    // Hapus transaksi
    public function delete($id) {
        try {
            $this->db->beginTransaction();

            // Kembalikan stok produk
            $details = $this->getDetailTransaksi($id);
            foreach ($details as $detail) {
                $query = "UPDATE produk 
                         SET stok = stok + ? 
                         WHERE id = ?";
                $stmt = $this->db->prepare($query);
                $stmt->execute([$detail['jumlah'], $detail['produk_id']]);
            }

            // Hapus detail transaksi
            $this->deleteDetailTransaksi($id);

            // Hapus transaksi utama
            $query = "DELETE FROM transaksi WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);

            $this->db->commit();
            return true;

        } catch (Exception $e) {
            $this->db->rollBack();
            error_log($e->getMessage());
            return false;
        }
    }

    // Helper method untuk menghapus detail transaksi
    private function deleteDetailTransaksi($transaksi_id) {
        $query = "DELETE FROM detail_transaksi WHERE transaksi_id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$transaksi_id]);
     }

    // Helper method untuk mendapatkan produk berdasarkan ID
    private function getProductById($id) {
        $query = "SELECT * FROM produk WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
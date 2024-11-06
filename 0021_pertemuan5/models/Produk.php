<?php
class Produk {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM produk");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM produk WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getProductByName($nama) {
        $query = "SELECT * FROM produk WHERE nama = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$nama]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Produk.php
    public function create($nama, $harga, $stok) {
        try {
            $query = "INSERT INTO produk (nama, harga, stok) VALUES (?, ?, ?)";
            $stmt = $this->db->prepare($query);
            
            if (!$stmt) {
                throw new Exception("Error preparing statement");
            }

            $result = $stmt->execute([$nama, $harga, $stok]);
            
            if (!$result) {
                throw new Exception("Gagal menyimpan data");
            }

            return true;

        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            return false;
        }
    }

    public function update($id, $nama, $harga, $stok) {
        try {
            $query = "UPDATE produk SET nama = ?, harga = ?, stok = ? WHERE id = ?";
            $stmt = $this->db->prepare($query);
            return $stmt->execute([$nama, $harga, $stok, $id]);
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            return false;
        }
    }

    public function updateProductStock($id, $additionalStock) {
        $query = "UPDATE produk SET stok = stok + ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$additionalStock, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM produk WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
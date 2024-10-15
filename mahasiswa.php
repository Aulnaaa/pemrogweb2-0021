<?php
class Mahasiswa {
    public $nama;
    public $nim;
    public $fakultas;
    public $ipk;
    public $tahunMasuk;

    public function __construct($nama, $nim, $fakultas, $ipk, $tahunMasuk) {
        $this->nama = $nama;
        $this->nim = $nim;
        $this->fakultas = $fakultas;
        $this->ipk = $ipk;
        $this->tahunMasuk = $tahunMasuk;
    }

    public function tampilkanInfo() {
        echo "Nama: {$this->nama}<br>";
        echo "NIM: {$this->nim}<br>";
        echo "Fakultas: {$this->fakultas}<br>";
        echo "IPK: {$this->ipk}<br>";
        echo "Tahun Masuk: {$this->tahunMasuk}<br>";
    }

    public function statusKelulusan() {
        if ($this->ipk >= 3.0) {
            echo "Status: Lulus dengan prestasi<br>";
        } else {
            echo "Status: Belum lulus<br>";
        }
    }
}
class MahasiswaKIPK extends Mahasiswa {
    public $jurusan;
    public $beasiswa;

    public function __construct($nama, $nim, $fakultas, $jurusan, $beasiswa, $ipk, $tahunMasuk) {
        parent::__construct($nama, $nim, $fakultas, $ipk, $tahunMasuk);
        $this->jurusan = $jurusan;
        $this->beasiswa = $beasiswa;
    }
    public function tampilkanInfo() {
        echo "<b>Mahasiswa KIPK:</b><br>";
        parent::tampilkanInfo();
        echo "Jurusan: {$this->jurusan}<br>";
        echo "Beasiswa: {$this->beasiswa}<br>";
    }
}
class MahasiswaReguler extends Mahasiswa {
    public $programStudi;
    public $biayaKuliah;

    public function __construct($nama, $nim, $fakultas, $programStudi, $biayaKuliah, $ipk, $tahunMasuk) {
        parent::__construct($nama, $nim, $fakultas, $ipk, $tahunMasuk);
        $this->programStudi = $programStudi;
        $this->biayaKuliah = $biayaKuliah;
    }

    public function tampilkanInfo() {
        echo "<b>Mahasiswa Reguler:</b><br>";
        parent::tampilkanInfo();
        echo "Program Studi: {$this->programStudi}<br>";
        echo "Biaya Kuliah: Rp. " . number_format($this->biayaKuliah, 0, ',', '.') . "<br>";
    }
}

$mahasiswaKIPK = new MahasiswaKIPK("Aulnaaa", "60742377", "Fakultas Teknik", "Informatika", "KIPK", 3.5, 2020);
$mahasiswaKIPK->tampilkanInfo();
$mahasiswaKIPK->statusKelulusan();

echo "<br>";

$mahasiswaReguler = new MahasiswaReguler("Sieregar", "85880132", "Fakultas Teknik", "Informatika", 15000000, 3.1, 2019);
$mahasiswaReguler->tampilkanInfo();
$mahasiswaReguler->statusKelulusan();

?>
<?php

class Mobil {
    public $nama;
    public $merk;
    
    public function __construct($nama, $merk) {
        $this->nama = $nama;
        $this->merk = $merk;
    }

    public function tampilkanInfo() {
        echo "Nama Mobil: $this->nama<br>";
        echo "Merk: $this->merk<br>";
    }
}

class MobilSport extends Mobil {
    public $speed;
    public $turbo;
    
    public function __construct($nama, $merk, $speed, $turbo) {
        parent::__construct($nama, $merk);
        $this->speed = $speed;
        $this->turbo = $turbo;
    }
    
    public function tampilkanInfo() {
        echo "<b>Mobil Sport:</b><br>";
        parent::tampilkanInfo();
        echo "Kecepatan: $this->speed km/h<br>";
        echo "Turbo: $this->turbo<br>";
    }
}

class CityCar extends Mobil {
    public $model;
    public $irit;
    public $sensor; 

    public function __construct($nama, $merk, $model, $irit, $sensor) {
        parent::__construct($nama, $merk);
        $this->model = $model;
        $this->irit = $irit;
        $this->sensor = $sensor;
    }
    
    public function tampilkanInfo() {
        echo "<b>City Car:</b><br>";
        parent::tampilkanInfo();
        echo "Model: $this->model<br>";
        echo "Irit: $this->irit<br>";
        echo "Sensor: $this->sensor<br>";
    }
}

$mobilSport = new MobilSport("Porsche", "911", 350, "Yes");
$mobilSport->tampilkanInfo();

echo "<br>";

$cityCar = new CityCar("Honda", "jazz", "2023", "Sangat Irit", "Teratur");
$cityCar->tampilkanInfo();
?>
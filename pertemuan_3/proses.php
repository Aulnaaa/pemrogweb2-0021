<?php
    include 'database.php';
    $db = new Database;
    $aksi = $_GET['aksi'];



    if ($aksi == "tambah") {
        $db->tambahData($_POST['nama'], $_POST['alamat'], $_POST['nohp'],  $_POST['jenis_kelamin'], $_POST['email']);
        header("location:index.php");

    } elseif ($aksi == "update") {
        if ($_FILES['foto']['name'] == '') {
            $existingData = $db->editData($_POST['id']);
            $foto = $existingData[0]['foto'];
        }

        $db->updateData($_POST['id'], $_POST['nama'], $_POST['alamat'], $_POST['nohp'], $foto, $_POST['jenis_kelamin'], $_POST['email']);
        header("location:index.php");

    } elseif ($aksi == "hapus") {
        $db->hapusData($_GET['id']);
        header("location:index.php");
    }
?>
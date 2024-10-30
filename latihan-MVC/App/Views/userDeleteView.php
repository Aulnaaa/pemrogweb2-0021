<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus User</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Apakah Anda yakin ingin menghapus user ini?</h1>
        <p>Nama: <?php echo $user['name']; ?></p>
        <p>Email: <?php echo $user['email']; ?></p>
        <a href="index.php?action=destroy&id=<?php echo $user['id']; ?>" class="btn btn-danger">Hapus</a>
        <a href="index.php?action=index" class="btn btn-secondary">Batal</a>
    </div>
</body>
</html>

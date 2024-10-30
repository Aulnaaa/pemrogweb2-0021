<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail User</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Detail User</h1>
        <p><strong>ID:</strong> <?php echo $user['id']; ?></p>
        <p><strong>Nama:</strong> <?php echo $user['name']; ?></p>
        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
        <a href="index.php" class="btn btn-primary">Kembali</a>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Edit User</h1>
        <form action="index.php?action=update&id=<?php echo $user['id']; ?>" method="post">
            <label>Nama:</label>
            <input type="text" name="name" value="<?php echo $user['name']; ?>" required>
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>

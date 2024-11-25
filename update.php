<?php
require 'db.php';
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $stmt = $pdo->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
    $stmt->execute([$name, $email, $id]);
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Record</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Record</h2>
        <form action="" method="POST">
            <input type="text" name="name" value="<?= htmlspecialchars($user['name']); ?>" required>
            <input type="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" required>
            <button type="submit" name="submit" class="btn">Update</button>
        </form>
        <a href="index.php" class="btn btn-back">Back</a>
    </div>
</body>
</html>

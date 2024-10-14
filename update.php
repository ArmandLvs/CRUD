<?php
include 'db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM inventory WHERE id = ?");
$stmt->execute([$id]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $quantity = (int) $_POST['quantity'];
    $price = (float) $_POST['price'];
    $acquisitiondate = $_POST['acquisitiondate'];

    if (!empty($name) && $quantity > 0 && $price > 0 && !empty($acquisitiondate)) {
        $sql = "UPDATE inventory SET name = ?, quantity = ?, price = ?, AcquisitionDate = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $quantity, $price, $acquisitiondate, $id]);
        header("Location: read.php");
    } else {
        echo "Please fill in all fields with valid data!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Inventory Item</title>
</head>
<body>
    <h1>Edit Item</h1>
    <form method="POST" action="">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?= htmlspecialchars($item['name']) ?>" required><br>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" value="<?= htmlspecialchars($item['quantity']) ?>" required><br>

        <label for="price">Price:</label>
        <input type="number" step="0.01" name="price" id="price" value="<?= htmlspecialchars($item['price']) ?>" required><br>
        <label for="acquisitiondate">Acquisition Date:</label>
        <input type="date" name="acquisitiondate" id="acquisitiondate" value="<?= htmlspecialchars($item['acquisitiondate']) ?>" required><br>
        



        <button type="submit">Update Item</button>
    </form>
</body>
</html>

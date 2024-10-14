<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require 'db.php'; 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = trim($_POST['name']);
    $quantity = (int) $_POST['quantity'];
    $price = (float) $_POST['price'];


    if (!empty($name) && $quantity > 0 && $price > 0) {

        $sql = "INSERT INTO inventory (name, quantity, price) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);


        if ($stmt->execute([$name, $quantity, $price])) {
            header("Location: read.php");
            exit; 
        } else {
            echo "Error occurred while adding the item!";
        }
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
    <title>Add Inventory Item</title>
</head>
<body>
    <h1>Add New Inventory Item</h1>
    <form method="POST" action="">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" required><br>

        <label for="price">Price:</label>
        <input type="number" step="0.01" name="price" id="price" required><br>

        <button type="submit">Add Item</button>
    </form>
</body>
</html>

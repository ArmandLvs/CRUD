<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $quantity = (int) $_POST['quantity'];
    $price = (float) $_POST['price'];

    // Basic input validation
    if (!empty($name) && $quantity > 0 && $price > 0) {
        $sql = "INSERT INTO inventory (name, quantity, price) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $quantity, $price]);
        header("Location: read.php");
        exit;  // Stop the script after redirection
    } else {
        echo "Please fill in all fields with valid data!";
    }
}
?>

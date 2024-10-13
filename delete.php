<?php
include 'db.php';

$id = $_GET['id'];

$sql = "DELETE FROM inventory WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

header("Location: read.php");
?>

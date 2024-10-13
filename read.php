<?php
// Include the database connection file
require 'db.php';

// Fetch all inventory items, including AcquisitionDate
$sql = "SELECT name, quantity, price, AcquisitionDate FROM inventory";
$stmt = $pdo->query($sql);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory List</title>
</head>
<body>
    <h1>Inventory List</h1>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Acquisition Date</th>
        </tr>
        <?php foreach ($items as $item): ?>
        <tr>
            <td><?php echo htmlspecialchars($item['name']); ?></td>
            <td><?php echo htmlspecialchars($item['quantity']); ?></td>
            <td><?php echo htmlspecialchars($item['price']); ?></td>
            <td>
                <?php 
                // Check if AcquisitionDate exists and format it
                if (isset($item['AcquisitionDate'])) {
                    // Convert the date to a more readable format if needed
                    $date = new DateTime($item['AcquisitionDate']);
                    echo htmlspecialchars($date->format('Y-m-d H:i:s'));
                } else {
                    echo 'N/A'; // Default value if the date is not set
                }
                ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

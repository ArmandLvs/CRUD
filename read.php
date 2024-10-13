<?php
include 'db.php';  // Make sure to include db.php at the top

// Fetch all records using PDO
$sql = "SELECT * FROM inventory";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Inventory Management</h1>

    <a href="create.php" class="add-item-btn">Add New Item</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Acquisition Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($items): ?>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['id']) ?></td>
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td><?= htmlspecialchars($item['quantity']) ?></td>
                        <td><?= htmlspecialchars($item['price']) ?></td>
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
                        <td class="actions">
                            <a href="update.php?id=<?= $item['id'] ?>">Edit</a>
                            <a href="delete.php?id=<?= $item['id'] ?>" class="delete" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No items found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>

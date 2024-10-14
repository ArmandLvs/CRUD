<?php
include 'db.php';  // Ensure db.php is included at the top, which initializes $pdo

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
                // Check if AcquisitionDate exists and format it with microseconds if available
                if (isset($item['acquisitiondate'])) {
                    try {
                        // Create a DateTime object from the AcquisitionDate
                        $date = new DateTime($item['acquisitiondate']);
                        // Format the date to display in 'Y-m-d H:i:s' format (without microseconds)
                        echo htmlspecialchars($date->format('Y-m-d H:i:s'));
                    } catch (Exception $e) {
                        echo 'Invalid Date'; // Handle any date parsing exceptions
                    }
                } else {
                    echo 'N/A'; // Default value if the date is not set
                }
                ?>
            </td>
                        <td class="actions">
                            <a href="update.php?id=<?= htmlspecialchars($item['id']) ?>">Edit</a>
                            <a href="delete.php?id=<?= htmlspecialchars($item['id']) ?>" class="delete" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
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

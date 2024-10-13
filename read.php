<?php
include 'db.php';  // Include your database connection

// Fetch all records using PDO
$sql = "SELECT * FROM inventory";
$stmt = $pdo->prepare($sql);  // Use the $pdo connection
$stmt->execute();
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .actions {
            display: flex;
            gap: 10px;
        }
        .actions a {
            text-decoration: none;
            color: white;
            padding: 5px 10px;
            background-color: #007BFF;
            border-radius: 5px;
        }
        .actions a.delete {
            background-color: #DC3545;
        }
        .add-item-btn {
            margin-bottom: 20px;
            display: inline-block;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Inventory Management</h1>
    
    <!-- Button to Add New Item -->
    <a href="create.php" class="add-item-btn">Add New Item</a>

    <!-- Display the Inventory Table -->
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
                <!-- Loop through the fetched items and display each one -->
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['id']) ?></td>
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td><?= htmlspecialchars($item['quantity']) ?></td>
                        <td><?= htmlspecialchars($item['price']) ?></td>
                        <td><?= htmlspecialchars($item['AcquisitionDate']) ?></td>
                        <td class="actions">
                            <!-- Edit and Delete links for each item -->
                            <a href="update.php?id=<?= $item['id'] ?>">Edit</a>
                            <a href="delete.php?id=<?= $item['id'] ?>" class="delete" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Message if no items are found -->
                <tr>
                    <td colspan="6">No items found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>

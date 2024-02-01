

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retrieve Data</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>

<div id="container">
    <h2 style="text-align: center;">Customer Data</h2>


<?php
include 'includes/db_connection.php';

try {
    $conn = connectDB();

    if ($conn) {
        $sql = "SELECT id, name, email FROM users";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>";
        foreach ($result as $row) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td class='action'>
                        <form action='edit.php' method='post'>
                            <input type='hidden' name='edit_id' value='{$row['id']}'>
                            <button type='submit' class='edit-button'>Edit</button>
                        </form>
                        <form action='orders.php' method='post'>
                            <input type='hidden' name='order_id' value='{$row['id']}'>
                            <button type='submit' class='edit-button'>Make an Order</button>
                        </form>
                    </td>
                </tr>";
        }
        echo "</table>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} finally {
    if ($conn) {
        $conn = null;
    }
}
?>


<div class="button-container">
    <a href="insert.php" class="add-button">Add User</a>
    <a href="product.php" class="add-button">Product</a>
    <a href="transaction.php" class="add-button">Transactions</a>
</div>

</div>

</body>
</html>

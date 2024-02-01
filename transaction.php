<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retrieve Products</title>
    <link rel="stylesheet" href="css/transaction.css">
    
</head>
<body>

<div id="container">
    <h2 style="text-align: center;">TRANSACTION</h2>

<?php
include 'includes/db_connection.php';

try {
    $conn = connectDB();

    if ($conn) {
        $sql = "SELECT orders.order_id, products.product_name, users.name, orders.order_date FROM orders 
        INNER JOIN users ON orders.id = users.id
        INNER JOIN products ON orders.product_id = products.product_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<table>
                <tr>
                    <th>Order ID</th>
                    <th>Product Name</th>
                    <th>User Name</th>
                    <th>Order Date</th>
                </tr>";
        foreach ($result as $row) {
            echo "<tr>
                    <td>{$row['order_id']}</td>
                    <td>{$row['product_name']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['order_date']}</td>
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
<button type="button" id="backButton" onclick="goBack()" class="button-style">Back</button>
<a href="index.php" class="add-button">User</a>
</div>

</div>
<script>
    function goBack() {
        window.history.back();
    }
</script>
</body>
</html>

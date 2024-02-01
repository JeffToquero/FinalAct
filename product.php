<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retrieve Products</title>
    <link rel="stylesheet" href="css/product.css">
    
</head>
<body>

<div id="container">
    <h2 style="text-align: center;">Product Data</h2>

<?php
include 'includes/db_connection.php';

try {
    $conn = connectDB();

    if ($conn) {
        $sql = "SELECT product_id, product_name, product_stock FROM products";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<table>
                <tr>
                    <th>Product ID</th>
                    <th>Name</th>
                    <th>Stocks</th>
                    <th>Action</th>
                </tr>";
        foreach ($result as $row) {
            echo "<tr>
                    <td>{$row['product_id']}</td>
                    <td>{$row['product_name']}</td>
                    <td>{$row['product_stock']}</td>
                    <td>
                        <form action='edit_product.php' method='post'>
                            <input type='hidden' name='edit_product_id' value='{$row['product_id']}'>
                            <button type='submit' class='edit-button'>Edit</button>
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
<button type="button" id="backButton" onclick="goBack()">Back</button>
<a href="index.php" class="add-button">User</a>
    <a href="add_product.php" class="add-button">Add Product</a>
</div>

</div>
<script>
    function goBack() {
        window.history.back();
    }
</script>

</body>
</html>

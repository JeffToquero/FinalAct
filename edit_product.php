<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="css/edit_product.css">
</head>
<body>

<div id="container">
    <h2 style="text-align: center;">Edit Product </h2>

    <?php
    include 'includes/db_connection.php';

    try {
        $conn = connectDB();

        if ($conn && isset($_POST['edit_product_id'])) {
            $prodID = $_POST['edit_product_id'];
            $sql = "SELECT product_id, product_name, product_stock FROM products WHERE product_id = :pid";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':pid', $prodID);
            $stmt->execute();

            $userData = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($userData) {
                // User data found, render the edit form
    ?>
                <form action="includes/update_prod.php" method="post">
                    <input type="hidden" name="pid" value="<?php echo $userData['product_id']; ?>">
                    <label for="name">Name:</label>
                    <input type="text" name="pname" id="pname" value="<?php echo $userData['product_name']; ?>">

                    <label for="email">Email:</label>
                    <input type="text" name="pstock" id="pstock" value="<?php echo $userData['product_stock']; ?>">

                    <div class="button-container">
                        <button type="submit" class="update-button">Update Product</button>
                    </div>
                </form>
    <?php
            } else {
                echo "<p>User not found.</p>";
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        if ($conn) {
            $conn = null;
        }
    }
    ?>
</div>

</body>
</html>

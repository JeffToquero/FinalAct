<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="css/orders.css">


</head>
<body>

<div id="container">
    <h2 style="text-align: center;">Orders</h2>

    <?php
    include 'includes/db_connection.php';

    try {
        $conn = connectDB();

        if ($conn && isset($_POST['order_id'])) {
            $userId = $_POST['order_id'];
            $sql = "SELECT id, name, email FROM users WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $userId);
            $stmt->execute();

            $userData = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($userData) {
                ?>
                <form method="post" action="includes/insert_order.php">
                    <label for="customer">Customer's Name:</label>
                    <input type="text" id="customer" name="customer" value="<?php echo $userData['name']; ?>" required readonly>

                    <label for="selectProduct">Select Product:</label>
                    <select name="selectProduct" id="selectProduct">
                        <option value="">Select a Product</option> <!-- Added option for better debugging -->
                        <?php
                        try {
                            $stmt = $conn->query("SELECT * FROM products");
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($result as $row) {
                                $productName = $row['product_name'];
                                echo "<option value='{$row['product_id']}'>$productName</option>";
                            }
                        } catch (PDOException $e) {
                            die("Query failed: " . $e->getMessage());
                        }
                        ?>
                    </select>

                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" required>

                    <button type="submit">Insert</button>
                    <a href="index.php"><button type="button">Users</button></a>
                    <button type="button" id="backButton" onclick="goBack()" class="button-style">Back</button>
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
<script>
    function goBack() {
        window.history.back();
    }
</script>
</body>
</html>

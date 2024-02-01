<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pname = $_POST['product_name'];
    $stock = $_POST['product_stocks'];

    try {
        
        $conn = connectDB();

        
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO products (product_name, product_stock) VALUES (:prod, :sto)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':prod', $pname);
        $stmt->bindParam(':sto', $stock);
        $stmt->execute();

        
        header("Location: ../product.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
       
        if ($conn) {
            $conn = null;
        }
    }
}
?>

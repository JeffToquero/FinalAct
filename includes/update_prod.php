<?php

include 'db_connection.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pid = $_POST["pid"];
    $pname = $_POST["pname"];
    $pstock = $_POST["pstock"];

    try {

        $conn = connectDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE products SET product_name = :pname, product_stock = :pstock WHERE product_id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $pid);
        $stmt->bindParam(':pname', $pname);
        $stmt->bindParam(':pstock', $pstock);

        $stmt->execute();

        header("Location: ../product.php?error=success");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $conn = null;
    }
}
?>

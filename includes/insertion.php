<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];

    try {
       
        $conn = connectDB();

       
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO users (name, email) VALUES (:name, :email)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        header("Location: ../index.php");
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

<?php

include 'db_connection.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];

    try {

        $conn = connectDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);

        $stmt->execute();

        header("Location: ../index.php?error=success");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $conn = null;
    }
}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/insert.css">
</head>
<body>

<div id="container">
    <h2 style="text-align: center;">Add User</h2>

    <form action="includes/insertion.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required>

        <div class="buttons-container">
            <button type="submit" id="insertButton">Insert</button>
            <button type="button" id="backButton" onclick="goBack()">Back</button>
        </div>
    </form>
</div>

<script>
    function goBack() {
        window.history.back();
    }
</script>

</body>
</html>

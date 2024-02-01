<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="css/add_product.css">
    
</head>
<body>

<div id="container">
    <h2 style="text-align: center;">Add Product</h2>

    <form action="includes/insert_prod.php" method="post">
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" id="product_name" required>

        <label for="product_stocks">Stocks:</label>
        <input type="number" name="product_stocks" id="product_stocks" required>

        <div class="button-container">
            <button type="submit">Add Product</button>
        </div>
    </form>

    <div class="button-container">
        <a href="product.php">Back to Product List</a>
    </div>
</div>

</body>
</html>

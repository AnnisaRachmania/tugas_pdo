<?php 
    include('connecttodatabase.php');

    // Mendapatkan daftar product
    $sql_product = "SELECT productCode, productName FROM products";
    $stmt_product = $koneksi->prepare($sql_product);
    $stmt_product->execute();
    $result_product = $stmt_product->fetchAll(PDO::FETCH_ASSOC);

    // Mendapatkan daftar productLine
    $sql_productline = "SELECT productLine FROM productlines";
    $stmt_productline = $koneksi->prepare($sql_productline);
    $stmt_productline->execute();
    $result_productline = $stmt_productline->fetchAll(PDO::FETCH_ASSOC);

    // Memperbarui data produk
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $productCode= $_POST["productCode"];
        $productName = $_POST["productName"];
        $productLine = $_POST["productLine"];
        $productScale = $_POST["productScale"];
        $productVendor = $_POST["productVendor"];
        $productDescription = $_POST["productDescription"];
        $quantityInStock = $_POST["quantityInStock"];
        $buyPrice = $_POST["buyPrice"];
        $MSRP = $_POST["MSRP"];

        $sql_update = "UPDATE products SET productName= :productName, productLine = :productLine, productScale = :productScale, productVendor= :productVendor, 
                    productDescription= :productDescription, quantityInStock= :quantityInStock, buyPrice= :buyPrice, MSRP= :MSRP WHERE productCode = :productCode";
        
        $stmt_update = $koneksi->prepare($sql_update);
        $stmt_update->bindParam(':productName', $productName);
        $stmt_update->bindParam(':productLine', $productLine);
        $stmt_update->bindParam(':productScale', $productScale);
        $stmt_update->bindParam(':productVendor', $productVendor);
        $stmt_update->bindParam(':productDescription', $productDescription);
        $stmt_update->bindParam(':quantityInStock', $quantityInStock);
        $stmt_update->bindParam(':buyPrice', $buyPrice);
        $stmt_update->bindParam(':MSRP', $MSRP);
        $stmt_update->bindParam(':productCode', $productCode);
        
        $stmt_update->execute();

        echo "<b>-Data produk berhasil diperbarui-</b>";
    }
?>

<html>
    <head>
        <title>update produk</title>
        <link rel="stylesheet" href="insert_customer_style.css">
    </head>
    <body>
        <div class="menu">
            <ul class="ul-menu">
                <li class="li-menu">
                    <a href="index.php" class="a-menu"><?php echo"Home"?></a></li>
                <li class="li-menu">
                    <a href="select_customer.php" class="a-menu" ><?php echo"Customers Data"?></a> </li>
                <li class="li-menu">
                    <a href="select_product.php" class="a-menu" ><?php echo"Products Data"?></a></li>
                <li class="li-menu">
                    <a href="insert_customers.php" class="a-menu" ><?php echo"Insert Customer"?></a></li>
                <li class="li-menu">
                    <a href="insert_product.php" class="a-menu" ><?php echo"Insert Product"?></a></li>
            </ul>
        </div><br>
        <h2>Update Produk</h2><br>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="productCode">Product Code:</label>
        <select name="productCode">
            <?php foreach ($result_product as $row_product) { ?>
                <option value="<?php echo $row_product['productCode']; ?>">
                    <?php echo $row_product['productCode'] . " : " . $row_product['productName']; ?>
                </option>
            <?php } ?>
        </select>
        <br><br>
        <label>Product Name:</label><br>
            <input type="text" name="productName"><br><br>
        <label>Product Line:</label><br>
            <select name="productLine">
                <?php foreach ($result_productline as $row_productline) { ?>
                    <option value="<?php echo $row_productline['productLine']; ?>">
                        <?php echo $row_productline['productLine']; ?>
                    </option>
                <?php } ?>
            </select><br><br>
        <label>Product Scale:</label><br>
            <input type="text" name="productScale"><br><br>
        <label>Product Vendor:</label><br>
            <input type="text" name="productVendor"><br><br>
        <label>Product Description:</label><br>
            <input type="textarea" name="productDescription"><br><br>
        <label>Quantity In Stock:</label><br>
            <input type="number" name="quantityInStock"><br><br>
        <label>Buy Price:</label><br>
            <input type="text" name="buyPrice"><br><br>
        <label>MSRP:</label><br>
            <input type="text" name="MSRP"><br><br>

    <input type="submit" value="Update"><br>
    </form>
    </body>
</html>
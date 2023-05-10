<?php
    include ("connecttodatabase.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <center><h2>Insert Product</h2></center>

    <?php
        $stmt = $koneksi->prepare("SELECT productLine FROM productlines");
        $stmt->execute();
        $productlines = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Mendapatkan nilai dari form
            $productCode= $_POST["productCode"];
            $productName = $_POST["productName"];
            $productLine = $_POST["productLine"];
            $productScale = $_POST["productScale"];
            $productVendor = $_POST["productVendor"];
            $productDescription = $_POST["productDescription"];
            $quantityInStock = $_POST["quantityInStock"];
            $buyPrice = $_POST["buyPrice"];
            $MSRP = $_POST["MSRP"];
    
            // Menyiapkan pernyataan INSERT
            $stmt = $koneksi->prepare("INSERT INTO products (productCode, productName, productLine, productScale, productVendor, 
            productDescription, quantityInStock, buyPrice, MSRP) 
            VALUES (:productCode, :productName, :productLine, :productScale, :productVendor, :productDescription, :quantityInStock, :buyPrice, :MSRP)");
            $stmt->bindParam(':productCode', $productCode);
            $stmt->bindParam(':productName', $productName);
            $stmt->bindParam(':productLine', $productLine);
            $stmt->bindParam(':productScale', $productScale);
            $stmt->bindParam(':productVendor', $productVendor);
            $stmt->bindParam(':productDescription', $productDescription);
            $stmt->bindParam(':quantityInStock', $quantityInStock);
            $stmt->bindParam(':buyPrice', $buyPrice);
            $stmt->bindParam(':MSRP', $MSRP);
    
            // Mengeksekusi pernyataan INSERT
            $stmt->execute();
    
            echo "<b>-Data berhasil disimpan-</b>";
        }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <br><label>Product Code:</label><br>
            <input type="text" name="productCode"><br><br>
        <label>Product Name:</label><br>
            <input type="text" name="productName"><br><br>
        <label>Product Line:</label><br>
            <select name="productLine">
                <?php foreach ($productlines as $productline) { ?>
                    <option value="<?php echo $productline['productLine']; ?>">
                        <?php echo $productline['productLine']; ?>
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

    <input type="submit" value="Submit"><br>
    </form>
</body>
</html>
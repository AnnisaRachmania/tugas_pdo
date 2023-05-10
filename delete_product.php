<?php 
    include("connecttodatabase.php");

    // Mendapatkan daftar product
    $sql_product = "SELECT productCode, productName FROM products";
    $stmt_product = $koneksi->prepare($sql_product);
    $stmt_product->execute();
    $result_product = $stmt_product->fetchAll(PDO::FETCH_ASSOC);

    // Memperbarui data produk
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $productCode= $_POST["productCode"];

        $sql_delete = "DELETE FROM products WHERE productCode = :productCode";
        $stmt_delete = $koneksi->prepare($sql_delete);
        $stmt_delete->bindParam(':productCode', $productCode);
        $stmt_delete->execute();

        echo "<b>-Data produk berhasil dihapus-</b>";
    }
?>

<html>
    <head>
        <title>delete produk</title>
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
        <h2>Delete Produk</h2><br>

        <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?> ">
            <label for="productCode">Product Code:</label>
            <select name="productCode">
                <?php foreach ($result_product as $row_product) { ?>
                    <option value="<?php echo $row_product['productCode']; ?>">
                        <?php echo $row_product['productCode'] . " : " . $row_product['productName']; ?>
                    </option>
                <?php } ?>
            </select>
            <br><br>
            <input type="submit" value="Delete">
        </form>     
    </body>
</html>
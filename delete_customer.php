<?php 
    include('connecttodatabase.php');

    // Mendapatkan daftar customer
    $sql_customer = "SELECT customerNumber, customerName FROM customers";
    $stmt_customer = $koneksi->prepare($sql_customer);
    $stmt_customer->execute();
    $result_customer = $stmt_customer->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $customerNumber = $_POST["customerNumber"];

        $sql_delete = "DELETE FROM customers WHERE customerNumber = :customerNumber";
        $stmt_delete = $koneksi->prepare($sql_delete);
        $stmt_delete->bindParam(':customerNumber', $customerNumber);
        $stmt_delete->execute();

        echo "<b>-Data pelanggan berhasil dihapus-</b>";
    }
?>

<html>
    <head>
        <title>delete customer</title>
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
        <h2>Delete Customer</h2><br>
    
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
            <label for="customerNumber">Customer Number:</label>
            <select name="customerNumber">
                <?php foreach ($result_customer as $row_customer) { ?>
                    <option value="<?php echo $row_customer['customerNumber']; ?>">
                        <?php echo $row_customer['customerNumber'] . " - " . $row_customer['customerName']; ?>
                    </option>
                <?php } ?>
            </select>
            <br><br>
            <input type="submit" value="Delete">
        </form>
    </body>
</html>
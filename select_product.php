<?php
    include("connecttodatabase.php");

    $query = "SELECT * FROM products";
    $stmt = $koneksi->prepare($query);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Select product</title>
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
    <center><h2>Product List</h2></center><br>
    <table border="2">
        <thead>
            <tr>
                <th>Product Code</th>
                <th>Product Name</th>
                <th>Product Line</th>
                <th>Product Scale</th>
                <th>Product Vendor</th>
                <th>Product Description</th>
                <th>Quantity In Stock</th>
                <th>Buy Price</th>
                <th>MSRP</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product) { ?>
                <tr>
                    <td><?php echo $product['productCode']; ?></td>
                    <td><?php echo $product['productName']; ?></td>
                    <td><?php echo $product['productLine']; ?></td>
                    <td><?php echo $product['productScale']; ?></td>
                    <td><?php echo $product['productVendor']; ?></td>
                    <td><?php echo $product['productDescription'];?></td>
                    <td><?php echo $product['quantityInStock'];?></td>
                    <td><?php echo $product['buyPrice'];?></td>
                    <td><?php echo $product['MSRP'];?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
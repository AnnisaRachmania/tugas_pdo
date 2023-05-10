<?php
    include("connecttodatabase.php");

    $query = "SELECT * FROM customers";
    $stmt = $koneksi->prepare($query);
    $stmt->execute();
    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Select Customer</title>
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
    <center><h2>Customer List</h2></center><br>
    <table border="2">
        <thead>
            <tr>
                <th>Customer Number</th>
                <th>Customer Name</th>
                <th>Contact Last Name</th>
                <th>Contact First Name</th>
                <th>Phone</th>
                <th>Address Line 1</th>
                <th>Address Line 2</th>
                <th>City</th>
                <th>State</th>
                <th>Postal Code</th>
                <th>Country</th>
                <th>Sales Rep Employee Number</th>
                <th>Credit Limit</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer) { ?>
                <tr>
                    <td><?php echo $customer['customerNumber']; ?></td>
                    <td><?php echo $customer['customerName']; ?></td>
                    <td><?php echo $customer['contactLastName']; ?></td>
                    <td><?php echo $customer['contactFirstName']; ?></td>
                    <td><?php echo $customer['phone']; ?></td>
                    <td><?php echo $customer['addressLine1'];?></td>
                    <td><?php echo $customer['addressLine2'];?></td>
                    <td><?php echo $customer['city'];?></td>
                    <td><?php echo $customer['state'];?></td>
                    <td><?php echo $customer['postalCode'];?></td>
                    <td><?php echo $customer['country'];?></td>
                    <td><?php echo $customer['salesRepEmployeeNumber'];?></td>
                    <td><?php echo $customer['creditLimit'];?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
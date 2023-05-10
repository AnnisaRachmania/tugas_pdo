<?php
    include('connecttodatabase.php');

    // Mendapatkan daftar customer
    $sql_customer = "SELECT customerNumber, customerName FROM customers";
    $stmt_customer = $koneksi->prepare($sql_customer);
    $stmt_customer->execute();
    $result_customer = $stmt_customer->fetchAll(PDO::FETCH_ASSOC);

    // Mendapatkan daftar sales rep employee
    $sql_employee = "SELECT employeeNumber, lastName FROM employees WHERE jobTitle = 'Sales Rep'";
    $stmt_employee = $koneksi->prepare($sql_employee);
    $stmt_employee->execute();
    $result_employee = $stmt_employee->fetchAll(PDO::FETCH_ASSOC);

    // Memperbarui data pelanggan
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $customerNumber = $_POST["customerNumber"];
        $customerName = $_POST["customerName"];
        $contactLastName = $_POST["contactLastName"];
        $contactFirstName = $_POST["contactFirstName"];
        $phone = $_POST["phone"];
        $addressLine1 = $_POST["addressLine1"];
        $addressLine2 = $_POST["addressLine2"];
        $city = $_POST["city"];
        $state = $_POST["state"];
        $postalCode = $_POST["postalCode"];
        $country = $_POST["country"];
        $creditLimit = $_POST['creditLimit'];
        $salesRepEmployee = $_POST["salesRepEmployee"];

        $sql_update = "UPDATE customers SET customerName= :customerName, contactLastName = :contactLastName, contactFirstName = :contactFirstName, phone= :phone, 
                    addressLine1= :addressLine1, addressLine2= :addressLine2, city= :city, state= :state, postalCode= :postalCode,
                    country= :country, creditLimit= :creditLimit, salesRepEmployeeNumber = :salesRepEmployee WHERE customerNumber = :customerNumber";
        $stmt_update = $koneksi->prepare($sql_update);
        $stmt_update->bindParam(':customerName', $customerName);
        $stmt_update->bindParam(':contactLastName', $contactLastName);
        $stmt_update->bindParam(':contactFirstName', $contactFirstName);
        $stmt_update->bindParam(':phone', $phone);
        $stmt_update->bindParam(':addressLine1', $addressLine1);
        $stmt_update->bindParam(':addressLine2', $addressLine2);
        $stmt_update->bindParam(':city', $city);
        $stmt_update->bindParam(':state', $state);
        $stmt_update->bindParam(':postalCode', $postalCode);
        $stmt_update->bindParam(':country', $country);
        $stmt_update->bindParam(':creditLimit', $creditLimit);
        $stmt_update->bindParam(':salesRepEmployee', $salesRepEmployee);
        $stmt_update->bindParam(':customerNumber', $customerNumber);
        $stmt_update->execute();

        echo "<b>-Data pelanggan berhasil diperbarui-</b>";
    }
?>

<html>
<head>
    <title>Update Customer</title>
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
    <h2>Update Customer</h2><br>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="customerNumber">Customer Number:</label>
        <select name="customerNumber">
            <?php foreach ($result_customer as $row_customer) { ?>
                <option value="<?php echo $row_customer['customerNumber']; ?>">
                    <?php echo $row_customer['customerNumber'] . " - " . $row_customer['customerName']; ?>
                </option>
            <?php } ?>
        </select>
        <br><br>
        <label>Customer Name:</label>  <br>
            <input type="text" name="customerName"><br><br>
        <label> Contact Last Name:</label> <br>
            <input type="text" name="contactLastName"><br><br>
        <label>Contact First Name:</label>  <br>
            <input type="text" name="contactFirstName"><br><br> 
        <label>  Phone:</label> <br>
            <input type="number" name="phone"><br><br>
        <label>Address Line 1:</label>  <br>
            <input type="textarea" name="addressLine1"><br><br>
        <label> Address Line 2:</label> <br>
            <input type="textarea" name="addressLine2"><br><br>
        <label> City:</label>  <br>
            <input type="text" name="city"><br><br>
        <label> State:</label>  <br>
            <input type="text" name="state"><br><br>
        <label> Postal Code:</label>  <br>
            <input type="number" name="postalCode"><br><br>
        <label> Country:</label>  <br>
            <input type="text" name="country"><br><br>
        <label for="salesRepEmployee">Sales Rep Employee:</label>
        <select name="salesRepEmployee">
            <?php foreach ($result_employee as $row_employee) { ?>
                <option value="<?php echo $row_employee['employeeNumber']; ?>">
                    <?php echo $row_employee['employeeNumber'] . " - " . $row_employee['lastName']; ?>
                </option>
            <?php } ?>
        </select>
        <br><br>
        <label> Credit Limit: </label><br>
            <input type="text" name="creditLimit"><br><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>


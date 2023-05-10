<?php
    include ('connecttodatabase.php');
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
    <center><h2>Insert Data Customer</h2></center>

    <?php
    // Mendapatkan daftar salesRepEmployeeNumber dari database employees
    $salesReps = $koneksi->query("SELECT employeeNumber, CONCAT(firstName, ' ', lastName) AS fullName FROM employees WHERE jobTitle = 'Sales Rep'")->fetchAll(PDO::FETCH_ASSOC);

    // Mengecek apakah form sudah disubmit atau belum 
    

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Menyimpan data dari form
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
        $salesRepEmployeeNumber = $_POST["salesRepEmployeeNumber"];
    
        // Query untuk memasukkan data baru ke tabel customer di database
        $sql = "INSERT INTO customers (customerNumber, customerName, contactLastName, contactFirstName, phone, addressLine1, addressLine2, city, state, postalCode, country, salesRepEmployeeNumber, creditLimit) 
                VALUES (:customerNumber, :customerName, :contactLastName, :contactFirstName, :phone, :addressLine1, :addressLine2, :city, :state, :postalCode, :country, :salesRepEmployeeNumber, :creditLimit)";

        $stmt = $koneksi->prepare($sql);
        $stmt->bindParam(':customerNumber', $customerNumber);
        $stmt->bindParam(':customerName', $customerName);
        $stmt->bindParam(':contactLastName', $contactLastName);
        $stmt->bindParam(':contactFirstName', $contactFirstName);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':addressLine1', $addressLine1);
        $stmt->bindParam(':addressLine2', $addressLine2);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':state', $state);
        $stmt->bindParam(':postalCode', $postalCode);
        $stmt->bindParam(':country', $country);
        $stmt->bindParam(':salesRepEmployeeNumber', $salesRepEmployeeNumber);
        $stmt->bindParam(':creditLimit', $creditLimit);

        $stmt->execute();

        echo "<b>-Data customer berhasil ditambahkan-<b>";

    }?>

    <!-- Form memasukkan data baru -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

       <br> <label> Customer Number:</label> <br>
            <input type="number" name="customerNumber"><br><br>
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
        <label>  Sales Rep Employee Number:  </label>
            <br><select name="salesRepEmployeeNumber">
            <?php foreach ($salesReps as $salesRep) { ?>
                <option value="<?php echo $salesRep['employeeNumber']; ?>">
                    <?php echo $salesRep['fullName']; ?>
                </option>
            <?php } ?>   
            </select><br><br>
        <label> Credit Limit: </label><br>
            <input type="text" name="creditLimit"><br><br>
    <input type="submit" value="Submit"><br>
    </form>

</body>
</html>
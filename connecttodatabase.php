<?php

    $host = "localhost"; 
    $user = "root";
    $pass = ""; 
    $dbname = "classicmodels"; 

    try{
        $koneksi = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $err){
         die("Koneksi gagal: " . mysqli_connect_error());
    }

?>
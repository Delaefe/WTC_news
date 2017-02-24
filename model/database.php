<?php

$dsn = 'mysql:host=localhost;dbname=dfh_wtc';
$username = 'root';
$password = '';


try {

    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "it worked!";

    error_reporting(E_ALL);
} catch (Exception $ex) {
    
    $error_message = $ex->getMessage();
    echo $error_message;
    include('databse_error.php');
    exit();
}
?>
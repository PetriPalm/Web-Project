<?php 

$email = isset($_POST["email"]) ? $_POST["email"]: "";
$password = isset($_POST["psw"]) ? $_POST["psw"]: "";

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

try {
    $yhteys=mysqli_connect("");
}
 
catch(Exception $e){
    header ("Location:..");
    exit;
}

if (!empty($email) && !empty($password)) {




}













?>
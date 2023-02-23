<?php 
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try{
    $connection=mysqli_connect("db", "root", "password", "register");
}
catch(Exception $e){
    header("Location:../html/yhteysvirhe.html");
    exit;
}
if  (empty($email))||(empty($password)){
    header("Location:../contactpage.html");
    exit;
}
$email = isset($_POST["email"]) ? $_POST["email"]: "";
$password = isset($_POST["psw"]) ? $_POST["psw"]: "";

$sql="insert into account (email, psw,) values(?, ?)";
$stmt=mysqli_prepare($connection, $sql);
mysqli_stmt_bind_param($stmt, 'ss', $email, $psw );
    $connection=mysqli_connect("");
    $database=mysqli_select();
    mysqli_stmt_execute($stmt);
    mysqli_close($connection);

catch(Exception $e){
    header ("Location:..");
    exit;
}














?>
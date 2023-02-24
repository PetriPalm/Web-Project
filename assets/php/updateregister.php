<?php
//Tiedot lomakkeelta jos tiedot on annettu
$email = isset($_POST["email"]) ? $_POST["email"]: "";
$password = isset($_POST["psw"]) ? $_POST["psw"]: "";

//Jos tietoja ei ole, ohjataan käyttäjä antamaan ne
if (empty($email) || empty($password)){
    header("Location:./savereregister.php");
    exit;
}

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

try{
    $yhteys=mysqli_connect("db", "root", "password", "register");
}
catch(Exception $e){
    header("Location:..connectionerror.html");
    exit;
}

$sql="update account set email=?, psw=? where id=?";

$stmt=mysqli_prepare($yhteys, $sql);
mysqli_stmt_bind_param($stmt, 'ss', $email, $password);
mysqli_stmt_execute($stmt);
//Yhteyden sulku
mysqli_close($yhteys);

header("Location:./saveregister.php");
?>
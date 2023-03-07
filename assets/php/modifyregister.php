<?php
$muokattava=isset($_GET["email"]) ? $_GET["psw"] : "";

if (empty($muokattava)){
    header("Location:./register.php");
    exit;
}
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
try{
    $yhteys=mysqli_connect("db", "root", "password", "register");
}
catch(Exception $e){
    header("Location:../html/connectionerror.html");
    exit;
}
$sql="select * from reservation where id=?";
$stmt=mysqli_prepare($yhteys, $sql);

mysqli_stmt_bind_param($stmt, 'i', $muokattava);

mysqli_stmt_execute($stmt);

$tulos=mysqli_stmt_get_result($stmt);
if (!$rivi=mysqli_fetch_object($tulos)){
    header("Location:../html/connectionerror.html");
    exit;
}
?>

<form action='./updateregister.php' method='post'>
id:<input type='text' name='id' value='<?php print $rivi->id;?>' readonly><br>
Email:<input type='text' name='email' value='<?php print $rivi->email;?>'><br>
psw:<input type='text' name='psw' value='<?php print $rivi->password;?>'><br>
<input type='submit' name='ok' value='ok'><br>
</form>

<?php
//Yhteys suljetaan
mysqli_close($yhteys);
?>
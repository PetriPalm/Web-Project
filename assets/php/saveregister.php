<?php

$email = isset($_POST["email"]) ? $_POST["email"]: "";
$password = isset($_POST["psw"]) ? $_POST["psw"]: "";

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

try{
    $yhteys=mysqli_connect("db", "root", "password", "register");
}
catch(Exception $e){
    header("Location:..connectionerror.html");
    exit;
}

//Tiedot lomakkeelta jos ne on annettu.Jos tietoja ei ole annettu ->
if  (!empty($email) && !empty($password) ){
    $sql = "insert into account (email, psw) values(?, ?)";
    $stmt = mysqli_prepare($yhteys, $sql);
    //Muuttujat paikoilleen
    mysqli_stmt_bind_param($stmt, 'ss', $email, $password);
    mysqli_stmt_execute($stmt);
    header("Location:../Index.html");
    exit;  
}
print "<table border='1'>";
$tulos=mysqli_query($yhteys, "select * from account");
while ($rivi=mysqli_fetch_object($tulos)){
    print "<tr><td>$rivi->email <td>$rivi->psw".
    "<td><a href='./deleteregistration.php?poistettava=$rivi->id'>Poista</a>".
    "<td><a href='./modifyregister.php?muokattava=$rivi->id'>Muokkaa</a>";
}
print "</table>";
//Yhteyden sulku
mysqli_close($yhteys);
?>
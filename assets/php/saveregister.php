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

//Luetaan lomakkeelta tulleet tiedot funktiolla $_POST
//jos syötteet ovat olemassa
//$date=isset($_POST["date"]) ? $_POST["date"] : "";
//$fname=isset($_POST["name"]) ? $_POST["name"] : "";
//$email=isset($_POST["email"]) ? $_POST["email"] : "";
//$details=isset($_POST["details"]) ? $_POST["details"] :"";

//Jos ei jompaa kumpaa tai kumpaakaan tietoa ole annettu
//ohjataan pyyntö takaisin lomakkeelle
if  (!empty($email) && !empty($password) ){
    $sql = "insert into account (email, psw) values(?, ?)";
    //Valmistellaan sql-lause
    $stmt = mysqli_prepare($yhteys, $sql);
    //Sijoitetaan muuttujat oikeisiin paikkoihin
    mysqli_stmt_bind_param($stmt, 'ss', $email, $password);
    //Suoritetaan sql-lause
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
//Suljetaan tietokantayhteys
mysqli_close($yhteys);
?>
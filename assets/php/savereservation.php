<?php

$date=isset($_POST["date"]) ? $_POST["date"] : "";
$fname=isset($_POST["name"]) ? $_POST["name"] : "";
$email=isset($_POST["email"]) ? $_POST["email"] : "";
$details=isset($_POST["details"]) ? $_POST["details"] :"";

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
if  (!empty($date) && !empty($fname) && !empty($email) && !empty($details) ){
    $sql = "insert into reservation (date, name, email, details) values(?, ?, ?, ?)";
    //Valmistellaan sql-lause
    $stmt = mysqli_prepare($yhteys, $sql);
    //Sijoitetaan muuttujat oikeisiin paikkoihin
    mysqli_stmt_bind_param($stmt, 'isss', $date, $fname, $email, $details);
    //Suoritetaan sql-lause
    mysqli_stmt_execute($stmt);
    header("Location:../contactpage.html");
    exit;  
}
print "<table border='1'>";
$tulos=mysqli_query($yhteys, "select * from reservation");
while ($rivi=mysqli_fetch_object($tulos)){
    print "<tr><td>$rivi->date <td>$rivi->fname <td>$rivi->email <td>$rivi->details".
    "<td><a href='./deletereservation.php?poistettava=$rivi->id'>Poista</a>".
    "<td><a href='./modifyreservation.php?muokattava=$rivi->id'>Muokkaa</a>";
}
print "</table>";
//Suljetaan tietokantayhteys
mysqli_close($yhteys);
?>
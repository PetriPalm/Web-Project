<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try{
    $yhteys=mysqli_connect("db", "pena", "kukkuu", "spawn");
}
catch(Exception $e){
    header("Location:../html/yhteysvirhe.html");
    exit;
}

//Luetaan lomakkeelta tulleet tiedot funktiolla $_POST
//jos syötteet ovat olemassa
$date=isset($_POST["date"]) ? $_POST["date"] : "";
$fname=isset($_POST["name"]) ? $_POST["name"] : "";
$email=isset($_POST["email"]) ? $_POST["email"] : "";
$details=isset($_POST["details"]) ? $_POST["details"] :"";

//Jos ei jompaa kumpaa tai kumpaakaan tietoa ole annettu
//ohjataan pyyntö takaisin lomakkeelle
if  (empty($date))||(empty($fname) || empty($email)|| empty($details) ){
    header("Location:../contactpage.html");
    exit;
}

//Tehdään sql-lause, jossa kysymysmerkeillä osoitetaan paikat
//joihin laitetaan muuttujien arvoja
$sql="insert into reservation (date, name, email, details) values(?, ?, ?, ?)";

//Valmistellaan sql-lause
$stmt=mysqli_prepare($yhteys, $sql);
//Sijoitetaan muuttujat oikeisiin paikkoihin
mysqli_stmt_bind_param($stmt, 'isss', $date, $fname, $email, $details);
//Suoritetaan sql-lause
mysqli_stmt_execute($stmt);
//Suljetaan tietokantayhteys
mysqli_close($yhteys);
?>
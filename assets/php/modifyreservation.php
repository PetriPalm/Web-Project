<?php
$muokattava=isset($_GET["muokattava"]) ? $_GET["muokattava"] : "";

//Palataan listaukseen jos tietoja ei ole annettu
if (empty($muokattava)){
    header("Location:./savereservation.php");
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
$sql="select * from reservation where id=?";
$stmt=mysqli_prepare($yhteys, $sql);
//Sijoitetaan muuttuja sql-lauseeseen
mysqli_stmt_bind_param($stmt, 'i', $muokattava);
//Suoritetaan sql-lause
mysqli_stmt_execute($stmt);
//Koska luetaan prepared statementilla, tulos haetaan 
//metodilla mysqli_stmt_get_result($stmt);
$tulos=mysqli_stmt_get_result($stmt);
if (!$rivi=mysqli_fetch_object($tulos)){
    header("Location:../html/connectionerror.html");
    exit;
}
?>
<!-- Lomake on tavallista HTML-koodia PHP:n ulkopuolella -->
<!-- Lomake sisältää php-osuuksia, joilla tulostetaan syötekenttiin luetun tietueen tiedot -->
<!-- id-kenttä on readonly, koska sitä ei muuteta -->

<form action='./updatereservation.php' method='post'>
id:<input type='text' name='id' value='<?php print $rivi->id;?>' readonly><br>
Date:<input type='' name='date' value='<?php print $rivi->date;?>'><br>
Full name:<input type='text' name='full name' value='<?php print $rivi->fname;?>'><br>
Email:<input type='text' name='email' value='<?php print $rivi->email;?>'><br>
Details:<input type='text' name='details' value='<?php print $rivi->details;?>'><br>
<input type='submit' name='ok' value='ok'><br>
</form>

<?php
//Suljetaan tietokantayhteys
mysqli_close($yhteys);
?>
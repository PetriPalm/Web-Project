<?php
    mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
    try{
        $yhteys=mysqli_connect("db", "root", "password", "register");
    }
    catch(Exception $e){
        header("Location:..connectionerror.html");
        exit;
    }
$poistettava = isset($_GET["poistettava"]) ? $_GET["poistettava"] : "";
if (!empty($poistettava)){
    $sql="delete from account where id=?";
        $stmt=mysqli_prepare($yhteys, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $poistettava);
        //Suoritetaan sql-lause
        mysqli_stmt_execute($stmt);
    exit;
}
    //Suljetaan tietokantayhteys
    mysqli_close($yhteys);
    header("Location:saveregister.php");
    exit;
    ?>
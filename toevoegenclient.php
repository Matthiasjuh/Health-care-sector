<?php
session_start();
include ("./include/db.php");
$conn=fnConndb();

if ($_POST['submit']) {
    $wachtwoord = $_POST['clientwachtwoord'];
    $emailadres = $_POST['clientemailadres'];
    $voornaam = $_POST['clientvoornaam'];
    $achternaam = $_POST['clientachternaam'];
    $woonplaats = $_POST['clientwoonplaats'];
    $straatnaam = $_POST['clientstraatnaam'];
    $huisnummer = $_POST['clienthuisnummer'];
    $bloegroep = $_POST['clientbloedgroep'];
    $bsnnummer = $_POST['clientbsnnummer'];
    $allergieen = $_POST['clientallergieen'];
    $huisarts = $_POST['clienthuisarts'];
    $verzekeraar = $_POST['clientverzekeraar'];

    $query = "INSERT INTO client
              (wachtwoord, emailadres, voornaam, achternaam, woonplaats, straatnaam, 
              huisnummer, bloedgroep, bsnnummer, allergieen, huisarts, verzekeraar)
              VALUES('" . $wachtwoord . "', '" . $emailadres . "', '" . $voornaam . "', '" . $achternaam . "', '" . $woonplaats . "', '" . $straatnaam . "', 
              '" . $huisnummer . "', '" . $bloegroep . "', '" . $bsnnummer . "', '" . $allergieen . "', '" . $huisarts . "', '" . $verzekeraar . "');";
    $query2 = "SELECT emailadres FROM client WHERE emailadres='" . $emailadres . "'";


    $qryresult = mysqli_query($conn, $query2);
    $controle = mysqli_num_rows($qryresult);

    if ($controle == 0) {

        $result = mysqli_query($conn, $query);

        if ($result) {
            mysqli_error($conn);
            $_SESSION['melding1'] = "De gebruiker is succesvol toegevoegd";
            header("refresh:0; url=clientdossier.php");
        } else {
            mysqli_error($conn);
            $_SESSION['melding2'] = "Gebruiker kan niet worden toegevoegd, probeer het opnieuw";
            header("refresh:0; url=clientdossier.php");
        }
    }
    else {
        $_SESSION['melding3'] = "Het opgegeven e-mailadres is in gebruik, probeer het opnieuw";
        header("refresh:0; url=clientdossier.php");
    }
}
else {
    header('refresh: 0; url=clientdossier.php');
}

?>
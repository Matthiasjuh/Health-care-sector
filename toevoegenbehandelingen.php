<?php
session_start();
include ("./include/db.php");
$conn=fnConndb();

if (isset($_POST['submit'])) {
    $naam = $_POST['naam'];
    $tijd = $_POST['tijd'];
    $prijs = $_POST['prijs'];

    $query = "INSERT INTO behandelingen(naam, tijdsduur, prijs) 
              VALUES('".$naam."','".$tijd."', '".$prijs."');";
    $query2 = "SELECT naam FROM behandelingen WHERE naam='" .$naam. "'";


    $qryresult = mysqli_query($conn, $query2);
    $controle = mysqli_num_rows($qryresult);

    if ($controle == 0) {

        $result = mysqli_query($conn, $query);

        if ($result) {
            mysqli_error($conn);
            $_SESSION['melding1'] = "De behandeling is succesvol toegevoegd";
        } else {
            mysqli_error($conn);
            $_SESSION['melding2'] = "behandeling kan niet worden toegevoegd, probeer het opnieuw";
        }
    }
    else {
        $_SESSION['melding3'] = "De opgegeven melding is al geregistreerd";
        header("refresh:0; url=clientdossier.php");
    }

    header('refresh: 0; url=behandelingen.php');
}
else {
    header('refresh: 0; url=behandelingen.php');
}

?>
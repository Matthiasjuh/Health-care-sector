<?php
session_start();
include ("./include/db.php");
$conn = fnConndb();

if ($_POST['submit']) {

    $client = $_POST['client'];
    $behandeling = $_POST['behandeling'];
    $datum = $_POST['datum'];
    $tijd = $_POST['tijd'];

    if (isset($_POST['opmerkingen'])) {
        $opmerkingen = $_POST['opmerkingen'];
    }
    else {
        $opmerkingen = "N.v.t";
    }


    // Huisarts/verzekeraar word automatisch opgehaald door middel van het clienten ID
    $_SESSION['id2'] = $client;

    $query3 = "SELECT huisarts, verzekeraar, ID FROM client WHERE ID='".$_SESSION['id2']."';";
    $query3result = mysqli_query($conn, $query3);
    $result3 = mysqli_fetch_array($query3result);

    $huisarts = $result3['huisarts'];
    $verzekeraar = $result3['verzekeraar'];


    // Ziekenhuis word automatisch toegewezen doordat het ziekenhuis-id van de ziekenhuisspecialist word gebruikt
    $query7 = "SELECT ziekenhuis FROM ziekenhuisspecialist WHERE ID='".$_SESSION['ID']."';";
    $query7result = mysqli_query($conn, $query7);

    $resultquery7 = mysqli_fetch_array($query7result);
    $ziekenhuis = $resultquery7['ziekenhuis'];

    $status = "Ongefactureerd";



    $query = "INSERT INTO afspraken (behandeling, datum, tijd, client, huisarts, verzekeraar, ziekenhuis, opmerkingen, status)
          VALUES ('".$behandeling."', '".$datum."', '".$tijd."', '".$client."', '".$huisarts."', '".$verzekeraar."', '".$ziekenhuis."', '".$opmerkingen."', '".$status."')";

    $result=mysqli_query($conn, $query);

    if ($result) {
        mysqli_error($conn);
        $_SESSION['melding1'] = "De afspraak is succesvol aangemaakt";
    }
    else {
        mysqli_error($conn);
        $_SESSION['melding2'] = "Afspraak aanmaken mislukt, probeer het opnieuw";
    }
    header('refresh: 0; url=agenda.php');
}

else {
    header('refresh: 0; url=agenda.php');
}

?>
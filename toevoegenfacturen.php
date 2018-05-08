<?php
session_start();
include("./include/db.php");
$conn = fnConndb();

if (isset($_GET['ID'])) {

    $ID = $_GET['ID'];

    $query = "SELECT client, verzekeraar, behandeling, datum
              FROM afspraken
              WHERE ID=".$ID.";";

    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);

    $client = $row['client'];
    $verzekeraar = $row['verzekeraar'];
    $behandeling = $row['behandeling'];
    $afspraakdatum = $row['datum'];
    $facturatiedatum = date('Y-m-d');

    $query2 = "INSERT INTO facturen(client, verzekeraar, behandeling, afspraakdatum, facturatiedatum)
               VALUES (".$client.", ".$verzekeraar.", ".$behandeling.", ".$afspraakdatum.", ".$facturatiedatum.")";

    $result2 = mysqli_query($conn, $query2);

    if ($result2) {
        mysqli_error($conn);
        $_SESSION['melding1'] = "Er is succesvol gefactureerd";
    }
    else  {
        mysqli_error($conn);
        $_SESSION['melding2'] = "Het factureren is fout gegaan, probeer het opnieuw";
    }

    $query3 = "
            UPDATE afspraken
            SET status = 'Gefactureerd'
            WHERE ID = ".$ID.";
    ";
    $result3 = mysqli_query($conn, $query3);

    header('refresh:0; url=agenda.php');
}

else {
    header('refresh:0; url=agenda.php');
}

?>
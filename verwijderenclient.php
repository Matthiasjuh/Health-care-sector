<?php
session_start();
include('./include/db.php');
$conn=fnConndb();

if ($_POST['submit']) {
    $query1="DELETE FROM client WHERE ID='".$_SESSION['clientID']."'";
    $result=mysqli_query($conn, $query1);

    if ($result) {
        mysqli_error($conn);
        $_SESSION['melding1'] = "De gebruiker is succesvol verwijderd";
        header("refresh:0; url=clientdossier.php");
    }
    else {
        mysqli_error($conn);
        $_SESSION['melding2'] = "Verwijderen mislukt, probeer het opnieuw";
        header("refresh:0; url=clientdossier.php");
    }
}
else {
    header('refresh: 0; url=clientdossier.php');
}
?>
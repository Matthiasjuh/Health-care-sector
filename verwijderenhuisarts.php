<?php
session_start();
include('./include/db.php');
$conn=fnConndb();

if ($_POST['submit']) {
    $query1="DELETE FROM huisarts WHERE ID='".$_SESSION['huisartsID']."'";
    $result=mysqli_query($conn, $query1);

    if ($result) {
        mysqli_error($conn);
        $_SESSION['melding1'] = "De huisarts is succesvol verwijderd";
        header("refresh:0; url=huisartsen.php");
    }
    else {
        mysqli_error($conn);
        $_SESSION['melding2'] = "Verwijderen mislukt, probeer het opnieuw";
        header("refresh:0; url=huisartsen.php");
    }
}
else {
    header('refresh: 0; url=clientdossier.php');
}
?>
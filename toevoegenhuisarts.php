<?php
session_start();
include('./include/db.php');
$conn = fnConndb();

$voornaam = $_POST['artsvoornaam'];
$achternaam = $_POST['artsachternaam'];
$emailadres = $_POST['artsemailadres'];
$woonplaats = $_POST['artswoonplaats'];
$adres = $_POST['artsadres'];
$telefoonnummer = $_POST['artstelefoonnummer'];
$wachtwoord = $_POST['artswachtwoord'];

if (isset($_POST['submit'])) {

    $query1 = "INSERT INTO huisarts(voornaam, achternaam, emailadres, woonplaats, adres, telefoonnummer, wachtwoord)
           VALUES('".$voornaam."', '".$achternaam."', '".$emailadres."', '".$woonplaats."', '".$adres."', '".$telefoonnummer."', '".$wachtwoord."')";
    $query2 = "SELECT emailadres FROM huisarts WHERE emailadres='".$emailadres."'";


    $result2 = mysqli_query($conn, $query2);
    $row = mysqli_num_rows($result2);

    if ($row == 0) {
        $result1 = mysqli_query($conn, $query1);

            if ($result1) {
                mysqli_error($conn);
                $_SESSION['melding1'] = "De gebruiker is succesvol toegevoegd";
            }
            else {
                mysqli_error($conn);
                $_SESSION['melding2'] = "Gebruiker kan niet worden toegevoegd, probeer het opnieuw";
            }

        header('refresh:0; url=huisartsen.php');
    }

    else {
            $_SESSION['melding3'] = "Het opgegeven e-mailadres is in gebruik, probeer het opnieuw";
        header('refresh:0; url=huisartsen.php');
    }
}

else {
    header('refresh:0; url=huisartsen.php');
}
?>
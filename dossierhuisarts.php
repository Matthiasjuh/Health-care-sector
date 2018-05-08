<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8" />
    <title> MediCure | Cliëntendossiers </title>
    <link rel="stylesheet" href="./main.css" media="screen" />
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

    <script type="text/javascript" src="main.js"></script>
</head>

<body>
<?php
session_start();
include('include/db.php');
$conn=fnConndb();
?>
<div class="achtergrond_overlay">
    <header class="header"> <!-- HEADER -->
        <a class="goback" href="huisartsen.php"></a>
        <h2 class="ingelogd_als">Ingelogd als: <?php echo $_SESSION['rol']; ?> </h2>
        <h1>Huisarts gegevens</h1>
        <img class="main_logo" src="./Images/Logo.svg">
    </header>

    <section class="section"> <!-- SECTION -->
        <?php

        if (isset($_SESSION['huisartsID'])) {

            $query1="
                SELECT *  
                FROM huisarts
                WHERE ID='".$_SESSION['huisartsID']."';";

            $result1=mysqli_query($conn, $query1);
            $row1=mysqli_fetch_array($result1);

            $naam= $row1['voornaam']. " " .$row1['achternaam'];
            $woonplaats= $row1['woonplaats'];
            $adres = $row1['adres'];
            $emailadres = $row1['emailadres'];
            $telefoonnummer = $row1['telefoonnummer'];
            $wachtwoord = $row1['wachtwoord'];
        }

        ?>

        <h2 class="dossier_title">Persoonlijke gegevens</h2>
        <table class="table3">
            <tr>
                <td class="table3_title">Naam:</td>
                <td><?php echo $naam; ?></td>
            </tr>
            <tr>
                <td class="table3_title">Woonplaats:</td>
                <td><?php echo $woonplaats; ?></td>
            </tr>
            <tr>
                <td class="table3_title">Adres:</td>
                <td><?php echo $adres; ?></td>
            </tr>
            <tr>
                <td class="table3_title">Bloedgroep:</td>
                <td><?php echo $telefoonnummer; ?></td>
            </tr>
        </table>
        <h2 class="dossier_title">Accountgegevens</h2>
        <table class="table3">
            <tr>
                <td class="table3_title">E-mailadres</td>
                <td><?php echo $emailadres; ?></td>
            </tr>
            <tr>
                <td class="table3_title">Wachtwoord</td>
                <td><?php echo $wachtwoord; ?></td>
            </tr>
        </table><br/>

        <a class="verwijderen" onclick="openModal();">Verwijder gebruiker</a>

        <div id="myModal" class="modal"><!-- POP-UP -->
            <div class="modal-content" id="size2" style="width: 350px">
                <div class="close cursor" onclick="closeModal()">&times;</div>
                <p>Weet u zeker dat u deze cliënt wilt verwijderen? Alle gegevens gaan hierbij verloren.</p>
                <form action="./verwijderenhuisarts.php" method="POST">
                    <input class="submit1" type="submit" name="submit" value="Bevestigen">
                </form>
            </div>
        </div>
    </section>

    <footer class="footer"> <!-- FOOTER -->
        <p>© Copyright 2018 MediCure</p>
    </footer>
</div>
</body>
</html>

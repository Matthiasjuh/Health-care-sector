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
        <a class="goback" href="clientdossier.php"></a>
        <h2 class="ingelogd_als">Ingelogd als: <?php echo $_SESSION['rol']; ?> </h2>
        <h1>Cliëntdossier</h1>
        <img class="main_logo" src="./Images/Logo.svg">
    </header>

    <section class="section"> <!-- SECTION -->
            <?php

            if (isset($_GET['Id']))
            {
                $_SESSION['clientID'] = $_GET['Id'];

                $query1="
                SELECT *  
                FROM client
                WHERE ID='".$_SESSION['clientID']."';";

                $result1=mysqli_query($conn, $query1);
                $row1=mysqli_fetch_array($result1);

                $naam= $row1['voornaam']. " " .$row1['achternaam'];
                $woonplaats= $row1['woonplaats'];
                $adres = $row1['straatnaam']. " " .$row1['huisnummer'];
                $bloedgroep = $row1['bloedgroep'];
                $bsnnummer = $row1['bsnnummer'];
                $allergieen = $row1['allergieen'];
                $emailadres = $row1['emailadres'];
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
                <td><?php echo $bloedgroep; ?></td>
            </tr>
            <tr>
                <td class="table3_title">BSN-nummer:</td>
                <td><?php echo $bsnnummer; ?></td>
            </tr>
            <tr>
                <td class="table3_title">Allergieën:</td>
                <td>
                    <?php
                    if ($allergieen=="") {
                        echo "N.v.t";
                    }
                    else {
                        echo $allergieen;
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="table3_title">Huisarts:</td>
                <td>
                    <?php
                    $query2="SELECT client.huisarts, client.ID, huisarts.ID, huisarts.voornaam, huisarts.achternaam
                            FROM huisarts 
                            INNER JOIN client ON huisarts.ID = client.huisarts
                            WHERE client.ID='".$_SESSION['clientID']."';";

                    $result2=mysqli_query($conn, $query2);
                    $row2=mysqli_fetch_array($result2);

                    $firstletter = substr($row2['voornaam'], 0, 1);
                    echo $firstletter.". ".$row2['achternaam'];
                    ?>
                </td>
            </tr>
            <tr>
                <td class="table3_title">Verzekeraar:</td>
                <td>
                    <?php
                    $query3="SELECT client.verzekeraar, client.ID, verzekeraar.ID, verzekeraar.voornaam, verzekeraar.achternaam 
                            FROM verzekeraar 
                            INNER JOIN client ON verzekeraar.ID = client.verzekeraar
                            WHERE client.ID='".$_SESSION['clientID']."';";

                    $result3=mysqli_query($conn, $query3);
                    $row3=mysqli_fetch_array($result3);

                    $firstletter2 = substr($row3['voornaam'], 0, 1);
                    echo $firstletter2.". ".$row3['achternaam'];
                    ?>
                </td>
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
                <form action="./verwijderenclient.php" method="POST">
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

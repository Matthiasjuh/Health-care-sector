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
        <a class="goback" href="dashboard.php"></a>
        <h2 class="ingelogd_als">Ingelogd als: <?php echo $_SESSION['rol']; ?> </h2>
        <h1>Cliëntdossiers</h1>
        <h3 class="text_left">Hieronder vind u de dossiers van al uw cliënten</h3>
        <?php
        if (isset($_SESSION['melding1'])) {
            echo "<p class='foutmelding1'>".$_SESSION['melding1']."</p>";
            unset($_SESSION['melding1']);
        }
        if (isset($_SESSION['melding2'])) {
            echo "<p class='foutmelding2'>".$_SESSION['melding2']."</p>";
            unset($_SESSION['melding2']);
        }
        if (isset($_SESSION['melding3'])) {
            echo "<p class='foutmelding2'>".$_SESSION['melding3']."</p>";
            unset($_SESSION['melding3']);
        }
        ?>
        <img class="main_logo" src="./Images/Logo.svg">
    </header>

    <section class="section"> <!-- SECTION -->

        <div id="myModal" class="modal"><!-- POP-UP -->
            <div class="modal-content" id="size2">
                <div class="close cursor" onclick="closeModal()">&times;</div>
                <h3>Cliënt toevoegen</h3>
                <form action="toevoegenclient.php" method="POST">
                    <table class="pop-up_table">
                        <tr class="pop-up_name">
                            <td>Voornaam:*</td> <!-- Voornaam -->
                        </tr>
                        <tr class="pop-up_name2">
                            <td><input type="text" name="clientvoornaam" placeholder="Voer een voornaam in..."></td>
                        </tr>
                        <tr class="pop-up_name">
                            <td>Achternaam:*</td> <!-- Achternaam -->
                        </tr>
                        <tr class="pop-up_name2">
                            <td><input type="text" name="clientachternaam" placeholder="Voer een achternaam in..."></td>
                        </tr>
                        <tr class="pop-up_name">
                            <td>Email-adres:*</td> <!-- Emailadres -->
                        </tr>
                        <tr class="pop-up_name2">
                            <td><input type="text" name="clientemailadres" placeholder="Voer een E-mailadres in..."></td>
                        </tr>
                        <tr class="pop-up_name">
                            <td>Woonplaats:*</td> <!-- Woonplaats -->
                        </tr>
                        <tr class="pop-up_name2">
                            <td><input type="text" name="clientwoonplaats" placeholder="Voer een plaatsnaam in..."></td>
                        </tr>
                        <tr class="pop-up_name">
                            <td>Straatnaam:*</td> <!-- Straatnaam -->
                        </tr>
                        <tr class="pop-up_name2">
                            <td><input type="text" name="clientstraatnaam" placeholder="Voer een straatnaam in..."></td>
                        </tr>
                        <tr class="pop-up_name">
                            <td>Huisnummer:*</td> <!-- Huisnummer -->
                        </tr>
                        <tr class="pop-up_name2">
                            <td><input type="text" name="clienthuisnummer" placeholder="Voer een huisnummer in..."></td>
                        </tr>
                    </table>
                    <table class="pop-up_table">
                        <tr class="pop-up_name">
                            <td>Bloedgroep:*</td> <!-- Bloedgroep -->
                        </tr>
                        <tr class="pop-up_name2">
                            <td><input type="text" name="clientbloedgroep" placeholder="Voer een bloedgroep in..."></td>
                        </tr>
                        <tr class="pop-up_name">
                            <td>BSN-nummer:*</td> <!-- BSN-nummer -->
                        </tr>
                        <tr class="pop-up_name2">
                            <td><input type="text" name="clientbsnnummer" placeholder="Voer een BSN-nummer in..."></td>
                        </tr>
                        <tr class="pop-up_name">
                            <td>Allergieën:*</td> <!-- Allergieën-->
                        </tr>
                        <tr class="pop-up_name2">
                            <td><input type="text" name="clientallergieen" placeholder="Voer een allergie in..."></td>
                        </tr>

                        <?php

                        if ($_SESSION['rol']=="huisarts")
                        {

                            echo '
                                <tr class="pop-up_name">
                                    <td>Verzekeraar:*</td> <!-- Verzekeraar-->
                                </tr>
                                <tr class="pop-up_name2">
                                    <td>
                                        <select name="clientverzekeraar">
                                                ';
                            $query="SELECT voornaam, achternaam, ID FROM verzekeraar ORDER BY ID";
                            $result=mysqli_query($conn, $query);

                            while ($row = mysqli_fetch_array($result)) {
                                $voornaam = substr($row['voornaam'], 0, 1);
                                $naam = $voornaam. ". " .$row['achternaam'];
                                echo '<option value="'.$row["ID"].'">'.$naam.'</option>';
                            }
                            echo '
                                        </select>
                                    </td>
                                    <input type="hidden" name="clienthuisarts" value="'.$_SESSION["ID"].'">
                                </tr>
                                ';
                        }


                        else if ($_SESSION['rol']=="verzekeraar")
                        {
                            echo '
                                <tr class="pop-up_name">
                                    <td>Huisarts:*</td> <!-- Huisarts-->
                                </tr>
                                <tr class="pop-up_name2">
                                    <td>
                                        <select name="clienthuisarts">
                                                ';
                            $query="SELECT voornaam, achternaam, ID FROM huisarts ORDER BY ID";
                            $result=mysqli_query($conn, $query);

                            while ($row = mysqli_fetch_array($result)) {
                                $voornaam = substr($row['voornaam'], 0, 1);
                                $naam = $voornaam. ". " .$row['achternaam'];
                                echo '<option value="'.$row['ID'].'">'.$naam.'</option>';
                            }
                            echo '
                                        </select>
                                    </td>
                                    <input type="hidden" name="clientverzekeraar" value="'.$_SESSION["ID"].'">
                                </tr>';
                        }


                        else
                        {
                            echo '
                                <tr class="pop-up_name">
                                    <td>Huisarts:*</td> <!-- Huisarts-->
                                </tr>
                                <tr class="pop-up_name2">
                                    <td>
                                        <select name="clienthuisarts">
                                                ';
                            $query="SELECT voornaam, achternaam, ID FROM huisarts ORDER BY ID";
                            $result=mysqli_query($conn, $query);

                            while ($row=mysqli_fetch_array($result)) {
                                $voornaam = substr($row['voornaam'], 0, 1);
                                $naam = $voornaam. ". " .$row['achternaam'];
                                echo '<option value="'.$row["ID"].'">'.$naam.'</option>';
                            }
                            echo '
                                        </select>
                                    </td>
                                </tr>

                                <tr class="pop-up_name">
                                    <td>Verzekeraar:*</td> <!-- Verzekeraar-->
                                </tr>
                                <tr class="pop-up_name2">
                                    <td>
                                        <select name="clienthuisarts">
                                ';
                            $query="SELECT voornaam, achternaam, ID FROM verzekeraar ORDER BY ID";
                            $result2=mysqli_query($conn, $query);

                            while ($row2=mysqli_fetch_array($result2)) {
                                $voornaam2 = substr($row2['voornaam'], 0, 1);
                                $naam2 = $voornaam2. ". " .$row2['achternaam'];
                                echo '<option value="'.$row2["ID"].'">'.$naam2.'</option>';
                            }
                            echo '
                                        </select>
                                    </td>
                                </tr>';
                        }
                        ?>

                        <tr class="pop-up_name">
                            <td>Wachtwoord</td>
                        </tr>
                        <tr class="pop-up_name2">
                            <td><input type="password" name="clientwachtwoord" placeholder="Stel een wachtwoord in..."></td>
                        </tr>

                    </table>
                    <div class="submitspecial">
                        <input class="submit1" type="submit" name="submit" value="Bevestigen">
                    </div>
                </form>
            </div>
        </div>

        <div class="cliënten">


            <?php
            $conn=fnConndb();
            $query="SELECT client.voornaam, client.Id AS CLIENTID, client.achternaam, client.".$_SESSION['rol'].", ".$_SESSION['rol'].".ID 
                    FROM ".$_SESSION['rol']."
                    INNER JOIN client ON client.".$_SESSION['rol']." = ".$_SESSION['rol'].".ID
                    WHERE ".$_SESSION['rol'].".ID='".$_SESSION['ID']."'";

            $result=mysqli_query($conn, $query);


            while ($row=mysqli_fetch_array($result))
            {
                echo "
                <a class='cliënt' href='dossier.php?Id=".$row['CLIENTID']."'>
                    <div class='cliënt_picture'></div>
                    <p class='cliënt_name'>".$row['voornaam']." ".$row['achternaam']."</p>
                </a>
                ";
            }
            ?>



            <div class="cliënt">
                <a onclick="openModal();currentSlide(1)">
                    <div class="cliënt_picture_special"></div>
                    <p class="cliënt_name">Cliënt toevoegen</p>
                </a>
            </div>
        </div>
    </section>

    <footer class="footer"> <!-- FOOTER -->
        <p>© Copyright 2018 MediCure</p>
    </footer>
</div>
</body>
</html>
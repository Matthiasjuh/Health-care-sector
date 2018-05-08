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
        <h1>Huisartsen</h1>
        <h3 class="text_left">Hieronder vind u een overzicht van alle huisartsen</h3>
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
                <h3>Huisarts toevoegen</h3>
                <form action="toevoegenhuisarts.php" method="POST">
                    <table class="pop-up_table">
                        <tr class="pop-up_name">
                            <td>Voornaam:*</td> <!-- Voornaam -->
                        </tr>
                        <tr class="pop-up_name2">
                            <td><input type="text" name="artsvoornaam" placeholder="Voer een voornaam in..."></td>
                        </tr>
                        <tr class="pop-up_name">
                            <td>Achternaam:*</td> <!-- Achternaam -->
                        </tr>
                        <tr class="pop-up_name2">
                            <td><input type="text" name="artsachternaam" placeholder="Voer een achternaam in..."></td>
                        </tr>
                        <tr class="pop-up_name">
                            <td>Email-adres:*</td> <!-- Emailadres -->
                        </tr>
                        <tr class="pop-up_name2">
                            <td><input type="text" name="artsemailadres" placeholder="Voer een e-mailadres in..."></td>
                        </tr>
                        <tr class="pop-up_name">
                            <td>Woonplaats:*</td> <!-- Woonplaats -->
                        </tr>
                        <tr class="pop-up_name2">
                            <td><input type="text" name="artswoonplaats" placeholder="Voer een plaatsnaam in..."></td>
                        </tr>
                        <tr class="pop-up_name">
                            <td>Adres:*</td> <!-- Adres -->
                        </tr>
                        <tr class="pop-up_name2">
                            <td><input type="text" name="artsadres" placeholder="Voer een adres in..."></td>
                        </tr>
                    </table>
                    <table class="pop-up_table">
                        <tr class="pop-up_name">
                            <td>Telefoonnummer:*</td> <!-- Telefoonnummer -->
                        </tr>
                        <tr class="pop-up_name2">
                            <td><input type="text" name="artstelefoonnummer" placeholder="Voer een telefoonnummer in..."></td>
                        </tr>
                        <tr class="pop-up_name">
                            <td>Wachtwoord:*</td> <!-- Wachtwoord -->
                        </tr>
                        <tr class="pop-up_name2">
                            <td><input type="text" name="artswachtwoord" placeholder="Voer een wachtwoord in..."></td>
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
            $query="SELECT voornaam, achternaam, ID FROM huisarts";

            $result=mysqli_query($conn, $query);


            while ($row=mysqli_fetch_array($result))
            {
                $_SESSION['huisartsID'] = $row['ID'];
                echo "
                <a class='cliënt' href='dossierhuisarts.php?ID=".$_SESSION['huisartsID']."'>
                    <div class='cliënt_picture'></div>
                    <p class='cliënt_name'>".$row['voornaam']." ".$row['achternaam']."</p>
                </a>
                ";
            }
            ?>



            <div class="cliënt">
                <a onclick="openModal();currentSlide(1)">
                    <div class="cliënt_picture_special"></div>
                    <p class="cliënt_name">Huisarts toevoegen</p>
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

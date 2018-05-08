<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8" />
    <title> MediCure | Dashboard </title>
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
            $query="
                SELECT ID, voornaam, achternaam  
                FROM " .$_SESSION['rol']. " 
                WHERE emailadres='" .$_SESSION['email']."';";

            $result=mysqli_query($conn, $query);

            $aantal=mysqli_num_rows($result);

            if ($aantal==1) {
                $id=mysqli_fetch_array($result);
                $_SESSION['ID']=$id['ID'];
                $_SESSION['naam']=$id['voornaam']." ".$id['achternaam'];
            }

?>
<div class="achtergrond_overlay">
    <header class="header"> <!-- HEADER -->
        <h2>Ingelogd als: <?php echo $_SESSION['rol']; ?></h2>
        <h1>Dashboard</h1>
        <h3 class="text_left">Welkom <?php echo $_SESSION['naam']; ?></h3>
        <hp class="text_left">Maak hieronder de keuze wat u wilt doen</hp>
        <img class="main_logo" src="./Images/Logo.svg">
    </header>

    <section class="section" style="text-align: center"> <!-- SECTION -->

        <?php

        switch ($_SESSION['rol']) {

            case 'client':
                echo '
        <a class="dashboard_keuzeblok" href="agenda.php"><!-- Afspraken (cliënt) -->
            <div class="dashboard_image" id="afbeelding5"></div>
            <p class="dashboard_text">Uw afspraken</p>
            <div class="dashboard_overlay">
                <p class="dashboard_text2">Open uw afspraken lijst</p>
            </div>
        </a>
        <a class="dashboard_keuzeblok" href="klant_dossier.php"><!-- Dossier (cliënt) -->
            <div class="dashboard_image" id="afbeelding4"></div>
            <p class="dashboard_text">Uw dossier</p>
            <div class="dashboard_overlay">
                <p class="dashboard_text2">Open uw dossier</p>
            </div>
        </a>
        ';
                break;

            case 'huisarts':
                echo '
                <a class="dashboard_keuzeblok" href="behandelingen.php"><!-- Behandelingen -->
                    <div class="dashboard_image" id="afbeelding2"></div>
                    <p class="dashboard_text">Behandelingen</p>
                    <div class="dashboard_overlay">
                        <p class="dashboard_text2">Open het behandelingen venster</p>
                    </div>
                </a>
                <a class="dashboard_keuzeblok" href="agenda.php"><!-- Agenda -->
                    <div class="dashboard_image" id="afbeelding3"></div>
                    <p class="dashboard_text">Agenda</p>
                    <div class="dashboard_overlay">
                        <p class="dashboard_text2">Open de agenda</p>
                    </div>
                </a>
                <a class="dashboard_keuzeblok" href="clientdossier.php"><!-- Cliëntendossiers -->
                    <div class="dashboard_image" id="afbeelding4"></div>
                    <p class="dashboard_text">Cliëntendossiers</p>
                    <div class="dashboard_overlay">
                        <p class="dashboard_text2">Open het dossier venster</p>
                    </div>
                </a>
                 ';
                break;


            case 'verzekeraar':
                echo '
                    <a class="dashboard_keuzeblok" href="facturatiescherm.php"><!-- Facturatie -->
                        <div class="dashboard_image" id="afbeelding1"></div>
                        <p class="dashboard_text">Facturen</p>
                        <div class="dashboard_overlay">
                            <p class="dashboard_text2">Open het facturatie venster</p>
                        </div>
                    </a>
                    <a class="dashboard_keuzeblok" href="clientdossier.php"><!-- Cliëntendossiers -->
                        <div class="dashboard_image" id="afbeelding4"></div>
                        <p class="dashboard_text">Cliëntendossiers</p>
                        <div class="dashboard_overlay">
                            <p class="dashboard_text2">Open het dossier venster</p>
                        </div>
                    </a>
                    <a class="dashboard_keuzeblok" href="agenda.php"><!-- Agenda -->
                        <div class="dashboard_image" id="afbeelding3"></div>
                        <p class="dashboard_text">Agenda</p>
                        <div class="dashboard_overlay">
                            <p class="dashboard_text2">Open de agenda</p>
                        </div>
                    </a>
                    <a class="dashboard_keuzeblok" href="huisartsen.php"><!-- Huisartsen overzicht -->
                        <div class="dashboard_image" id="afbeelding4"></div>
                        <p class="dashboard_text">Huisartsen</p>
                        <div class="dashboard_overlay">
                            <p class="dashboard_text2">Open het huisartsen overzicht</p>
                        </div>
                    </a>';
                break;


            case 'ziekenhuisspecialist':
                    echo '
                    <a class="dashboard_keuzeblok" href="behandelingen.php"><!-- Behandelingen -->
                        <div class="dashboard_image" id="afbeelding2"></div>
                        <p class="dashboard_text">Behandelingen</p>
                        <div class="dashboard_overlay">
                            <p class="dashboard_text2">Open het behandelingen venster</p>
                        </div>
                    </a>
                    <a class="dashboard_keuzeblok" href="agenda.php"><!-- Agenda -->
                        <div class="dashboard_image" id="afbeelding3"></div>
                        <p class="dashboard_text">Agenda</p>
                        <div class="dashboard_overlay">
                            <p class="dashboard_text2">Open de agenda</p>
                        </div>
                    </a>
                    ';
                break;

            case 'verzekeraar':

                break;


            default :
                echo '<p style="text-align: left">Geen informatie beschikbaar</p>';
        }
        ?>
    </section>

    <footer class="footer"> <!-- FOOTER -->
        <p>© Copyright 2018 MediCure</p>
    </footer>
</div>
</body>
</html>
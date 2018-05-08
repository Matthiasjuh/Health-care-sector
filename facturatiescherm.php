<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8" />
    <title> MediCure | Facturatie </title>
    <link rel="stylesheet" href="./main.css" media="screen" />
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

    <script type="text/javascript" src="main.js"></script>
</head>

<body>
<?php
session_start();
include("./include/db.php");
$conn = fnConndb();
?>
<div class="achtergrond_overlay">
    <header class="header"> <!-- HEADER -->
        <a class="goback" href="dashboard.php"></a>
        <h2 class="ingelogd_als">Ingelogd als: <?php echo $_SESSION['rol']; ?></h2>
        <h1>Facturen</h1>
        <h3 class="text_left">Hieronder vind u een overzicht van al uw gemaakte facturen</h3>
        <img class="main_logo" src="./Images/Logo.svg">
    </header>

    <section class="section"> <!-- SECTION -->

        <div style="overflow-x:auto;" class="table_div">
            <table class="table2">

                <tr>
                    <th>Cliëntnaam:</th>
                    <th>Behandeling:</th>
                    <th>Verzekeraar:</th>
                    <th>Gefactureerd op:</th>
                    <th>Open pdf</th>
                </tr>
                    <?php

                    $query = "SELECT facturatiedatum, ID AS facturatieID FROM facturen
                              WHERE facturen.verzekeraar = ".$_SESSION['ID'].";";

                    $queryclient = "
                              SELECT facturen.client, client.voornaam, client.achternaam, client.id
                              FROM facturen
                              INNER JOIN client ON facturen.client = client.id
                              WHERE facturen.verzekeraar = ".$_SESSION['ID'].";
                    ";

                    $querybehandeling = "
                              SELECT facturen.behandeling, behandelingen.naam, behandelingen.id
                              FROM facturen
                              INNER JOIN behandelingen ON facturen.behandeling = behandelingen.id
                              WHERE facturen.verzekeraar = ".$_SESSION['ID'].";
                    ";

                    $queryverzekeraar = "
                              SELECT facturen.verzekeraar, verzekeraar.voornaam, verzekeraar.achternaam, verzekeraar.id
                              FROM facturen
                              INNER JOIN verzekeraar ON facturen.verzekeraar = verzekeraar.id
                              WHERE facturen.verzekeraar = ".$_SESSION['ID'].";
                    ";

                    $result = mysqli_query($conn, $query);
                    $resultclient = mysqli_query($conn, $queryclient);
                    $resultbehandeling = mysqli_query($conn, $querybehandeling);
                    $resultverzekeraar = mysqli_query($conn, $queryverzekeraar);

                    while ($row = mysqli_fetch_array($result)) {
                        $rowclient = mysqli_fetch_array($resultclient);
                        $rowbehandeling = mysqli_fetch_array($resultbehandeling);
                        $rowverzekeraar = mysqli_fetch_array($resultverzekeraar);

                        echo '
                            <tr>
                                <td>'.$rowclient["voornaam"].' '.$rowclient['achternaam'].'</td>
                                <td>'.$rowbehandeling['naam'].'</td>
                                <td>'.$rowverzekeraar['voornaam'].' '.$rowverzekeraar['achternaam'].'</td>
                                <td>'.$row['facturatiedatum'].'</td>
                                <td><a target="_blank" href="./factuur.php?ID='.$row['facturatieID'].'" class="PDF">Open factuur</a></td>
                            </tr>
                        ';
                    }

                    ?>
            </table>
        </div>
    </section>

    <footer class="footer"> <!-- FOOTER -->
        <p>© Copyright 2018 MediCure</p>
    </footer>
</div>
</body>
</html>
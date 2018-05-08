<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8" />
    <title> MediCure | Agenda </title>
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
        <h1>Agenda</h1>
        <?php
        if ($_SESSION['rol'] != "client") {
            echo '<h3 class="text_left">Hieronder vind u een overzicht van alle afspraken van uw cliënten</h3>';
        }
        else {
            echo '<h3 class="text_left">Hieronder vind u een overzicht van al uw gemaakte afspraken</h3>';
        }

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
        <?php
        if ($_SESSION['rol']!="verzekeraar") {
            if ($_SESSION['rol'] != "client") {
                echo '<a class="toevoegen" onclick="openModal()"><b class="cross">+</b> Afspraak toevoegen</a>';
            }
        }
        ?>


        <div id="myModal" class="modal"><!-- POP-UP -->
            <div class="modal-content" id="size2">
                <div class="close cursor" onclick="closeModal()">&times;</div>
                <h3>Afspraak toevoegen</h3>
                <form action="toevoegenafspraak.php" method="POST">
                    <table class="pop-up_table">
                        <tr class="pop-up_name">
                            <td>Cliëntnaam:*</td>
                        </tr>
                        <tr class="pop-up_name2">
                            <td>
                                <select name="client">

                                <?php
                                if ($_SESSION['rol'] == "huisarts") {
                                    $query = "SELECT voornaam, achternaam, ID, huisarts FROM client WHERE huisarts='".$_SESSION['ID']."';";
                                }
                                else {
                                    $query = "SELECT voornaam, achternaam, ID FROM client ;";
                                }

                                $result = mysqli_query($conn, $query);

                                while ($row = mysqli_fetch_array($result)) {
                                    $naam = $row['voornaam'] . " " . $row['achternaam'];
                                    echo '<option value="' . $row["ID"] . '">' . $naam . '</option>';
                                }
                                ?>

                                </select>
                            </td>
                        </tr>
                        <tr class="pop-up_name">
                            <td>Behandeling:*</td>
                        </tr>
                        <tr class="pop-up_name2">
                            <td>
                                <select name="behandeling">

                                    <?php
                                    $query2="SELECT naam, ID FROM behandelingen ORDER BY ID";
                                    $result2=mysqli_query($conn, $query2);

                                    while ($row2 = mysqli_fetch_array($result2)) {
                                        echo '<option value="'.$row2["ID"].'">'.$row2['naam'].'</option>';
                                    }
                                    ?>

                                </select>
                            </td>
                        </tr>
                        <tr class="pop-up_name">
                            <td>Datum:*</td>
                        </tr>
                        <tr class="pop-up_name2">
                            <td><input type="date" name="datum"></td>
                        </tr>
                        <tr class="pop-up_name">
                            <td>Tijdstip:*</td>
                        </tr>
                        <tr class="pop-up_name2">
                            <td><input type="time" name="tijd"></td>
                        </tr>
                        <tr>
                            <td><i>* Verplichte velden</i></td>
                        </tr>
                    </table>

                    <table class="pop-up_table">
                        <?php

                        if ($_SESSION['rol'] == "huisarts") {

                            $roltitel = "ziekenhuisspecialist";

                            $query4="SELECT voornaam, achternaam, ID FROM ziekenhuisspecialist ORDER BY ID";
                            $result4=mysqli_query($conn, $query4);

                            echo '

                        <tr>
                            <td>' .$roltitel. '</td>
                        </tr>
                        <tr>
                            <td>
                                <select name="' .$roltitel. '">';

                                    while ($row4 = mysqli_fetch_array($result4)) {
                                    $naam4 = $row4['voornaam']. " " .$row4['achternaam'];
                                    echo '<option value="'.$row4["ID"].'">'.$naam4.'</option>';
                                    }

                                    echo '
                                </select>
                            </td>
                        </tr>
                        ';
                        }
                        ?>
                        <tr>
                            <td>Opmerkingen:</td>
                        </tr>
                        <tr>
                            <td><textarea class="opmerkingen" name="opmerkingen"></textarea></td>
                        </tr>
                    </table>
                    <div class="submitspecial">
                        <input class="submit1" type="submit" name="submit" value="Bevestigen">
                    </div>
                </form>
            </div>
        </div>


        <div style="overflow-x:auto;" class="table_div">
            <table class="table2">
                <tr>
                    <th>Cliëntnaam:</th>
                    <th>Behandelingsnaam:</th>
                    <th>Datum:</th>
                    <th>Tijdstip:</th>
                    <th>ziekenhuis:</th>
                    <th>huisarts:</th>
                    <th>opmerking:</th>
                    <?php
                        if ($_SESSION['rol'] == "verzekeraar") {
                            echo '
                    <th>Status:</th><th>Factureren</th>';
                        }
                    ?>
                </tr>
                <?php
                if ($_SESSION['rol'] == 'ziekenhuisspecialist') {
                    $query5 = "
                            SELECT afspraken.datum, afspraken.tijd, afspraken.opmerkingen, afspraken.status, afspraken.id AS afspraakid
                            FROM   afspraken;
                              ";

                    $queryclient = "
                            SELECT afspraken.client, client.voornaam, client.achternaam
                            FROM afspraken
                            INNER JOIN client ON client.id = afspraken.client;
                        ";

                    $querybehandeling = "
                            SELECT afspraken.behandeling, behandelingen.naam
                            FROM afspraken
                            INNER JOIN behandelingen ON behandelingen.id = afspraken.behandeling;
                        ";

                    $queryziekenhuis = "
                            SELECT afspraken.ziekenhuis, ziekenhuis.naam
                            FROM afspraken
                            INNER JOIN ziekenhuis ON ziekenhuis.id = afspraken.ziekenhuis;
                        ";

                    $queryhuisarts = "
                            SELECT afspraken.huisarts, huisarts.voornaam, huisarts.achternaam
                            FROM afspraken
                            INNER JOIN huisarts ON huisarts.id = afspraken.huisarts;
                        ";
                }
                else {
                    $query5 = "
                            SELECT afspraken.datum, afspraken.tijd, afspraken.opmerkingen, afspraken.status, afspraken.id AS afspraakid
                            FROM   afspraken
                            WHERE afspraken.".$_SESSION['rol']." = '".$_SESSION['ID']."';
                              ";

                    $queryclient = "
                            SELECT afspraken.client, client.voornaam, client.achternaam
                            FROM afspraken
                            INNER JOIN client ON client.id = afspraken.client
                            WHERE afspraken.".$_SESSION['rol']." = '".$_SESSION['ID']."';
                        ";

                    $querybehandeling = "
                            SELECT afspraken.behandeling, behandelingen.naam
                            FROM afspraken
                            INNER JOIN behandelingen ON behandelingen.id = afspraken.behandeling
                            WHERE afspraken.".$_SESSION['rol']." = '".$_SESSION['ID']."';
                        ";

                    $queryziekenhuis = "
                            SELECT afspraken.ziekenhuis, ziekenhuis.naam
                            FROM afspraken
                            INNER JOIN ziekenhuis ON ziekenhuis.id = afspraken.ziekenhuis
                            WHERE afspraken.".$_SESSION['rol']." = '".$_SESSION['ID']."';
                        ";

                    $queryhuisarts = "
                            SELECT afspraken.huisarts, huisarts.voornaam, huisarts.achternaam
                            FROM afspraken
                            INNER JOIN huisarts ON huisarts.id = afspraken.huisarts
                            WHERE afspraken.".$_SESSION['rol']." = '".$_SESSION['ID']."';
                        ";
                }

                $result5=mysqli_query($conn, $query5);
                $resultclient=mysqli_query($conn, $queryclient);
                $resultbehandeling=mysqli_query($conn, $querybehandeling);
                $resultziekenhuis=mysqli_query($conn, $queryziekenhuis);
                $resulthuisarts=mysqli_query($conn, $queryhuisarts);

                while ($row5=mysqli_fetch_array($result5))
                {
                    $rowclient=mysqli_fetch_array($resultclient);
                    $rowbehandeling=mysqli_fetch_array($resultbehandeling);
                    $rowziekenhuis=mysqli_fetch_array($resultziekenhuis);
                    $rowhuisarts=mysqli_fetch_array($resulthuisarts);

                    echo "
                    <tr>
                        <td>" . $rowclient['voornaam'] . " " . $rowclient['achternaam'] . "</td>
                        <td>" . $rowbehandeling['naam'] . "</td>
                        <td>" . $row5['datum'] . "</td>
                        <td>" . $row5['tijd'] . "</td>
                        <td>" . $rowziekenhuis['naam'] . "</td>
                        <td>" . $rowhuisarts['voornaam'] . " " . $rowhuisarts['achternaam'] . "</td>
                        <td>" . $row5['opmerkingen'] . "</td>";
                        if ($_SESSION['rol'] == "verzekeraar") {
                            echo '<td>'.$row5['status'].'</td>';

                            if ($row5['status'] == "Ongefactureerd") {
                                echo '<td><a href="./toevoegenfacturen.php?ID='.$row5['afspraakid'].'" class="PDF">Factureren</a></td>';
                            }
                            else {
                                echo '<td></td>';
                            }
                        }
                        echo "
                    </tr>";
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
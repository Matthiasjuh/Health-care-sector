<!doctype html>
<html lang="nl">
    <head>
        <meta charset="utf-8" />
        <title> MediCure | Behandelingen </title>
        <link rel="stylesheet" href="./main.css" media="screen" />
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

        <script type="text/javascript" src="main.js"></script>
    </head>

    <body>
    <?php
    session_start();
    include('include/db.php');
    include ('functions.php');
    $conn=fnConndb();
    ?>
        <div class="achtergrond_overlay">
            <header class="header"> <!-- HEADER -->
                <a class="goback" href="dashboard.php"></a>
                <h2 class="ingelogd_als">Ingelogd als: <?php echo $_SESSION['rol']; ?></h2>
                <h1>Behandelingen</h1>
                <h3 class="text_left">Hieronder vind u alle beschikbare behandelingen</h3>
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
                <a class="toevoegen" onclick="openModal();currentSlide(1)"><b class="cross">+</b> Behandeling toevoegen</a>

                <div id="myModal" class="modal"><!-- POP-UP -->
                    <div class="modal-content" id="size1">
                        <div class="close cursor" onclick="closeModal()">&times;</div>
                        <h3>Behandeling toevoegen</h3>
                        <form action="toevoegenbehandelingen.php" method="POST">
                        <table class="pop-up_table">
                            <tr class="pop-up_name">
                                <td>Behandelingsnaam:*</td>
                            </tr>
                            <tr class="pop-up_name2">
                                <td><input type="text" name="naam" placeholder="Voer een naam in..."></td>
                            </tr>
                            <tr class="pop-up_name">
                                <td>Tijdsduur:*</td>
                            </tr>
                            <tr class="pop-up_name2">
                                <td><input type="number" step=".01" name="tijd" placeholder="Voer een tijd in..."></td>
                            </tr>
                            <tr class="pop-up_name">
                                <td>Prijs:*</td>
                            </tr>
                            <tr class="pop-up_name2">
                                <td><input type="number" step=".01" name="prijs" placeholder="Voer een prijs in..."></td>
                            </tr>
                            <tr>
                                <td><i>* Verplichte velden</i></td>
                            </tr>
                            <tr class="pop-up_name2">
                                <td><input type="submit" name="submit" value="Behandeling toevoegen"></td>
                            </tr>
                        </table>
                        </form>
                    </div>
                </div>

                <div style="overflow-x:auto;" class="table_div">
                    <table class="table2">
                        <tr>
                            <th>Naam:</th>
                            <th>Tijdsduur:</th>
                            <th>Prijs excl. btw:</th>
                            <th>Prijs incl. btw:</th>
                        </tr>
                        <?php
                        $query="SELECT * FROM behandelingen ORDER by ID";
                        $result=mysqli_query($conn, $query);


                        while ($row=mysqli_fetch_array($result)) {
                            $prijsinclbtw=$row['prijs'];
                            $prijsexclbtw=PrijsExclBtw($prijsinclbtw);

                            echo "
                                <tr>
                                    <td>" .$row['naam']."</td>
                                    <td>";

                                    if ($row['tijdsduur'] <= 1) {
                                        echo $row['tijdsduur']." uur";
                                    }
                                    else {
                                        echo $row['tijdsduur']." uren";
                                     }
                                    echo "</td>
                                    <td>€ " .$prijsexclbtw."</td>
                                    <td>€ " .$prijsinclbtw."</td>
                                </tr>
                            ";
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
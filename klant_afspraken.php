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
<div class="achtergrond_overlay">
    <header class="header"> <!-- HEADER -->
        <a class="goback" href="dashboard.php"></a>
        <h2 class="ingelogd_als">Ingelogd als: </h2>
        <h1>Agenda</h1>
        <h3 class="text_left">Hieronder vind u een overzicht van al uw gemaakte afspraken</h3>
        <img class="main_logo" src="./Images/Logo.svg">
    </header>

    <section class="section"> <!-- SECTION -->
        <div style="overflow-x:auto;" class="table_div">
            <table class="table2">
                <tr>
                    <th>Behandeling:</th>
                    <th>Datum:</th>
                    <th>Tijdstip:</th>
                    <th>opmerking:</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Naam1</td>
                    <td>1,5 uur</td>
                    <td>€10,-</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Naam2</td>
                    <td>1,5 uur</td>
                    <td>€10,-</td>
                </tr>
                <tr class="table2_specialrow">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>
    </section>

    <footer class="footer"> <!-- FOOTER -->
        <p>© Copyright 2018 MediCure</p>
    </footer>
</div>
</body>
</html>
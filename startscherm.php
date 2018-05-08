<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8" />
    <title> MediCure | Login </title>
    <link rel="stylesheet" href="./main.css" media="screen" />
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

    <script type="text/javascript" src="main.js"></script>
</head>

<body class="sketchup">
    <div class="achtergrond_overlay2">
        <header class="header"> <!-- HEADER -->
            <h2>Welkom op de inlogpagina van Medicare! </h2>
            <h1>Log in</h1>
            <h3 class="text_left">Selecteer uw rol en voer vervolgens uw gegevens in. Bent u een klant? Dan heeft u uw inloggegevens ontvangen van uw huisarts.</h3>
            <img class="main_logo" src="./Images/Logo.svg">
        </header>

        <form action="controle.php" method="POST">
            <table class="pop-up_table" id="inlogscherm_table">
                <tr class="pop-up_name">
                    <td>E-mailadres:*</td>
                </tr>
                <tr class="pop-up_name2">
                    <td><input type="text" name="email" placeholder="Voer uw e-mailadres in..."></td>
                </tr>
                <tr class="pop-up_name">
                    <td>Wachtwoord:*</td>
                </tr>
                <tr class="pop-up_name2">
                    <td><input type="password" name="wachtwoord" placeholder="Voer uw wachtwoord in..."></td>
                </tr>
                <tr class="pop-up_name">
                    <td>Rol:*</td>
                </tr>
                <tr class="pop-up_name2">
                    <td>
                        <select name="rol">
                            <option value="">Selecteer uw rol...</option>
                            <option value="client">cliënt</option>
                            <option value="huisarts">Huisarts</option>
                            <option value="verzekeraar">Verzekeraar</option>
                            <option value="ziekenhuisspecialist">Ziekenhuis-specialist</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><i>* Verplichte velden</i></td>
                </tr>
                <tr class="pop-up_name2">
                    <td><input type="submit" name="submit" value="Log in"></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
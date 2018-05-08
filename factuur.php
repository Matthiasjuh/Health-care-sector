<?php
session_start();
include('./include/db.php');
include('./functions.php');
$conn = fnConndb();

if (isset($_GET['ID'])) {

    $factuurID = $_GET['ID'];

    // verzekeraar
    $queryverzekeraar = "SELECT verzekeraar.voornaam, verzekeraar.achternaam, verzekeraar.adres, verzekeraar.plaats, verzekeraar.emailadres
                         FROM facturen 
                         INNER JOIN verzekeraar ON verzekeraar.id = facturen.verzekeraar
                         WHERE facturen.id = '$factuurID';";
    $resultverzekeraar = mysqli_query($conn, $queryverzekeraar);
    $rowverzekeraar = mysqli_fetch_array($resultverzekeraar);

    // client
    $queryclient = "SELECT client.voornaam, client.achternaam, client.straatnaam, client.huisnummer, client.woonplaats, client.emailadres
                         FROM facturen 
                         INNER JOIN client ON client.id = facturen.client
                         WHERE facturen.id = '$factuurID';";
    $resultclient = mysqli_query($conn, $queryclient);
    $rowclient = mysqli_fetch_array($resultclient);

    // behandeling
    $querybehandeling = "SELECT behandelingen.naam, behandelingen.prijs
                         FROM facturen 
                         INNER JOIN behandelingen ON behandelingen.id = facturen.behandeling
                         WHERE facturen.id = '$factuurID';";
    $resultbehandeling = mysqli_query($conn, $querybehandeling);
    $rowbehandeling = mysqli_fetch_array($resultbehandeling);
    $prijsexclbtw = PrijsExclBtw($rowbehandeling['prijs']);

    // factuur
    $queryfactuur = "SELECT facturen.facturatiedatum, facturen.afspraakdatum, facturen.ID
                         FROM facturen
                         WHERE facturen.id = '$factuurID';";
    $resultfactuur = mysqli_query($conn, $queryfactuur);
    $rowfactuur = mysqli_fetch_array($resultfactuur);


    $totaalexclbtw2 = $prijsexclbtw;
    $totaalexclbtw = number_format($totaalexclbtw2, 2, '.', ',');
    $totaalinclbtw2 = $prijsexclbtw/79*100;
    $totaalinclbtw = number_format($totaalinclbtw2, 2, '.', ',');
    $btw2 = $totaalinclbtw2*0.21;
    $btw = number_format($btw2, 2, '.', ',');



    ob_start();

    $html = ob_get_clean();

    $html = utf8_encode($html);

    $html .= '
    <style>
    
    .factuur {width: 90%; position: relative; left: 5%; margin-top: 50px}
        h1 {color: RGBA(0, 197, 205, 1); font-size: 40px}
        
        .td1 {width: 15%}
        .td2 {width: 30%}
        .td3 {width: 20%; text-align: left}
        .td4 {width: 55%}
        .td5 {width: 100%}
        .td6 {width: 100%; text-align: right}
        
        table tr td, p {
        font-size: 14px;
        }
        .intel3 td {padding: 10px}
        table {border-collapse: collapse}
        
        #blue {color: RGBA(0, 197, 205, 1)}
        .blue2 {background: RGBA(0, 197, 205, 1)}
        .blue3 {background: RGBA(0, 197, 205, .05)}
        #blue4 {text-align: right}
        #bold {font-weight: bold}
        .blue2 td {font-weight: bold}
        .logo {width: 80px}
        
    </style>
    
    <div class="factuur">
        <table>
            <tr>
                <td class="td5"><h1>Factuur</h1></td>
                <td class="td6"><img class="logo" src="Images/logo.png"></td>
            </tr>
        </table>
        
        <hr/>
        
        <table class="intel">
            <tr>
                <td class="td1" id="bold">Cliëntgegevens:</td>
                <td class="td2"></td>
                <td class="td1" id="bold">Verzekeraar:</td>
                <td class="td2"></td>
            </tr>
            <tr>
                <td class="td1">Naam:</td>
                <td class="td2">'.$rowclient['voornaam'].' '.$rowclient['achternaam'].'</td>
                <td class="td1">Naam:</td>
                <td class="td2">'.$rowverzekeraar['voornaam'].' '.$rowverzekeraar['achternaam'].'</td>
            </tr>
            <tr>
                <td class="td1">Adres:</td>
                <<td class="td2">'.$rowclient['straatnaam'].' '.$rowclient['huisnummer'].'</td>
                <td class="td1">Adres:</td>
                <td class="td2">'.$rowverzekeraar['adres'].'</td>
            </tr>
            <tr>
                <td class="td1">Woonplaats:</td>
                <td class="td2">'.$rowclient['woonplaats'].'</td>
                <td class="td1">Woonplaats:</td>
                <td class="td2">'.$rowverzekeraar['plaats'].'</td>
            </tr>
            <tr>
                <td class="td1">E-mailadres:</td>
                <td class="td2">'.$rowclient['emailadres'].'</td>
                <td class="td1">E-mailadres:</td>
                <td class="td2">'.$rowverzekeraar['emailadres'].'</td>
            </tr>
        </table>
        
        <hr/>
        
        <table class="intel2">
            <tr>
                <td class="td1" id="blue">Factuurdatum:</td>
                <td class="td3">'.$rowfactuur['facturatiedatum'].'</td>
                <td class="td1" id="blue">Factuurnummer:</td>
                <td class="td3">'.$rowfactuur['ID'].'</td>
            </tr>
        </table>
        
        <hr/>
        
        <table class="intel3">
            <tr class="blue2">
                <td class="td3">Afspraakdatum</td>
                <td class="td4">Behandeling</td>
                <td class="td3">Kosten excl. BTW</td>
            </tr>
            <tr class="blue3">
                <td class="td3">'.$rowfactuur['afspraakdatum'].'</td>
                <td class="td4">'.$rowbehandeling['naam'].'</td>
                <td class="td3">'.$prijsexclbtw.'</td>
            </tr>
            <tr>
                <td class="td3"></td>
                <td class="td4" id="blue4">Totaal excl. BTW:</td>
                <td class="td3">'.$totaalexclbtw.'</td>
            </tr>
            <tr>
                <td class="td3"></td>
                <td class="td4" id="blue4">BTW 21%:</td>
                <td class="td3">'.$btw.'</td>
            </tr>
            <tr>
                <td class="td3"></td>
                <td class="td4" id="blue4"></td>
                <td class="td3" style="text-align: right">+<hr/></td>
            </tr>
            <tr>
                <td class="td3"></td>
                <td class="td4" id="blue4">Totaalprijs incl BTW:</td>
                <td class="td3">'.$totaalinclbtw.'</td>
            </tr>
        </table>
        
        <hr/>
        <p>Er word verzocht het gevraagde bedrag binnen 48 uur over te maken naar het genoemde rekening-nummer. Na 48 uur zullen wij een extra tarief van ten minste 10% extra per week rekenen.</p>
        
    </div>
';

    include("mpdf60/mpdf.php");

    $mpdf = new mPDF();

    $mpdf->allow_charset_conversion = true;

    $mpdf->charset_in = 'UTF-8';

    $mpdf->WriteHTML($html);

    $mpdf->Output('meu-pdf', 'I');

    exit();

}

else {
    header('refresh:0; url=facturatiescherm.php');
}

?>
<?php

function fnConndb(){

    // initialisatie

    $host = 'localhost';
    $database = 'medicure';
    $user = 'root';
    $wachtwoord = '';

// connectie

    $connDb = mysqli_connect($host, $user, $wachtwoord, $database);
    if ($connDb) {
        return $connDb;
    }
    else {
        return die('Connectie niet gelukt. Foutmelding: ' .mysqli_connect_error());
    }

} // einde fnConndb

function fnClosedb($conn) {
    mysqli_close($conn)
    or die('Sluiten MySQL-db niet gelukt...');
}
?>
<?php
/* 
Autor:      Kevin Schänzle
Datum:      14.01.2021
Beschreibung:
- Mit dem Datenbank-Server verbinden, Datenbank wählen und Zeichensatz definieren
- Mit Fehlerbehandlung
*/
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

// Verbindung zur Datenbank aufbauen
try{
    $dsn = 'mysql:host=' . $host . ';dbname=' . $database;
    $db = new PDO($dsn, $user, $password, $options);
}
// Fehler-Behandlung
catch(PDOExeption $e){
    // Fehlermeldung ohne Details, wird auch im produktiven Web gezeigt
    echo 'verarbeitung fehlgeschlagen';
    // Detaillierte Fehlermeldung, wird nur auf dem Testserver angezeigt (da, wo display_errors auf on gesetzt ist)
    if(ini_get('display errors')){
        echo '<br>'. $e->getMessage();
    }
    // Ausführung des Scripts beenden

    exit;
}
    // Array-Typ für die Datensätze festlegen, assoziativ
    $db -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    //Errormode auf Silent stellen.
    $db -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_SILENT);
?>
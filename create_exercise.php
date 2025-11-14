<?php
// Stap 0: De Sessie en Verbinding
session_start(); // We MOETEN weten WIE dit doet
require_once 'connect.php';

// Stap 1: De Uitsmijter
// Is de gebruiker ingelogd? Zo nee, wegwezen.
if ( !isset($_SESSION['user_id']) ) {
    header('Location: login.php');
    exit;
}

// Stap 2: De POST-data ontvangen
// We controleren of dit een POST-verzoek is EN of de data er is
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['titel'])) {
    
    // Pak de data uit het formulier
    $form_titel = trim($_POST['titel']);
    $form_beschrijving = trim($_POST['beschrijving']);
    
    // Pak de ID van de INGE LOGDE GEBRUIKER uit de Sessie
    $huidige_user_id = $_SESSION['user_id']; 

    // Stap 3: De SQL-query (DE 'C' VAN CRUD)
    // **** JIJ MOET DEZE QUERY AFMAKEN ****
    //
    // We willen data 'INVOEGEN IN' de 'exercises' tabel.
    // We moeten de kolommen specificeren: (titel, beschrijving, user_id)
    // En dan de WAARDEN: (?, ?, ?)
    //
    $sql = "INSERT INTO
                exercises 
                (exercises.titel,
                exercises.beschrijving,
                exercises.user_id)
            VALUES (?, ?, ?)"
            ; 

    try {
        // Stap 4: Prepare & Execute
        $stmt = $pdo->prepare($sql);
        
        // De data MOET in dezelfde volgorde zijn als je placeholders
        $stmt->execute([
            $form_titel,
            $form_beschrijving,
            $huidige_user_id
        ]);
        
        // Stap 5: Terugsturen
        // Als de query slaagt, stuur de gebruiker direct terug naar de index.
        // Omdat ze teruggaan, zal index.php opnieuw laden en... de nieuwe
        // oefening tonen in de lijst.
        header('Location: index.php');
        exit;

    } catch (PDOException $e) {
        // Vang de fout op
        die("Fout bij het toevoegen van oefening: " . $e->getMessage());
    }

} else {
    // Als iemand hier per ongeluk (via GET) komt of zonder titel
    echo "Ongeldig verzoek.";
    header('Location: index.php'); // Stuur ze terug
    exit;
}
?>
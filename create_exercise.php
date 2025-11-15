<?php

session_start();
require_once 'connect.php';


if ( !isset($_SESSION['user_id']) ) {
    header('Location: login.php');
    exit;
}

// We controleren of dit een POST-verzoek is EN of de data er is
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['titel'])) {
    
    $form_titel = trim($_POST['titel']);
    $form_beschrijving = trim($_POST['beschrijving']);
    
    $huidige_user_id = $_SESSION['user_id']; 

    $sql = "INSERT INTO
                exercises 
                (exercises.titel,
                exercises.beschrijving,
                exercises.user_id)
            VALUES (?, ?, ?)"
            ; 

    try {
        $stmt = $pdo->prepare($sql);
        
        $stmt->execute([
            $form_titel,
            $form_beschrijving,
            $huidige_user_id
        ]);
        
        header('Location: index.php');
        exit;

    } catch (PDOException $e) {
        // Vang de fout op
        die("Fout bij het toevoegen van oefening: " . $e->getMessage());
    }

} else {
    // Als iemand hier per ongeluk (via GET) komt of zonder titel
    echo "Ongeldig verzoek.";
    header('Location: index.php');
    exit;
}
?>
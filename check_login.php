<?php
require_once 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $form_naam = trim($_POST['naam']);
    $form_wachtwoord = trim($_POST['wachtwoord']);

    $sql = "SELECT * FROM users WHERE users.naam = ?";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$form_naam]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Controleer 1: Is de gebruiker überhaupt gevonden?
        // Controleer 2: Als ja, klopt het wachtwoord?
        if ($user && password_verify($form_wachtwoord, $user['wachtwoord'])) {
            
            session_start(); 
            
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_naam'] = $user['naam'];
            
            header('Location: index.php');
            exit;

        } else {
            echo "Ongeldige gebruikersnaam of wachtwoord.";
        }

    } catch (PDOException $e) {
        echo "Login mislukt (Databasefout): " . $e->getMessage();
    }

} else {
    // Als iemand direct naar /check_login.php surft (via GET)
    echo "Je mag hier niet zijn. Ga terug naar het <a href='login.php'>inlogformulier</a>.";
}
?>
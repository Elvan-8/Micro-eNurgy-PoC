<?php
// Stap 0: De verbinding importeren
require_once 'connect.php';

// Stap 1: De POST-data ontvangen
// We controleren of de data wel ECHT via POST is verstuurd
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Pak de data uit het formulier.
    // We doen een simpele trim() om spaties eraf te halen.
    $form_naam = trim($_POST['naam']);
    $form_wachtwoord = trim($_POST['wachtwoord']);

    // Stap 2: De SQL-query (De Blauwdruk)
    // **** JIJ MOET DEZE QUERY AFMAKEN ****
    // We moeten de gebruiker vinden die *exact* deze naam heeft.
    // We willen ALLE kolommen van die gebruiker (vooral de hash!)
    //
    $sql = "SELECT * FROM users WHERE users.naam = ?"; // HOE FILTER JE OP NAAM?

    try {
        // Stap 3: Prepare & Execute
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$form_naam]); // Stuur de naam als parameter
        
        // Stap 4: De Gebruiker Ophalen
        // fetch() haalt 1 rij op, geen fetchAll()
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Stap 5: DE CONTROLE (Het hart van de login)
        // $user kan 'false' zijn (gebruiker niet gevonden)
        // of het is een array (gebruiker gevonden)
        
        // Controleer 1: Is de gebruiker überhaupt gevonden?
        // Controleer 2: Als ja, klopt het wachtwoord?
        if ($user && password_verify($form_wachtwoord, $user['wachtwoord'])) {
            
            // SUCCES! Wachtwoord klopt.
            
            // 1. Start de 'garderobe' (Sessie-engine)
            session_start(); 
            
            // 2. Schrijf de data in het 'kluisje' op de server
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_naam'] = $user['naam'];
            
            // 3. Stuur de gebruiker fysiek door naar de VIP-ruimte
            header('Location: index.php');
            exit; // STOP HET SCRIPT. Essentieel na een redirect.

        } else {
            // FOUT!
            echo "Ongeldige gebruikersnaam of wachtwoord.";
        }

    } catch (PDOException $e) {
        // Fout in de database-operatie
        echo "Login mislukt (Databasefout): " . $e->getMessage();
    }

} else {
    // Als iemand direct naar /check_login.php surft (via GET)
    echo "Je mag hier niet zijn. Ga terug naar het <a href='login.php'>inlogformulier</a>.";
}
?>
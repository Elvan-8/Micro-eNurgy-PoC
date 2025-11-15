<?php
// ----- DEEL 0: DE UITSMIJTER (NIEUW) -----
session_start(); // Dit MOET de allereerste regel zijn.

// De controle: Is er een 'user_id' ticket in de kluis?
if ( !isset($_SESSION['user_id']) ) {
    // Geen ticket? Je hoort hier niet. Terug naar de poort.
    header('Location: login.php');
    exit; // STOP HET SCRIPT.
}

// ----- DEEL 1: DE PHP-LOGICA (NU AANGEPAST) -----
// Als we hier komen, is de gebruiker ingelogd.
require_once 'connect.php';

// NIET MEER HARDCODED! We lezen het ticket.
$huidige_user_id = $_SESSION['user_id']; 
$resultaten = [];

try {
    $sql = "SELECT 
                exercises.exercise_id,
                exercises.titel, 
                exercises.beschrijving, 
                users.naam 
            FROM 
                exercises 
            JOIN 
                users ON exercises.user_id = users.user_id
            WHERE 
                exercises.user_id = ?";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$huidige_user_id]);
    
    $resultaten = $stmt->fetchAll(PDO::FETCH_ASSOC);


} catch (PDOException $e) {
    die("Fout bij het ophalen van data: " . $e->getMessage());
}

// ----- DEEL 2: DE HTML-PRESENTATIE -----
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Mijn Oefeningen</title>
</head>
<body>

</br><a href="logout.php">Log uit</a></br>

    <hr>

    <form action="create_exercise.php" method="POST" style="margin-bottom: 20px; background: #f4f4f4; padding: 10px;">
        <h3>Nieuwe Oefening Toevoegen</h3>
        <div>
            <label for="titel">Titel:</label>
            <input type="text" id="titel" name="titel">
        </div>
        <div>
            <label for="beschrijving">Beschrijving:</label>
            <textarea id="beschrijving" name="beschrijving" rows="3"></textarea>
        </div>
        <button type="submit">Opslaan</button>
    </form>



    <h1>Welkom, <?php echo htmlspecialchars($_SESSION['user_naam']); ?></h1>
    <p>Hier zijn jouw opgeslagen oefeningen:</p>
      <?php if (empty($resultaten)): ?>
    
        <p>Je hebt nog geen oefeningen aangemaakt.</p>
    
       <?php else: ?>
      
          <?php foreach ($resultaten as $oefening): ?>
              
              <div class="oefening" style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
                  
                  <h2><?php echo htmlspecialchars($oefening['titel']); ?></h2>
                  <p><?php echo htmlspecialchars($oefening['beschrijving']); ?></p>
                  
                </br>
                  
                <form action="delete_exercise.php" method="POST">
                  <input type="hidden" name="exercise_id" value="<?php echo htmlspecialchars($oefening['exercise_id']); ?>">
                  <button type="submit">Verwijder</button>
                </form>

              </div>
          
          <?php endforeach; ?>
      
      <?php endif; ?>
      
    </body>
</html>
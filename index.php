<?php

session_start();

if ( !isset($_SESSION['user_id']) ) {
    header('Location: login.php');
    exit;
}

require_once 'connect.php';


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
                <a href="edit_exercise.php?id=<?php echo htmlspecialchars($oefening['exercise_id']); ?>">Bewerk</a>
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
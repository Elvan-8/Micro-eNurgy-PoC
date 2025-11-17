<?php

session_start();
require_once 'connect.php';


if ( !isset($_SESSION['user_id']) ) {
    header('Location: login.php');
    exit;
}

if ( !isset($_GET['id'])) {
    echo "Geen oefening ID opgegeven.";
    exit;
}

$exercise_id_to_edit = $_GET['id'];
$huidige_user_id = $_SESSION['user_id'];

$sql = "SELECT 
                exercises.exercise_id,
                exercises.titel,
                exercises.beschrijving
            FROM
                exercises
            WHERE
                exercises.exercise_id = ?
            AND
                exercises.user_id = ?";

    try {

        $stmt = $pdo->prepare($sql);
        
        $stmt->execute([
            $exercise_id_to_edit,
            $huidige_user_id
        ]);
        
        $oefening = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$oefening) {
            echo "Geen oefening of eigenaar gevonden.";
            exit;
        }

    } catch (PDOException $e) {
        die("Fout bij ophalen: " . $e->getMessage());
    }

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Bewerk Oefening</title>
</head>
<body>

</br><a href="index.php">Terug naar overzicht</a></br>

    <hr>
    <h2>Oefening Bewerken</h2>

    <form action="update_exercise.php" method="POST">
        
        <input type="hidden" name="exercise_id" value=" <?php echo htmlspecialchars($oefening['exercise_id']); ?>">

        <div>
            <label>Titel:</label>
            <input type="text" name="titel" value=" <?php echo htmlspecialchars($oefening['titel']); ?>">
        </div>

        <div>
            <label>Beschrijving:</label>
            <input type="textarea" name="beschrijving" value=" <?php echo htmlspecialchars($oefening['beschrijving']); ?>">
        </div>

        <button type="submit">Opslaan</button>
    
        </form>
    </body>
</html>
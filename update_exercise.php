<?php

session_start();
require_once 'connect.php';


if ( !isset($_SESSION['user_id']) ) {
    header('Location: login.php');
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['titel'])) {
    
    $form_titel = trim($_POST['titel']);
    $form_beschrijving = trim($_POST['beschrijving']);

    $form_exercise_id = $_POST['exercise_id'];
    $huidige_user_id = $_SESSION['user_id'];

    $sql = "UPDATE
                exercises
            SET
                exercises.titel = ?,
                exercises.beschrijving = ?
            WHERE
                exercises.exercise_id = ?
            AND
                exercises.user_id = ?";

    try {

        $stmt = $pdo->prepare($sql);
        
        $stmt->execute([
            $form_titel,
            $form_beschrijving,
            $form_exercise_id,
            $huidige_user_id
        ]);
        
        header('Location: index.php');
        exit;

    } catch (PDOException $e) {
        die("Fout bij het bewerken: " . $e->getMessage());
    }

} else {
    // Als iemand hier per ongeluk (via GET) komt of zonder titel
    echo "Ongeldig verzoek.";
    header('Location: index.php');
    exit;
}
?>
<?php

session_start();
require_once 'connect.php';


if ( !isset($_SESSION['user_id']) ) {
    header('Location: login.php');
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['exercise_id'])) {
    
    $form_exercise_id = $_POST['exercise_id'];
    
    $huidige_user_id = $_SESSION['user_id']; 


    $sql = "DELETE FROM
                exercises
            WHERE
                exercises.exercise_id = ?
            AND
                exercises.user_id = ?";

    try {

        $stmt = $pdo->prepare($sql);
        
        $stmt->execute([
            $form_exercise_id,
            $huidige_user_id
        ]);
        
        header('Location: index.php');
        exit;

    } catch (PDOException $e) {
        die("Fout bij het verwijderen van oefening: " . $e->getMessage());
    }

} else {
    // Als iemand hier per ongeluk (via GET) komt of zonder titel
    echo "Ongeldig verzoek.";
    header('Location: index.php');
    exit;
}
?>
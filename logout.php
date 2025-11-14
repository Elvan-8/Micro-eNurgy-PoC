<?php
// 1. Start de sessie-engine om het ticket te VINDEN
session_start();

// 2. Maak het 'kluisje' leeg (alle data uit $_SESSION)
session_unset();

// 3. Vernietig het 'kluisje' zelf (het sessiebestand)
session_destroy();

// 4. Stuur de gebruiker ALTIJD naar de poort
header('Location: login.php');
exit;
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Inloggen - Micro-eNurgy</title>
    <style>
        body { font-family: sans-serif; display: grid; place-items: center; min-height: 100vh; }
        form { border: 1px solid #ccc; padding: 20px; }
        div { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input { width: 100%; padding: 8px; }
    </style>
</head>
<body>

    <form action="check_login.php" method="POST">
        <h2>Inloggen</h2>
        
        <div>
            <label for="naam">Gebruikersnaam:</label>
            <input type="text" id="naam" name="naam">
        </div>
        
        <div>
            <label for="wachtwoord">Wachtwoord:</label>
            <input type="password" id="wachtwoord" name="wachtwoord">
        </div>
        
        <button type="submit">Log in</button>
    </form>

</body>
</html>
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admin_password = 'bda'; 

    if ($_POST['password'] === $admin_password) {
        $_SESSION['logged_in'] = true;
        header('Location: admin.php');
        exit;
    } else {
        $error = 'Mot de passe incorrect.';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Bibliothèque</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    <header>
        <a href="../index.php">
            <img src="../logo.png" width="100">
        </a>
        <h1>La Bibliothèque de Centrale Lille</h1>
        <a href="https://docs.google.com/spreadsheets/d/1zN4k8Z45FqBy7biUVE6uSuzLJS8Ijs5oOl42GjnT6I0/edit?usp=sharing">
            <img src="../planning.png" width="100">
        </a>
    </header>

    <main>

    <h2>Connexion Admin</h2>

    <?php if (!empty($error)) echo "<p style='color: red;'>$error</p>"; ?>

    <form method="post">
            <input type="password" name="password" id="password" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>

    </main>

    <footer> <p>&copy; 2025 La Bibliothèque</p> </footer>

</body>
</html>
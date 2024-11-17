<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: admin.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Bibliothèque</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header> <h1>La Bibliothèque de Centrale Lille</h1> </header>

    <main>

    <a href="ajout.php">Ajouter un livre</a>

    <a href="edit.php">Modifier une entrée</a>

    </main>

    <footer> <p>&copy; 2024 La Bibliothèque</p> </footer>

</body>
</html>

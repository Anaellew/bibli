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

    <header>
        <a href="index.php">
            <img src="logo.png" width="100">
        </a>
        <h1>La Bibliothèque de Centrale Lille</h1>
        <a href="https://docs.google.com/spreadsheets/d/1zN4k8Z45FqBy7biUVE6uSuzLJS8Ijs5oOl42GjnT6I0/edit?usp=sharing">
            <img src="planning.png" width="100">
        </a>
    </header>

    <main>

    <div class="moyenspace"></div>

    <a href="ajout.php">Ajouter un livre</a>

    <div class="moyenspace"></div>

    <a href="edit.php">Modifier une entrée</a>

    </main>

    <footer> <p>&copy; 2024 La Bibliothèque</p> </footer>

</body>
</html>

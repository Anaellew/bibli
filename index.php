<?php
// Vous pouvez ajouter ici une logique PHP si nécessaire (par exemple, vérifier des erreurs ou initialiser des variables)
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Bibliothèque</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>La Bibliothèque de Centrale Lille</h1>
    </header>

    <main>
        <h2>Bienvenue sur le site de la bibli</h2>
        <p>Découvrez les livres disponibles à la bibli de la résidence.</p>

        <form action="recherche.php" method="GET">
            <input type="text" name="search" id="search" placeholder="Rechercher un livre..." required>
            <button type="submit">Rechercher</button>
        </form>
        <div class="petitspace"></div>
        <img src="logo.png" width="300">
    </main>

    <footer>
        <p>&copy; 2024 La Bibliothèque</p>
    </footer>

    <script src="assets/js/script.js"></script>
</body>
</html>

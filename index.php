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
        <h1>Ma Bibliothèque</h1>
        <nav>
            <a href="index.php">Accueil</a>
            <!-- Vous pouvez ajouter plus de liens ici si nécessaire -->
        </nav>
    </header>

    <main>
        <!-- Section d'introduction -->
        <section class="hero">
            <h1>Bienvenue à la Bibliothèque en Ligne</h1>
            <p>Explorez notre collection de livres, trouvez des lectures inspirantes, et découvrez de nouveaux auteurs.</p>
        </section>

        <!-- Section de recherche -->
        <form action="recherche.php" method="GET">
            <input type="text" name="search" id="search" placeholder="Rechercher un livre..." required>
            <button type="submit">Rechercher</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 La Bibliothèque</p>
    </footer>

    <script src="assets/js/script.js"></script>
</body>
</html>

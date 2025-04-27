<?php
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

        <h2>Bienvenue sur le site de la bibli</h2> 
        
        <p>Découvrez les livres disponibles à la bibli de la résidence.</p>

        <form action="recherche.php" method="GET">
            <input type="text" name="search" id="search" placeholder="Rechercher un livre..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
            <button type="submit">Rechercher</button>
            <select name="dispo">
                <option value="">Disponibilité</option>
                <option value="1" <?= (isset($_GET['dispo']) && $_GET['dispo'] == '1') ? 'selected' : '' ?>>Disponible</option>
                <option value="0" <?= (isset($_GET['dispo']) && $_GET['dispo'] == '0') ? 'selected' : '' ?>>Indisponible</option>
            </select>
        </form>

        <div class="petitspace"></div>
        <img src="logo.png" width="325">

        <div class="container">
            <form action="/admin/login.php" method="GET">   
                    <button type="submit">Admin</button>
            </form>
        </div>

    </main>

    <footer>
        <p>&copy; 2025 La Bibliothèque</p>
    </footer>
</body>
</html>

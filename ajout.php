<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Connexion à la base SQLite
    $db = new SQLite3('dbb.db');

    // Récupération des données du formulaire
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $type = $_POST['type'];
    $genre = $_POST['genre'];
    $annee = $_POST['annee'];
    $serie = $_POST['serie'];
    $volume = $_POST['volume'];
    $dispo = $_POST['dispo'];


    // Insertion dans la table
    $stmt = $db->prepare("INSERT INTO BDD (titre, auteur, type, genre, annee, serie, volume, dispo) VALUES (:titre, :auteur, :type, :genre, :annee, :serie, :volume, :dispo)");
    $stmt->bindValue(':titre', $titre, SQLITE3_TEXT);
    $stmt->bindValue(':auteur', $auteur, SQLITE3_TEXT);
    $stmt->bindValue(':type', $type, SQLITE3_TEXT);
    $stmt->bindValue(':genre', $genre, SQLITE3_TEXT);
    $stmt->bindValue(':annee', $annee, SQLITE3_INTEGER);
    $stmt->bindValue(':serie', $serie, SQLITE3_TEXT);
    $stmt->bindValue(':volume', $volume, SQLITE3_INTEGER);
    $stmt->bindValue(':dispo', $dispo, SQLITE3_INTEGER);

    if ($stmt->execute()) {
        echo "Livre ajouté avec succès !";
    } else {
        echo "Erreur lors de l'ajout du livre.";
    }
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

    <h2>Ajouter un livre</h2>
    <form action="ajout.php" method="POST">
        <label for="titre">Titre :</label>
        <input type="text" id="titre" name="titre" required><br><br>

        <label for="auteur">Auteur :</label>
        <input type="text" id="auteur" name="auteur" required><br><br>

        <label for="type">Type :</label>
        <input type="text" id="type" name="type"><br><br>

        <label for="genre">Genre :</label>
        <input type="text" id="genre" name="genre"><br><br>

        <label for="annee">Année :</label>
        <input type="text" id="annee" name="annee" ><br><br>

        <label for="serie">Série :</label>
        <input type="text" id="serie" name="serie"><br><br>

        <label for="volume">Volume :</label>
        <input type="text" id="volume" name="volume"><br><br>

        <label for="dispo">Disponibilité :</label>
        <input type="text" id="dispo" name="dispo" required><br><br>

        <button type="submit">Ajouter le livre</button>
    </form>

    <p>Si un livre est disponible, il faut mettre 1. S'il est indisponible, il faut mettre 0.</p>

    <div class="moyenspace"></div>

    </main>

    <footer> <p>&copy; 2024 La Bibliothèque</p> </footer>

</body>
</html>

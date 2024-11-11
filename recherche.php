<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Bibliothèque</title>
    <link rel="stylesheet" href="style_recherche.css">
</head>
<body>
    <header> <h1>La Bibliothèque de Centrale Lille</h1> </header>
    <div class="moyenspace"></div>
        <?php
        // Connexion à la base de données SQLite
        $db = new SQLite3('dbb.db');

        // Récupérer la valeur de recherche, nettoyer les données
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';

        // Si un terme de recherche est fourni
        if (!empty($search)) {
            // Ajouter les signes "%" pour permettre une recherche partielle avec LIKE
            $searchTerm = '%' . $search . '%';

            // Préparer la requête SQL pour rechercher dans le titre, auteur ou genre
            $query = "SELECT * FROM BDD WHERE titre LIKE :searchTerm OR auteur LIKE :searchTerm OR genre LIKE :searchTerm OR type LIKE :searchTerm OR annee LIKE :searchTerm OR serie LIKE :searchTerm";

            // Préparer la requête SQL avec des paramètres
            $stmt = $db->prepare($query);
            $stmt->bindValue(':searchTerm', $searchTerm, SQLITE3_TEXT);

            // Exécuter la requête et obtenir les résultats
            $results = $stmt->execute();

            // Afficher les résultats dans une table HTML
            echo "<h2>Résultats de la recherche pour: " . htmlspecialchars($search) . "</h1>";
            echo "<table class='styled-table'>";
            echo "<thead>";
            echo "<tr><th>Titre</th><th>Auteur</th><th>Genre</th><th>Type</th><th>Année</th><th>Série</th><th>Volume</th><th>Disponibilité</th></tr>";
            echo "</thead>";
            echo "<tbody>";

            // Parcourir les résultats et les afficher dans la table
            while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
                // Transformation des valeurs 'dispo'
                $dispo = ($row['dispo'] == 1) ? 'Disponible' : 'Indisponible';
                $annee = ($row['annee'] == 0) ? 'N/A' : $row['annee'];
                $serie = ($row['serie'] == '') ? 'N/A' : $row['serie'];

                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['titre']) . "</td>";
                echo "<td>" . htmlspecialchars($row['auteur']) . "</td>";
                echo "<td>" . htmlspecialchars($row['genre']) . "</td>";
                echo "<td>" . htmlspecialchars($row['type']) . "</td>";
                echo "<td>" . htmlspecialchars($annee) . "</td>";
                echo "<td>" . htmlspecialchars($serie) . "</td>";
                echo "<td>" . htmlspecialchars($row['volume']) . "</td>";
                echo "<td>" . htmlspecialchars($dispo) . "</td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
        } else {
            // Si le champ de recherche est vide, afficher ce message
            echo "Veuillez entrer un terme de recherche.";
        }

        // Fermer la connexion à la base de données
        $db->close();
        ?>
    <div class="moyenspace"></div>
    <footer> <p>&copy; 2024 La Bibliothèque</p> </footer>
</body>
</html>
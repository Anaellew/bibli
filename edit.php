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
        <form action="edit.php" method="GET">
            <input type="text" name="search" id="search" placeholder="Rechercher un livre..." required>
            <button type="submit">Rechercher</button>
        </form>
        <?php

        $db = new SQLite3('dbb.db');

            // Récupérer la valeur de recherche, nettoyer les données
            $search = isset($_GET['search']) ? trim($_GET['search']) : '';

            if (!empty($search)) {
                // Ajouter les signes "%" pour permettre une recherche partielle avec LIKE
                $searchTerm = '%' . $search . '%';

                // Préparer la requête SQL pour rechercher dans le titre, auteur ou genre
                $query = "SELECT * FROM BDD WHERE titre LIKE :searchTerm OR auteur LIKE :searchTerm OR genre LIKE :searchTerm OR type LIKE :searchTerm OR annee LIKE :searchTerm OR serie LIKE :searchTerm";

                // Préparer la requête SQL avec des paramètres
                $stmt = $db->prepare($query);
                $stmt->bindValue(':searchTerm', $searchTerm, SQLITE3_TEXT);

                // Exécuter la requête et obtenir les résultats
                $result = $stmt->execute();

            } else {
                $result = $db->query("SELECT * FROM BDD");
            }

        echo "<h2>Liste des livres</h1>";
        echo "<table class='styled-table'>";
        echo "<thead>";
        echo "<tr>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Type</th>
                <th>Genre</th>
                <th>Année</th>
                <th>Série</th>
                <th>Volume</th>
                <th>Dispo</th>
                <th>Actions</th>
                <th>Actions</th>
            </tr>";
            echo "</thead>";
            echo "<tbody>";

        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {

            $dispo = ($row['dispo'] == 1) ? 'Disponible' : 'Indisponible';
            $annee = ($row['annee'] == 0) ? '' : $row['annee'];
            $serie = ($row['serie'] == '') ? '' : $row['serie'];
            $volume = ($row['volume'] == 0) ? '' : $row['volume'];            

            echo "<tr>
                    <td>{$row['titre']}</td>
                    <td>{$row['auteur']}</td>
                    <td>{$row['type']}</td>
                    <td>{$row['genre']}</td>
                    <td>{$annee}</td>
                    <td>{$serie}</td>
                    <td>{$volume}</td>
                    <td>{$dispo}</td>
                    <td>
                        <a href='modif.php?id={$row['id']}'>Modifier</a>
                    </td>
                    <td>
                        <a href='suppr.php?id={$row['id']}'>Supprimer</a>
                    </td>
                </tr>";
        }
        echo "</table>";
        ?>
        <div class="moyenspace"></div>
    </main>
    <footer> <p>&copy; 2024 La Bibliothèque</p> </footer>
</body>
</html>
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
    <form action="recherche.php" method="GET">
        <input type="text" name="search" id="search" placeholder="Rechercher un livre..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
        <button type="submit">Rechercher</button>
        <select name="dispo">
            <option value="">Disponibilité</option>
            <option value="1" <?= (isset($_GET['dispo']) && $_GET['dispo'] == '1') ? 'selected' : '' ?>>Disponible</option>
            <option value="0" <?= (isset($_GET['dispo']) && $_GET['dispo'] == '0') ? 'selected' : '' ?>>Indisponible</option>
        </select>
    </form>

            <?php
            // Connexion à la base de données SQLite
            $db = new SQLite3('dbb.db');

            // Récupération des filtres
            $search = isset($_GET['search']) ? trim($_GET['search']) : '';
            $dispo = isset($_GET['dispo']) ? trim($_GET['dispo']) : '';

            // Si un terme de recherche est fourni
            if (!empty($search)) {

                // Construction de la requête
                $query = "SELECT * FROM BDD WHERE 1=1";
                $params = [];

                if (!empty($search)) {
                    $query .= " AND (titre LIKE :searchTerm OR auteur LIKE :searchTerm OR genre LIKE :searchTerm)";
                    $params[':searchTerm'] = '%' . $search . '%';
                } 

                if ($dispo !== '') {
                    $query .= " AND dispo = :dispo";
                    $params[':dispo'] = $dispo;
                }

                // Préparer et exécuter la requête
                $stmt = $db->prepare($query);
                foreach ($params as $key => $value) {
                    $stmt->bindValue($key, $value, SQLITE3_TEXT);
                }
                $result = $stmt->execute();

                // Afficher les résultats dans une table HTML
                echo "<h2>Résultats de la recherche pour: " . htmlspecialchars($search) . "</h1>";
                echo "<table class='styled-table'>";
                echo "<thead>";
                echo "<tr><th>Titre</th><th>Auteur</th><th>Genre</th><th>Type</th><th>Année</th><th>Série</th><th>Volume</th><th>Disponibilité</th></tr>";
                echo "</thead>";
                echo "<tbody>";

                // Parcourir les résultats et les afficher dans la table
                while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                    // Transformation des valeurs 'dispo'
                    $dispo = ($row['dispo'] == 1) ? 'Disponible' : 'Indisponible';
                    $annee = ($row['annee'] == 0) ? '' : $row['annee'];
                    $serie = ($row['serie'] == '') ? '' : $row['serie'];
                    $volume = ($row['volume'] == 0) ? '' : $row['volume'];

                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['titre']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['auteur']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['genre']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['type']) . "</td>";
                    echo "<td>" . htmlspecialchars($annee) . "</td>";
                    echo "<td>" . htmlspecialchars($serie) . "</td>";
                    echo "<td>" . htmlspecialchars($volume) . "</td>";
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
    </main>
    <footer> <p>&copy; 2024 La Bibliothèque</p> </footer>
</body>
</html>

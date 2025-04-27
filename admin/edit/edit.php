<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Bibliothèque</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <header>
        <a href="../../index.php">
            <img src="../../logo.png" width="100">
        </a>
        <h1>La Bibliothèque de Centrale Lille</h1>
        <a href="https://docs.google.com/spreadsheets/d/1zN4k8Z45FqBy7biUVE6uSuzLJS8Ijs5oOl42GjnT6I0/edit?usp=sharing">
            <img src="../../planning.png" width="100">
        </a>
    </header>
    <main>
    <form action="edit.php" method="GET">
        <input type="text" name="search" id="search" placeholder="Rechercher un livre..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
        <button type="submit">Rechercher</button>
        <select name="dispo">
            <option value="">Disponibilité</option>
            <option value="1" <?= (isset($_GET['dispo']) && $_GET['dispo'] == '1') ? 'selected' : '' ?>>Disponible</option>
            <option value="0" <?= (isset($_GET['dispo']) && $_GET['dispo'] == '0') ? 'selected' : '' ?>>Indisponible</option>
        </select>
    </form>

    <?php
        // Connexion à la base
        $db = new SQLite3('../../dbb.db');

        // Récupération des filtres
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        $dispo = isset($_GET['dispo']) ? trim($_GET['dispo']) : '';

        // Construction de la requête
        $query = "SELECT * FROM BDD WHERE 1=1";
        $params = [];

        if (!empty($search)) {
            $query .= " AND (titre LIKE :searchTerm OR auteur LIKE :searchTerm OR genre LIKE :searchTerm)";
            $params[':searchTerm'] = '%' . $search . '%';
        } 
        else {
            $result = $db->query("SELECT * FROM BDD");
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
    <footer> <p>&copy; 2025 La Bibliothèque</p> </footer>
</body>
</html>
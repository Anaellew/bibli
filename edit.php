<?php
$db = new SQLite3('dbb.db');

// Récupérer tous les livres
$result = $db->query("SELECT * FROM BDD");

echo "<h2>Liste des livres</h1>";
echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Année</th>
            <th>Actions</th>
            <th>Actions</th>
        </tr>";

while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['titre']}</td>
            <td>{$row['auteur']}</td>
            <td>{$row['annee']}</td>
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

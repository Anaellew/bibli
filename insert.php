<?php
// Connexion à la base de données SQLite
$db = new SQLite3('dbb.db');

// Créer la table si elle n'existe pas
$createTableQuery = "
CREATE TABLE IF NOT EXISTS BDD (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    titre TEXT,
    auteur TEXT,
    type TEXT,
    genre TEXT,
    annee INTEGER,
    serie TEXT,
    volume INTEGER,
    dispo INTEGER
)";
$db->exec($createTableQuery);

// Ouvrir le fichier CSV
$file = fopen('inventaire.csv', 'r');

// Ignorer la première ligne si elle contient les en-têtes
fgetcsv($file);

// Lire chaque ligne du fichier CSV
while (($row = fgetcsv($file, 1000, ",")) !== FALSE) {
    // Échapper les valeurs pour éviter les erreurs SQL
    $titre = SQLite3::escapeString($row[0]);
    $auteur = SQLite3::escapeString($row[1]);
    $type = SQLite3::escapeString($row[2]);
    $genre = SQLite3::escapeString($row[3]);
    $annee = (int)$row[4];
    $serie = SQLite3::escapeString($row[5]);
    $volume = (int)$row[6];
    $dispo = (int)$row[7];

    // Insérer les données dans la table BDD
    $db->exec("INSERT INTO BDD (titre, auteur, type, genre, annee, serie, volume, dispo) 
               VALUES ('$titre', '$auteur', '$type', '$genre', $annee, '$serie', $volume, $dispo)");
}

// Fermer le fichier
fclose($file);

// Fermer la connexion
$db->close();

echo "Importation terminée avec succès.";
?>
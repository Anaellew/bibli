<?php
$db = new SQLite3('dbb.db');

// Vérifiez si les données nécessaires sont envoyées
if (isset($_POST['id'], $_POST['titre'], $_POST['auteur'], $_POST['dispo'])) {
    $id = (int) $_POST['id'];
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $type = $_POST['type'];
    $genre = $_POST['genre'];
    $annee = (int) $_POST['annee'];
    $serie = $_POST['serie'];
    $volume = $_POST['volume'];
    $dispo = $_POST['dispo'];

    // Préparer et exécuter la mise à jour
    $stmt = $db->prepare("UPDATE BDD SET titre = :titre, auteur = :auteur, type = :type, genre = :genre, annee = :annee, serie = :serie, volume = :volume, dispo = :dispo WHERE id = :id");
    $stmt->bindValue(':titre', $titre, SQLITE3_TEXT);
    $stmt->bindValue(':auteur', $auteur, SQLITE3_TEXT);
    $stmt->bindValue(':type', $type, SQLITE3_TEXT);
    $stmt->bindValue(':genre', $genre, SQLITE3_TEXT);
    $stmt->bindValue(':annee', $annee, SQLITE3_INTEGER);
    $stmt->bindValue(':serie', $serie, SQLITE3_TEXT);
    $stmt->bindValue(':volume', $volume, SQLITE3_TEXT);
    $stmt->bindValue(':dispo', $dispo, SQLITE3_INTEGER);
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);

    if ($stmt->execute()) {
        echo "Le livre a été mis à jour avec succès. <a href='modif.php'>Retour à la liste</a>";
    } else {
        echo "Erreur lors de la mise à jour.";
    }
} else {
    echo "Données manquantes.";
}
?>

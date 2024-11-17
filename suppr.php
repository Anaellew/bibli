<?php
$db = new SQLite3('dbb.db');

// Vérifier si l'ID est passé dans l'URL
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Préparer la requête de suppression
    $stmt = $db->prepare("DELETE FROM BDD WHERE id = :id");
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);

    // Exécuter la suppression
    if ($stmt->execute()) {
        // Redirection vers la page contenant la liste des livres (edit.php ici)
        header("Location: edit.php"); // Redirige vers la liste des livres
        exit;
    } else {
        echo "Erreur lors de la suppression du livre.";
    }
} else {
    echo "Aucun ID fourni.";
}
?>

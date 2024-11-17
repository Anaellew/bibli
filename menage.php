<?php
$db = new SQLite3('dbb.db');

// Exemple : Suppression des livres avec un titre vide ou NULL
$query = "DELETE FROM BDD WHERE titre IS NULL OR titre = '' OR author IS NULL";

// Exécuter la requête
if ($db->exec($query)) {
    echo "Les entrées vides ont été supprimées.";
} else {
    echo "Erreur lors de la suppression des entrées vides.";
}
?>

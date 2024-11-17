<?php
$db = new SQLite3('dbb.db');

// Vérifiez si un ID est passé
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Récupérer les données du livre à modifier
    $result = $db->query("SELECT * FROM BDD WHERE id = $id");


    // Vérifier si la requête a réussi
    if ($result === false) {
        echo "Erreur dans la requête SQL.";
        exit; // Arrêter l'exécution du script si la requête échoue
    }

    $book = $result->fetchArray(SQLITE3_ASSOC);

    if ($book) {
        // Afficher le formulaire pré-rempli avec les données existantes
        echo "<h1>Modifier le livre : {$book['titre']}</h1>";
        echo "<form action='update.php' method='POST'>
                <input type='hidden' name='id' value='{$book['id']}'>
                <label for='titre'>Titre :</label>
                <input type='text' id='titre' name='titre' value='{$book['titre']}' required><br><br>
                
                <label for='auteur'>Auteur :</label>
                <input type='text' id='auteur' name='auteur' value='{$book['auteur']}' required><br><br>

                <label for='type'>Type :</label>
                <input type='text' id='type' name='type' value='{$book['type']}'><br><br>

                <label for='genre'>Genre :</label>
                <input type='text' id='genre' name='genre' value='{$book['genre']}'><br><br>
                
                <label for='annee'>Année de publication :</label>
                <input type='number' id='annee' name='annee' value='{$book['annee']}'><br><br>

                <label for='serie'>Série :</label>
                <input type='text' id='serie' name='serie' value='{$book['serie']}'><br><br>

                <label for='volume'>Volume :</label>
                <input type='text' id='volume' name='volume' value='{$book['volume']}'><br><br>

                <label for='dispo'>Disponibilité :</label>
                <input type='text' id='dispo' name='dispo' value='{$book['dispo']}' required><br><br>
                
                <button type='submit'>Mettre à jour</button>
              </form>";
    } else {
        echo "Aucun livre trouvé avec cet ID.";
    }
} else {
    echo "Aucun ID fourni.";
}
    
?>

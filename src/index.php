<?php
error_reporting(0);
ini_set('display_errors', 0);

// Connexion à la base de données
$servername = "db";
$username = "root";
$password = "root";
$dbname = "vinyls";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Requête pour récupérer les vinyles
$sql = "SELECT v.id as v_id, nom, bpm, annee_sortie, nom_scene FROM Vinyles v 
INNER JOIN Artistes a ON v.artiste_id = a.id ";

// Exécute la requête
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des Vinyles</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php include 'menu.php'; ?>

<div class="container">
    <h1>Liste des Vinyles</h1>
    <a href="new.php">Nouveau vinyl</a>
    <table>
        <tr>
            <th>Nom</th>
            <th>BPM</th>
            <th>Année de sortie</th>
            <th>Artiste</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["nom"] . "</td><td>" . $row["bpm"] . "</td><td>" . $row["annee_sortie"] . "</td><td>" . $row["nom_scene"] . "</td>";
                
                // Colonne contenant le lien pour l'édition avec l'ID correspondant
                echo "
                <td>
                <a href='edit.php?id=" . $row["v_id"] . "'>Éditer</a>
                <a href='delete.php?id=" . $row["v_id"] . "'>Supprimer</a>
                </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Aucun vinyle trouvé</td></tr>";
        }
        ?>
    </table>
</div>

</body>
</html>


<?php
// Fermer la connexion à la base de données
$conn->close();
?>

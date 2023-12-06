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

// Requête pour récupérer les artistes avec leur pays d'origine
$sql = "SELECT Artistes.nom_scene, pays_origine
        FROM Artistes";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des Artistes</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php include 'menu.php'; ?>

<div class="container">
    <h1>Liste des Artistes</h1>
    <table>
        <tr>
            <th>Nom de scène</th>
            <th>Pays d'origine</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["nom_scene"] . "</td><td>" . $row["pays_origine"] . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='2'>Aucun artiste trouvé</td></tr>";
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

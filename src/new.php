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

// Définir des variables vides pour les données du formulaire
$nom = $bpm = $annee_sortie = $artiste_id = "";
$msg = "";
$success = true;

// Récupérer la liste des artistes depuis la base de données
$artistes_query = "SELECT * FROM Artistes";
$artistes_result = $conn->query($artistes_query);

// Vérifier si des données sont soumises via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Valider et récupérer les données du formulaire
    $nom = trim($_POST['nom']);
    $bpm = $_POST['bpm'];
    $annee_sortie = $_POST['annee_sortie'];
    $artiste_id = $_POST['artiste_id'];

    // Vérifier les saisies
    if (!empty($nom) && is_numeric($bpm) && (empty($annee_sortie) || is_numeric($annee_sortie))) {
        // Requête d'insertion
        $sql = "INSERT INTO Vinyles (nom, bpm, annee_sortie, artiste_id) VALUES ('$nom', '$bpm', '$annee_sortie', '$artiste_id')";

        if ($conn->query($sql) === TRUE) {
            $msg = "Vinyle créé avec succès !";
        } else {
            $msg = "Erreur lors de la création du vinyle : " . $conn->error;
            $success = false;
        }
    } else {
        $msg = "Veuillez vérifier les informations saisies.";
        $success = false;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Créer Vinyle</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php include 'menu.php'; ?>

<div class="container">
    <h1>Créer Vinyle</h1>
    <?php 
    if(isset($msg)){
        if($success){
            echo "<div class='success'>";
        } else{
            echo "<div class='error'>";
        }
        echo "<p>".$msg."</p></div>";
    }
    ?>

    <form action="new.php" method="POST">
        <label>Nom:</label>
        <input type="text" name="nom" value="<?php echo $nom; ?>"><br>
        <label>BPM:</label>
        <input type="text" name="bpm" value="<?php echo $bpm; ?>"><br>
        <label>Année de sortie:</label>
        <input type="text" name="annee_sortie" value="<?php echo $annee_sortie; ?>"><br>
        <label>Artiste:</label>
        <select name="artiste_id">
            <?php 
            if ($artistes_result->num_rows > 0) {
                while ($row = $artistes_result->fetch_assoc()) {
                    echo "<option value='" . $row["id"] . "'>" . $row["nom_scene"] . "</option>";
                }
            }
            ?>
        </select><br>

        <input type="submit" value="Créer">
    </form>
    <a href="index.php">Revenir à la liste</a>
</div>

</body>
</html>

<?php
// Fermer la connexion à la base de données
$conn->close();
?>

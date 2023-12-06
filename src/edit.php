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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification des valeurs modifiées
    if (
        isset($_POST['vinyle_id'], $_POST['nom'], $_POST['bpm'], $_POST['annee_sortie'])
        && !empty(trim($_POST['nom'])) // Vérifier si le nom n'est pas vide
        && (is_numeric($_POST['bpm'])) // Vérifier si le BPM est numérique
        && (is_numeric($_POST['annee_sortie'])) // Vérifier si l'année est numérique
    ) {
        $vinyle_id = $_POST['vinyle_id'];
        $nom = $_POST['nom'];
        $bpm = $_POST['bpm'];
        $annee_sortie = $_POST['annee_sortie'];

        // Requête de mise à jour
        $sql = "UPDATE Vinyles SET nom='$nom', bpm='$bpm', annee_sortie='$annee_sortie' WHERE id=$vinyle_id";

        if ($conn->query($sql) === TRUE) {
            $msg = "Mise à jour réussie !";
            $success = true;
        } else {
            $msg = "Erreur lors de la mise à jour : " . $conn->error;
            $success = false;
        }
    } else {
        $msg = "Veuillez vérifier les informations saisies.";
        $success = false;
    }
}

// Récupérer l'ID du vinyle depuis l'URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $vinyle_id = $_GET['id'];

    // Requête pour récupérer les détails du vinyle spécifique
    $sql = "SELECT * FROM Vinyles WHERE id = $vinyle_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Afficher le formulaire avec les détails actuels du vinyle
        ?>

        <!DOCTYPE html>
        <html>
        <head>
            <title>Modifier Vinyle</title>
            <link rel="stylesheet" type="text/css" href="style.css">
        </head>
        <body>

        <?php include 'menu.php'; ?>

        <div class="container">
            <h1>Modifier Vinyle</h1>
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

            <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST">
                <input type="hidden" name="vinyle_id" value="<?php echo $row['id']; ?>">
                <label>Nom:</label>
                <input type="text" name="nom" value="<?php echo $row['nom']; ?>"><br>
                <label>BPM:</label>
                <input type="text" name="bpm" value="<?php echo $row['bpm']; ?>"><br>
                <label>Année de sortie:</label>
                <input type="text" name="annee_sortie" value="<?php echo $row['annee_sortie']; ?>"><br>

                <input type="submit" value="Enregistrer les modifications">
            </form>
            <a href="index.php">Revenir à la liste</a>
        </div>

        </body>
        </html>

        <?php
    } else {
        echo "Aucun vinyle trouvé avec cet ID.";
    }
} else {
    echo "ID non spécifié.";
}

// Fermer la connexion à la base de données
$conn->close();
?>

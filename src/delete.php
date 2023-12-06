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

// Vérifier si l'ID du vinyle est présent dans l'URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $vinyle_id = $_GET['id'];

    // Requête pour récupérer les détails du vinyle spécifique avec le nom de l'artiste
    $sql = "SELECT Vinyles.id, Vinyles.nom, Vinyles.bpm, Vinyles.annee_sortie, Artistes.nom_scene 
            FROM Vinyles 
            INNER JOIN Artistes ON Vinyles.artiste_id = Artistes.id 
            WHERE Vinyles.id = $vinyle_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Si le formulaire est soumis pour supprimer le vinyle
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
            $delete_sql = "DELETE FROM Vinyles WHERE id = $vinyle_id";

            if ($conn->query($delete_sql) === TRUE) {
                $msg = "Le vinyle a été supprimé avec succès !";
                $success = true;
            } else {
                $msg = "Erreur lors de la suppression : " . $conn->error;
                $success = false;
            }
        }
        ?>

        <!DOCTYPE html>
        <html>
        <head>
            <title>Supprimer Vinyle</title>
            <link rel="stylesheet" type="text/css" href="style.css">
        </head>
        <body>

        <?php include 'menu.php'; ?>

        <div class="container">
            <h1>Supprimer Vinyle</h1>
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

            <form action="delete.php?id=<?php echo $_GET['id']; ?>" method="POST">
                <fieldset <?php echo isset($msg) && $success ? "disabled" : ""; ?>>
                    <label>Nom du vinyle:</label>
                    <input type="text" name="nom_vinyle" value="<?php echo $row['nom']; ?>" disabled><br>
                    <label>BPM:</label>
                    <input type="text" name="bpm" value="<?php echo $row['bpm']; ?>" disabled><br>
                    <label>Année de sortie:</label>
                    <input type="text" name="annee_sortie" value="<?php echo $row['annee_sortie']; ?>" disabled><br>
                    <label>Nom de l'artiste:</label>
                    <input type="text" name="nom_artiste" value="<?php echo $row['nom_scene']; ?>" disabled><br>

                    <input type="submit" name="delete" value="Supprimer">
                </fieldset>
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

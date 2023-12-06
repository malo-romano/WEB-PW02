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
    // Récupérer les données du formulaire
    $vinyle_id = $_POST['vinyle_id'];
    $nom = $_POST['nom'];
    $bpm = $_POST['bpm'];
    $annee_sortie = $_POST['annee_sortie'];
    // Récupérer et traiter d'autres champs si nécessaire

    // Requête pour mettre à jour les données du vinyle
    $sql = "UPDATE Vinyles SET nom='$nom', bpm='$bpm', annee_sortie='$annee_sortie' WHERE id=$vinyle_id";

    if ($conn->query($sql) === TRUE) {
        echo "Les informations du vinyle ont été mises à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour : " . $conn->error;
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>

<?php
$servername = "localhost:3306";
$username = "root";
$password = "root";
$dbname = "vinyls";

// Création d'une connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

// Requête pour vérifier la connexion en exécutant SELECT 1
$sql = "SELECT 1";
$result = $conn->query($sql);

if ($result === FALSE) {
    echo "Erreur lors de l'exécution de la requête : " . $conn->error;
} else {
    echo "La connexion à la base de données MySQL fonctionne correctement.";
}

// Fermeture de la connexion
$conn->close();
?>

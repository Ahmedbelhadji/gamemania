<?php
$conn = new mysqli("localhost", "root", "", "test1");

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

$titre="GTA3";

// Requête SQL
$sql = "SELECT * FROM titre WHERE titre = '$titre'";

// Exécution de la requête
$result = $conn->query($sql);

// Vérification des résultats
if ($result->num_rows > 0) {
    // Affichage des données trouvées
    while($row = $result->fetch_assoc()) {
        // Traiter les données comme vous le souhaitez
       $name=$row['img_name'];
       
    }
} else {
    echo "Aucun résultat trouvé";
}



$path="upload\\".$name.".png";
echo "<img src='$path' alt='Description de l'image'>";




?>

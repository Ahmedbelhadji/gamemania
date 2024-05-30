<?php
// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'gamemania');

if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Requête SQL pour récupérer les données de la colonne spécifique
$sql = "SELECT DISTINCT IDP, nom_plateforme FROM plateforme_abonnement";
$result = $conn->query($sql);

?>

<form action="TESTER.php" method="post">
    <select name="platform_id">
        <?php
        // Afficher les options du menu déroulant
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<option value='".$row["IDP"] . "'>" . $row["nom_plateforme"] . "</option>";
            }
        } else {
            echo "<option value=''>Aucune option disponible</option>";
        }
        ?>
    </select>
    <input type="submit" value="Envoyer">
</form>

<?php
$conn->close();
?>

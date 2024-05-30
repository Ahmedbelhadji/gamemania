<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifie si la valeur du menu déroulant est définie
    if (isset($_POST['platform_id'])) {
        $selected_platform_id = $_POST['platform_id'];
        
        // Ici, vous pouvez utiliser la valeur de l'ID sélectionné
        // Par exemple, afficher la valeur
        echo "L'ID de la plateforme sélectionnée est : " . htmlspecialchars($selected_platform_id);
        
        // Vous pouvez également effectuer d'autres opérations comme une requête SQL ou une redirection
    } else {
        echo "Aucune plateforme n'a été sélectionnée.";
    }
} else {
    echo "Méthode de requête invalide.";
}
?>


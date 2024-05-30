<?php
$flag=0;
if(isset($_POST['submit'])){ 



    $conn = new mysqli("localhost","root", "","test1" );

  //Vérifier la connexion
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }

    
    $new_title = $_POST['Titre'];
    
    
    //verifier que le titre n'existe pas 
    $sql = "SELECT * FROM titre WHERE titre = '$new_title'";
    $result = $conn->query($sql);


if (($result->num_rows = 0)) {
    $flag=1;
   if((isset($_POST['Titre'])&& !empty($_POST['Titre']))){

        if(!(isset($_POST['choix'])&& !empty($_POST['choix']))){
            echo "aucune categorie n'est selectionner";
            
        }else{$categories=$_POST['choix'];
            
            $platforme=$_POST['Platforme'];
            $val=1;
                if($platforme==$val){
                    echo "aucune platforme n'est selectionner";
                }else{
                    
                    
                    $Solde=$_POST['Solde'];
                    $qte=$_POST['qte'];
                    
                        if(!(isset($_POST['prix'])&& !empty($_POST['prix']))){
                            echo "veuillez inscrire le prix ! ";
                            
                        }else {
                            $prix=$_POST['prix'];
                            if(!(isset($_POST['date_input'])&& !empty($_POST['date_input']))){
                               echo "donnez la date de sortie";
                            }else{
                                $date=$_POST['date_input'];
                                if(!(isset($_POST['file'])&& !empty($_POST['file']))){
                                $file =$_FILES['file'];
        $name=$_FILES['file']['name'];
        $type=$_FILES['file']['type'];
        $size=$_FILES['file']['size'];
        $filetmp=$_FILES['file']['tmp_name'];
        $fileerror=$_FILES['file']['error'];
        #accepter que les images 
        $fileext=explode('.',$name);
        $fileactext =strtolower(end($fileext));
        $allowed =array('jpg','jpeg','png');
        if(in_array($fileactext,$allowed)){
            if($fileerror === 0){
                if($size<100000000){
                    $newname=uniqid('',true).".".$fileactext;
                    $filedest='upload/'.$newname;
                    if (move_uploaded_file($filetmp, $filedest)) {
                        $newnamedefault="imaged";
                        $sql = "INSERT INTO titre (titre,dt_sortie,img_name,dispo_virtuel) VALUES ('$new_title', '$date','$newnamedefault','0')";
                        if ($conn->query($sql) === TRUE) {
                            $chaine = "";
                            foreach($categories as $value ){
                                // Initialisation de la chaîne
                        $chaine = "";
                        
                        
                        switch ($value) {
                          
                            case 1:
                                $chaine = "Action";
                                break;
                            case 2:
                                $chaine = "Adventure";
                                break;
                            case 3:
                                $chaine = "Arcade";
                                break;
                            case 4:
                                $chaine = "Coop";
                                break;
                            case 5:
                                $chaine = "Fps";
                                break;
                            case 6:
                                $chaine = "Fight";
                                break;
                            case 7:
                                $chaine = "Free To Play";
                                break;
                            case 8:
                                $chaine = "MMO";
                                break;
                            case 9:
                                $chaine = "Multiplayer";
                                break;
                            case 10:
                                $chaine = "Platformer";
                                break;
                            case 11:
                                $chaine = "RPG";
                                break;
                            case 12:
                                $chaine = "Simulation";
                                break;
                            case 13:
                                $chaine = "Single-player";
                                break;
                            case 14:
                                $chaine = "Sport";
                                break;
                            case 15:
                                $chaine = "Strategie";
                                break;
                            case 16:
                                $chaine="WARS";
                            default:
                                $chaine = "Valeur hors de la plage spécifiée";
                        }
                                $sql = "INSERT INTO categories (categorie,titre ) VALUES ('$chaine','$new_title')";
                                $conn->query($sql);






                    } else {
                        echo "Erreur lors du téléchargement du fichier.";
                    }    
} else{
    echo "your file is too big";
}} else{
    echo "there was an error uploading this file";
} }else {
    echo "wrong type of file";
}}else{ echo "veuiller introduire une image ";

}}
}
}
}

}else{
echo "veuillez entrez un titre ";
} }

}
}

$chaine = "";

// Switch pour assigner les valeurs correspondantes à la chaîne
switch ($platforme) {
    case 2:
        $chaine = "Steam";
        break;
    case 3:
        $chaine = "Rockstar";
        break;
    case 4:
        $chaine = "Ubisoft";
        break;
    case 5:
        $chaine = "Nintendo Switch";
        break;
    case 6:
        $chaine = "Playstation 5";
        break;
    case 7:
        $chaine = "Playstation 4";
        break;
    case 8:
        $chaine = "Xbox series X|S";
        break;
    case 9:
        $chaine = "Xbox One";
        break;
    default:
        $chaine = "Valeur inconnue";
}
if($flag==0){
    $sql = "SELECT * FROM titre WHERE titre = '$new_title'";
    $result = $conn->query($sql);

if (($result->num_rows > 0)) {
    while ($row = $result->fetch_assoc()) {
        
        $newname=$row['img_name'];
    }
}
}
$sql = "INSERT INTO jeux_physique (prix,solde,titre,qte,id_boutique,nb_ventes,platforme,img_name) VALUES ('$prix','$Solde','$new_title','$qte','$idboutique', '0','$chaine','$newname')";
if ($conn->query($sql) === TRUE) {
    echo " jeu mis en vente ";
}else {
    echo "Erreur : " . $sql . "<br>" . $conn->error;
    $sql = "DELETE FROM titre WHERE $titre=$new_title";
    $conn->query($sql);}






}
?>
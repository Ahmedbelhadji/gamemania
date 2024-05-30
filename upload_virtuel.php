<?php 


if(isset($_POST['submit'])){ 
    $platforme=$_POST['Platforme'];
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
if($chaine=="Valeur inconnue"){
    die("veuillez selectionnez une plateforme");
    header("#");
}

$new_title=$_POST['Titre'];
try {
    $pdo = new PDO('mysql:host=localhost;dbname=test1;charset=utf8mb4', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);

    
    $stmt = $pdo->prepare('SELECT * FROM jeu_virtuel WHERE titre = ? and dispo_virtuel=1 and plateforme=? ');
    $stmt->execute([$new_title],[$chaine]);
    $exists = $stmt->fetchColumn();
    if ($exists) {
        
        die("le titre que vous avez inseret existe deja"); 
    header("#");
    } 
    
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

$Solde=$_POST['solde'];
$prix=$_POST['prix'];
$idboutique='1';


//verification de la date de sortie 
$date = $_POST['date1']; 
$timestamp = strtotime($date);
if (!($timestamp !== false && date('Y-m-d', $timestamp) === $date)) {
    die("la date n'est pas valide");
    header("#");
}else{
    if($date>date('Y-m-d')){

        die("la date de sortie n'est pas valide");

    }
}

// enregistrement des categories sous forme d'une chaine de caracteres 
if(isset($_POST['choix']) && is_array($_POST['choix']) && count($_POST['choix']) > 0){
$categories=implode(',',$_POST["choix"]);
echo $categories;
}else{
    die("veuillez choisir une categorie");
}



if(!(isset($_POST['file'])&& !empty($_POST['file']))){
    $file =$_FILES['file'];
$name=$_FILES['file']['name'];
$type=$_FILES['file']['type'];
$size=$_FILES['file']['size'];
$filetmp=$_FILES['file']['tmp_name'];
$fileerror=$_FILES['file']['error'];
//accepter que les images 
$fileext=explode('.',$name);
$fileactext =strtolower(end($fileext));
$allowed =array('jpg','jpeg','png');
if(in_array($fileactext,$allowed)){
if($fileerror === 0){
if($size<100000000){
$newname=uniqid('',true).".".$fileactext;
$filedest='upload/'.$newname;
if (move_uploaded_file($filetmp, $filedest)) {
    



    //ajout du jeu 
echo "Votre produit a etait deposer avec succées" ;header("#"); 
} else {
die("Erreur lors du téléchargement du fichier.");header("#");
}
}else{
die("your file is too big");header("#");
}

}else{
die("there was an error uploading this file");header("#");
}

}else {
die("wrong type of file");header("#");
}
}else{ die("veuiller introduire une image ");header("#");

}





}


?>
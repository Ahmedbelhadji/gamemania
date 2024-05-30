<?php 


if(isset($_POST['submit'])){ 



    
$flag=0;
if(isset($_POST['myCheckbox'])){
   if(isset($_POST['Titre'])) {$new_title=$_POST['Titre'];}else{ 
   die("veuillez inserer un titre valide");
   header("#");
   }

}else{
    if(isset($_POST['options'])){
   $new_title=$_POST['options'];
   $flag=1;
}else{
    die("veuillez choisir ou inserer un titre valide");
   header("#");

}
}

$platforme=$_POST['Platforme'];
$Solde=$_POST['solde'];
$prix=$_POST['prix'];
$qte=$_POST['qte'];
$idboutique='1';
$chaine = "";

$date = $_POST['date']; 

    if($date>date('Y-m-d')){

        die("la date n'est pas valide");

    }

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
// enregistrement des categories sous forme d'une chaine de caracteres 

if(isset($_POST['choix']) && is_array($_POST['choix']) && count($_POST['choix']) > 0){
    $categories=implode(',',$_POST["choix"]);
    echo $categories;
    }else{
        die("veuillez choisir une categorie");
    }
// verifications des caracteristiques de la photo puis ajout du produits     
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
if($flag==0){
    $val=move_uploaded_file($filetmp, $filedest);
}else{
    $val=TRUE;
    //$newname=le nom de limage qui est associer au titre dans la base de données
}
if ($val) {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=test1;charset=utf8mb4', 'root', '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
    
        
        $stmt = $pdo->prepare('SELECT * FROM titre WHERE titre = ? ');
        $stmt->execute([$new_title]);
        $exists = $stmt->fetchColumn();
        if (!($exists)) {
            
            //le titre n'existe pas il va falloire l'ajouter a la table titre 
        header("#");
        } 
        
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }



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
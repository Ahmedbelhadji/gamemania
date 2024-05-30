<?php 
session_start();
if (isset($_SESSION['mail'])&&isset($_SESSION['pass'])) {}


$id_proprio=1;
if(isset($_POST['submit'])){ 
$nom=$_POST['Name'];
$categorie=$_POST['Categorie'];
$plateforme=$_POST['Platforme'];
$prix=$_POST['prix'];
$solde=$_POST['solde'];
$des=$_POST['description'];

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
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=gamemania;charset=utf8mb4', 'root', '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
    
        
        $stmt = $pdo->prepare('INSERT INTO accessoires (nom,categorie,plateforme,solde,prix,description,nom_img,ID_PROPRIETAIRE) VALUES (?,?,?,?,?,?,?,?)');
        $stmt->execute([$nom,$categorie,$plateforme,$solde,$prix,$des,$newname,$id_proprio]);
        $exists = $stmt->fetchColumn();
        if ($exists) {
            
            die("le nom de la plateforme n'as pas etait ajouter"); 
            
        header("#");
        } 
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
die( "Votre produit a etait deposer avec succées");header("#"); 
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
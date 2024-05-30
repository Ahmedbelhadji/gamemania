<?php

session_start();
if(isset($_POST['submit'])){
    
    $platforme=$_POST['Platforme'];
    $conn = new mysqli("localhost","root", "","gamemania" );

//Vérifier la connexion
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['myCheckboxp'])){
  
    //et la chaine prend ça valeur et on indique avec le flag que c'est une nouvelle plateforme pour la suite du code 
    if(isset($_POST['nomp'])){
        //et la chaine prend ça valeur et on indique avec le flag que c'est une nouvelle plateforme pour la suite du code 
        $chaine=$_POST['nomp'];
        $flag=1;
        
$sql = "SELECT nom_plateforme FROM plateforme_abonnement WHERE nom_plateforme='$chaine'";
$result = $conn->query($sql);

//si il existe il est stocker dans la chaine 
if ($result->num_rows > 0) {
   while($row = $result->fetch_assoc()) {
    
    header("Location: ajout_abonnement.php?error=1");
   
   }
    


}
    }else{
            echo"veuillez tapez le titre";
        }
  
}else{
    
       // verification que le nom de la plateforme existe 
$sql = "SELECT nom_plateforme FROM plateforme_abonnement WHERE IDP='$platforme'";
$result = $conn->query($sql);
$flag=0;

//si il existe il est stocker dans la chaine 
if ($result->num_rows > 0) {
   while($row = $result->fetch_assoc()) {
    $chaine=$row['nom_plateforme'];
    $flag=0;
   
   }
    


}


}






$format=$_POST['format'];
$delait=$_POST['delait'];
if(($format==1)){
    $format="Mois";

}else{
    $format="Jours";
}

try {
    $pdo = new PDO('mysql:host=localhost;dbname=gamemania;charset=utf8mb4', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);

    
    $stmt = $pdo->prepare('SELECT * FROM abonnement WHERE nom_plateforme = ? and format_delait= ? and delait = ?');
    $stmt->execute([$chaine,$format,$delait]);
    $exists = $stmt->fetchColumn();
    if ($exists) {
        
        exit("l'abonnement existe deja "); 
    header("#");
    } 
    
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

    $Solde=$_POST['solde'];
    $prix=$_POST['prix'];
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




    if($flag==1){
        
        //si la platforme n'existe pas on ajoute une nouvelle image 
    $val=move_uploaded_file($filetmp, $filedest);
    
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=gamemania;charset=utf8mb4', 'root', '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
    
        
        $stmt = $pdo->prepare('INSERT INTO plateforme_abonnement (img_name, nom_plateforme) VALUES (?,?)');
        $stmt->execute([$newname,$chaine]);
        $exists = $stmt->fetchColumn();
        if ($exists) {
            
            die("le nom de la plateforme n'as pas etait ajouter"); 
            
        header("#");
        } 
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

}else{
        $val=true;}
        
        
    if ($val) {
        //ici val verifie que l image a etait ajouter sinon elle est vrai 
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=gamemania;charset=utf8mb4', 'root', '', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);
        
            
            $stmt = $pdo->prepare('INSERT INTO abonnement (nom_plateforme,format_delait,delait,solde,prix
            ) VALUES (?,?,?,?,?)');
            $stmt->execute([$chaine,$format,$delait,$Solde,$prix]);
            $exists = $stmt->fetchColumn();
            if ($exists) {
                
                echo"le nom de la plateforme n'as pas etait ajouter"; 
                exit();
            header("ajout_abonnement.php");
            } 
    
        //ajout abonnement 
        echo"votre produit a etait ajouter avec succées"; 
        exit();
    header("ajout_abonnement.php"); 
    }  catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
      }
    }else{
    die("fichier trop volumineux");header("#");
    }
    
    }else{
    die("une erreur est survenue lors du televersement");header("#");
    }
    
    }else {
    die("mauvais format ");header("#");
    }
    }else{ die("veuiller introduire une image ");header("#");
    
    }
    
    
    
    
    
    }
    


?>
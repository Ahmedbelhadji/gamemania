<?php

if(isset($_POST['submit'])|| isset($_POST['submit2'])){
    
    $conn = new mysqli("localhost","root", "","test1" ); 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    if(isset($_POST['submit'])){
        if((isset($_POST['password'])&& !empty($_POST['password']))){
        if((isset($_POST['Email'])&& !empty($_POST['Email'])) ){
        $pass=$_POST['password'];
        $mail=$_POST['Email'];

        $sql="SELECT * from client WHERE mail='$mail' AND hash_password='$pass' ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            session_start();
            $_SESSION['connecte']=1;
            //header();
            //exit();
         }
        }else{ echo "veuillez tapez votre  Email";}
    }else{echo "veuillez tapez votre mot de passe";}


    }else{
        if((isset($_POST['password'])&& !empty($_POST['password']))){
            if((isset($_POST['Email'])&& !empty($_POST['Email'])) ){
            $pass=$_POST['password2'];
            $mail=$_POST['Email2'];
    
            $sql="SELECT *  from boutique WHERE mail='$mail' AND hash_password='$pass' ";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                session_start();
            $_SESSION['connecte']=2;
           // header();
            //exit();
                
             }
            }else{ echo "veuillez tapez votre  Email";}
        }else{echo "veuillez tapez votre mot de passe";}




    }
}



?>
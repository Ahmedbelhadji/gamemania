<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title></title>
<script src="ajout_jeux_virtuel.js"></script>
<style>
    ul{
      list-style-type: none;
      padding:5px;
      
      
    }
    ul li {
        margin-bottom: 10px;
        
        
        
    }
   
    .container{
        display: flex;
    justify-content: center; /* Centrage horizontal */
    align-items: center; /* Centrage vertical */
    height: 100vh;

    }
    
   
</style>
</head>
<body>
<div class="container">
<form action="upload_virtuel.php" method="POST" enctype="multipart/form-data">

<h2> veuillez remplire les informations selon les informations du constructeur</h2>

    
   <ul class="liste" ><li > 
        <label> verifiez que le jeu n'existe pas si oui cocher la case et inscrivez le titre  </label><br>
        <input list="options" id="choix1" name="choix1">
  <datalist id="options">
  
  <?php
    
   

   $conn = new mysqli("localhost","root", "","test1" );

    //Vérifier la connexion
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }

    //Requête SQL pour récupérer les données de la colonne spécifique
   $sql = "SELECT titre FROM titre where dispo_virtuel='1'";
   $result = $conn->query($sql);

    //Afficher les options du menu déroulant
   if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {
        echo "<option value='" . $row["titre"] . "'>" . $row["titre"] . "</option>";
       }
    } else {
       echo "<option value=''>Aucune option disponible</option>";
   }
   ?>
   </datalist>

   
        
   <input type="checkbox" id="myCheckbox" onclick="toggleText()">
   <p id="myText" style="display:none;"><label for="Titre" >Titre :</label><br>
  <input type="text"  id="Titre" name="Titre" require ><br></p></li>
  <li>
  <label for="Categorie">Catégorie :</label><br>
    <input  type="checkbox" id="option1" name="choix[]" value="1">
    <label for="option1">Action</label>
    <input type="checkbox" id="option2" name="choix[]" value="2">
    <label for="option2">Adventure</label>
    <input type="checkbox" id="option3" name="choix[]" value="3">
    <label for="option3">Arcade</label>
    <input type="checkbox" id="option4" name="choix[]" value="4">
    <label for="option4">Coop</label><br>
    <input type="checkbox" id="option5" name="choix[]" value="5">
    <label for="option5">Fps</label>
    <input type="checkbox" id="option6" name="choix[]" value="6">
    <label for="option6">Fight</label>
    <input type="checkbox" id="option7" name="choix[]" value="7">
    <label for="option7">Free To Play</label>
    <input type="checkbox" id="option8" name="choix[]" value="8">
    <label for="option8">MMO</label>
    <input type="checkbox" id="option9" name="choix[]" value="9">
    <label for="option9">Multiplayer</label><br>
    <input type="checkbox" id="option10" name="choix[]" value="10">
    <label for="option10">Platformer</label>
    <input type="checkbox" id="option11" name="choix[]" value="11">
    <label for="option11">RPG</label>
    <input type="checkbox" id="option12" name="choix[]" value="12">
    <label for="option12">Simulation</label>
    <input type="checkbox" id="option13" name="choix[]" value="13">
    <label for="option13">Single-player</label>
    <input type="checkbox" id="option14" name="choix[]" value="14">
    <label for="option14">Sport</label>
    <input type="checkbox" id="option15" name="choix[]" value="15">
    <label for="option15">Strategie</label>
    <input type="checkbox" id="option16" name="choix[]" value="16">
    <label for="option16">WARS</label><br>

    <label for="Platforme">Platforme : </label><br>
  <select name="Platforme" id="Platforme">
  <option value="1">Platforme</option>
    <option value="2">Steam</option>
    <option value="3">Rockstar</option>
    <option value="4">Ubisoft</option>
    <option value="5">Nintendo Switch</option>
    <option value="6">Playstation 5</option>
    <option value="7">Playstation 4</option>
    <option value="8">Xbox series X|S</option>
    <option value="9">Xbox One</option>
  </select><br>
  <label >Montant de la solde</label>

  
<input type="range" min="0" max="100" step="5" value="0" name="solde" id="solde">
<div id="rangeValue"> 0</div>

<label>Introduisez le prix en dinar </label>
<input type="number" name="prix" min="1" required/><br>

<label for="date">donnez la date de sortie</label>
<input type="date" name="date1" required><br>


<label for="file">Image de la jaquette :</label><br>
<input type="file" name="file" required><br><br>


  
  <input type="submit" name="submit" value="Ajouter">
  </li>
  </form>
  </div>
  
 
    
<script>
 const rangeInput = document.getElementById('solde');
const rangeValue = document.getElementById('rangeValue');

// Met à jour la valeur affichée lorsque l'utilisateur modifie le curseur
rangeInput.addEventListener('input', function() {
    rangeValue.textContent = rangeInput.value;
});
</script>

 
    
</body>
</html>

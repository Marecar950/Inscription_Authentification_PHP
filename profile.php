<?php
  session_start();

  if($_SESSION["autoriser"] != "oui") 
 {
   header("location:connexion.php");
 }
   $bonjour = "Bonjour ".$_SESSION["Prenom"];   
   $votre_identifiant = "Votre identifiant : ".$_SESSION["ID"];   
   $votre_nom = "Votre nom : ".$_SESSION["NOM"];   
   $votre_prenom = "Votre prénom : ".$_SESSION["PRENOM"];   
   $votre_email = "Votre adresse email : ".$_SESSION["EMAIL"];
  
?>

<!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <title>Profile</title>
      <link rel="stylesheet" href="bootstrap.css">
      
      <style>
      
      .lien_connexion {
        text-align: right;
        font-size: 18pt;
      }
      
      .titre {
        color: blue;
        text-align: center;
      }
      
      </style>
      
    </head>
    <body style= "background-color:azure">
    
    <nav class="navbar navbar-dark bg-danger">
      <div class="container">
      <div class="navbar-nav ms-auto">
         <a class="navbar-brand" href="deconnexion.php">Déconnexion</a>
      </div>
      </div>
   </nav>
     
    <div class="titre">
      <h2><?php echo $bonjour?></h2>
    </div>
     
      <div class="container-fluid"> 
      <h3>Voici vos informations personnelles :</h3><br />
      <p><?php echo $votre_identifiant?></p>
      <p><?php echo $votre_nom?></p>
      <p><?php echo $votre_prenom?></p>
      <p><?php echo $votre_email?></p>
      </div>
      
    </body>
 </html>

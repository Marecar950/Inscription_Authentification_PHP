<?php
  session_start();
  if($_SESSION["autoriser"] != "oui") 
 {
   header("location:connexion.php");
   exit();
 }
   $bonjour = "Bonjour ".$_SESSION["Prenom"];   
   $votre_identifiant = "Votre identifiant : ".$_SESSION["ID"];   
   $votre_nom = "Votre nom : ".$_SESSION["NOM"];   
   $votre_prenom = "Votre prenom : ".$_SESSION["PRENOM"];   
   $votre_email = "Votre adresse email : ".$_SESSION["EMAIL"];   
?>

<!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8" />
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
    <body>
    
    <div class="lien_connexion">
      <a href="connexion.php">Se déconnecter</a>
    </div>
     
    <div class="titre">
      <h2><?php echo $bonjour?></h2>
    </div>
      
      <h3>Voici vos informations personnelles :</h3>
      
      <p><?php echo $votre_identifiant?></p>
      <p><?php echo $votre_nom?></p>
      <p><?php echo $votre_prenom?></p>
      <p><?php echo $votre_email?></p>
    </body>
 </html>

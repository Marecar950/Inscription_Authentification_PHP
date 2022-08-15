<?php

  session_start();
  
  if($_SESSION["autoriser"] != "oui") {
     header("location:verification_mail.php");
  }
  
  $mdp = $_POST['mot-de-passe'];
  $MDP = md5($mdp);
  $confirm_mdp = $_POST['Confirm_mdp'];
  $confirmation = $_POST['confirmation'];
  $email = $_SESSION["Email"];
  
  if(isset($confirmation)) {
   if(empty($mdp)) $erreur_mdp = "Veuillez entrer un nouveau mot de passe !";
   if(empty($confirm_mdp)) $erreur_confirmation = "Veuillez entrer la confirmation de mot de passe !";
   
   if(!empty($mdp) && !empty($confirm_mdp)) {
     
     if($mdp == $confirm_mdp) {
     include("connexion_base.php");
         
     $req=$pdo->prepare("update utilisateurs set mot_de_passe=:mdp where mail=:email");
     $execution=$req->execute(array(":mdp"=>$MDP,":email"=>$email));
     $success = '<div class="alert alert-success">Votre mot de passe à bien été mis à jour.</div>';
     } else if($mdp != $confirm_mdp) {
         $erreur = "La confirmation et le mot de passe ne sont pas identiques !";  
     }
   }
   }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Confirmation</title>
    <link rel="stylesheet" href="bootstrap.css">
    
    <style>
    
    h1 {
      text-align: center;
    }
    h2 {
      text-align: center;
      color: blue;
    }
    input {
      padding: 15px;
      border-radius: 10px;
      width: 24%;
    }
    .form {
      text-align: center;
    }
    .Erreur_mdp, .Confirm_mdp, .Erreur {
      color: red;
    }
    </style>
    
  </head>
    <body>
    
     <h1>Confirmation de votre mot de passe</h1><br />
     <h2>Veuillez confirmer votre mot de passe :</h2><br />
    
    <div class="form">
      <form method="post" action="">
      
        <?php echo $success ?>
        <input type="password" name="mot-de-passe" placeholder="Entrez un nouveau mot de passe :" /><br />
        <div class="Erreur_mdp"><?php echo $erreur_mdp ?></div><br />
        <input type="password" name="Confirm_mdp" placeholder="Confirmez votre nouveau mot de passe :" /><br />
        <div class="Confirm_mdp"><?php echo $erreur_confirmation ?></div><br />
        <button class="btn btn-success btn-lg" name="confirmation">Confirmer</button>
        <div class="Erreur"><?php echo $erreur ?></div>
      </form>
    </div>
      
    </body>
</html>  

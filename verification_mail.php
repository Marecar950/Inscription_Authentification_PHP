<?php

  session_start();

  $mail = $_POST["verification_mail"];
  $verification = $_POST["verification"];
  
  if(isset($verification)) {
    if(empty($mail)) $erreur_mail = "Veuillez entrez votre adresse email !"; 
    include("connexion_base.php");
    
    $req=$pdo->prepare("select * from utilisateurs where mail=?");
    $req->execute(array($mail));
    $tab=$req->fetchAll();
    
    if($tab) {
      $_SESSION["Email"] = $tab[0]["mail"];
      $_SESSION["autoriser"] = "oui";
      header("location:confirmation_mdp.php");
  } else if(!$tab && !empty($mail)) {
      $Erreur = "Email n'existe pas !";
  }
  }
  
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Verification</title>
    <link rel="stylesheet" href="bootstrap.css">
    
    <style>
    
      h1 {
       text-align: center;
      }
      h2 {
       text-align: center;
       color: green;
      }
      input {
       padding: 15px;
       border-radius: 10px;
      }
      .form {
        text-align: center;
      }
      .Erreur_mail, .Erreur {
        color: red;
      }
      
    </style>
  </head>
  
   <body>
     <h1>Confirmation de votre adresse email</h1><br />
     <h2>Veuillez confirmer votre adresse email :</h2><br />
     
     
     <div class="form">
       <form method="post" action="">
       <input type="text" name="verification_mail" placeholder="Votre email :" /><br />
       <div class="Erreur_mail"><?php echo $erreur_mail ?></div><br />
       <button class="btn btn-warning btn-lg" name="verification">Vérifier</button>
       <div class="Erreur"><?php echo $Erreur ?></div>
       </form>
    </div>
    
   </body>
   
</html>

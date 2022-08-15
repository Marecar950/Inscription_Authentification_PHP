<?php

   session_start();
   
   $mail = $_POST["mail"];
   $pass = $_POST['mot-de-passe'];
   $hach = md5($pass);
   $validation = $_POST["validation"];
   
   if(isset($validation)) {
      if(empty($mail)) $erreur_mail ="Veuillez entrer votre adresse email !";
      if(empty($pass)) $erreur_mdp ="Veuillez entrer votre mot de passe !";
      include("connexion_base.php");
      
      $req=$pdo->prepare("select * from utilisateurs where mail=? and mot_de_passe=?");
      $req->execute(array($mail,$hach));
      $tab = $req->fetchAll();
      
      if($tab) {
        
        $_SESSION["Prenom"]=ucfirst(strtolower($tab[0]["prenom"]));
        $_SESSION["ID"]= $tab[0]["id"];
        $_SESSION["NOM"]= $tab[0]["nom"];
        $_SESSION["PRENOM"]= $tab[0]["prenom"];
        $_SESSION["EMAIL"]= $tab[0]["mail"];
        $_SESSION["autoriser"] = "oui";
        header("location:profile.php");
      }
      else if(!$tab && !empty($mail) && !empty($pass)) {
        $erreur_incorrect = "Email ou mot de passe incorrect !";
      }
     }
         
?>

<!DOCTYPE html>
<html>
   <head>
     <meta charset="utf-8">
     <title>Connexion</title>
        <link rel="stylesheet" href="bootstrap.css">
        
      <style>
      
         .navbar-brand {
           font-size: 25px;
         }
         h1 {
           text-align: center;
         }
         h2 {
           text-align: center;
           color: blue;
         }
         .Formulaire {
            text-align: center;
         } 
         input {
            padding: 15px;
            border-radius: 10px;
         }
         .Bouton_centre {
            margin-left: 10%; 
         }
         .Erreur_mail, .Erreur_mdp, .Erreur_incorrect {
            color: red;
         }
         
      </style>
   </head>
   <body style="background-color:lightblue;">
   
     <nav class="navbar navbar-dark bg-primary">
       <div class="container">
       <div class="navbar-nav ms-auto">
         <a class="navbar-brand" href="inscription.php">Inscription</a>
       </div>
       </div>
     </nav>
     
     <h1>Bienvenue dans la page de connexion</h1>
     <h2>Veuillez vous authentifier :</h2>
     
     <div class="Formulaire">
      <form method="post" action="">
         <input type="text" name="mail" placeholder="Votre email :" /><br />
         <div class="Erreur_mail"><?php echo $erreur_mail ?></div> <br />
         <input type="password" name="mot-de-passe" placeholder=" Votre mot de passe :" /><br />
         <div class="Erreur_mdp"><?php echo $erreur_mdp ?></div> <br />

     <div class="Bouton_centre">
       <button class="btn btn-success btn-lg" name="validation">Se connecter</button>
       </form>
     </div>
       <a class="mdp_oublier" href="verification_mail.php">Mot de passe oublié ? Cliquez ici</a>
     <div class="Erreur_incorrect">
        <?php echo $erreur_incorrect ?>
     </div> <br />
     
     </div>
     
   </body>
</html> 

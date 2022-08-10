<?php
   session_start();
   
   $mail=$_POST["mail"];
   $pass=$_POST["mot-de-passe"];
   $Pass = md5($pass);
   $validation=$_POST["validation"];
   
   $erreur_mail;
   $erreur_mdp;
   $erreur_incorrect;
   
   if(isset($validation)) {
      if(empty($mail)) $erreur_mail ="Veuillez entrer votre adresse email !";
      if(empty($pass)) $erreur_mdp ="Veuillez entrer votre mot de passe !";
      include("connexion_base.php");
      $req=$pdo->prepare("select * from utilisateurs where mail=? and mot_de_passe=?");
      $req->execute(array($mail,$Pass));
      $tab = $req->fetchAll();

      if(count($tab)>0) {
        $_SESSION["Prenom"]=ucfirst(strtolower($tab[0]["prenom"]));
        $_SESSION["ID"]= $tab[0]["id"];
        $_SESSION["NOM"]= $tab[0]["nom"];
        $_SESSION["PRENOM"]= $tab[0]["prenom"];
        $_SESSION["EMAIL"]= $tab[0]["mail"];
        $_SESSION["autoriser"] = "oui";
        header("location:profile.php");
      }
      else if(!count($tab) && !empty($mail) && !empty($pass)) {
        $erreur_incorrect = "Email ou mot de passe incorrect !";
      }
     }
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <style>
      
         .lien_inscription {
           text-align: center;
           font-size: 18pt;
         }
         h2{
            text-align: center;
            color: blue;
         }
         .Formulaire {
            text-align: center;
         } 
         input {
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 10px;
         }
         .Bouton_centre {
            margin-left: 50%;
         }
         .Bouton {
            background-color: orange;
            width: 20%;
            padding: 12px;
            font-size: 16px;
         }
         .Erreur_mail, .Erreur_mdp {
            color: red;
         }
         .Erreur_incorrect{
            color: red;
            text-align: center;
         }
         
      </style>
   </head>
   <body style="background-color:powderblue;">
   
     <div class="lien_inscription">
      <a href="inscription.php" style="color:blue">Incription</a>
     </div>
     
     <h2>Veuillez vous authentifier :</h2>
     
     <div class="Formulaire">
      <form method="post" action="">
         <input type="text" name="mail" placeholder="Email :" /><br />
         <div class="Erreur_mail"><?php echo $erreur_mail ?></div> <br />
         <input type="password" name="mot-de-passe" placeholder="Mot de passe :" /><br />
         <div class="Erreur_mdp"><?php echo $erreur_mdp ?></div> <br />
     </div>

     <div class="Bouton_centre">
       <button class="Bouton" name="validation">Se connecter</button>
       </form>
     </div>
      
     <div class="Erreur_incorrect">
        <?php echo $erreur_incorrect ?>
     </div> <br />
     
   </body>
</html> 

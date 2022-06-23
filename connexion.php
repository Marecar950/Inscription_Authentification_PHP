<?php
   session_start();
   $mail=$_POST["mail"];
   $pass=$_POST["mot-de-passe"];

   $validation=$_POST["validation"];
   $erreur ="";
   $Erreur ="";
   $ERR ="";
   
   if(isset($validation)){
      if(empty($mail)) $erreur ="<li>Veuillez entrer votre adresse email !</li>";
      if(empty($pass)) $Erreur ="<li>Veuillez entrer votre mot de passe !</li>";
      include("connexion_base.php");
      $req=$pdo->prepare("select * from utilisateurs where mail=? and mot_de_passe=?");
      $req->execute(array($mail,$pass));
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
      
      if((!empty($mail)) AND (!empty($pass))){
        $ERR = "Email ou mot de passe incorrect !";
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
         .erreur{
            color: red;
         }
         .Erreur{
            color: red;
            text-align: center;
         }
         
      </style>
   </head>
   <body style="background-color:powderblue;">
   
     <div class="lien_inscription">
      <a href="inscription.php">Incription</a>
     </div>
     
     <h2>Veuillez vous authentifier :</h2>
     
     <div class="Formulaire">
      <form method="post" action="">
         <input type="text" name="mail" placeholder="Login" /><br />
         <div class="erreur"><?php echo $erreur ?></div>
         <input type="password" name="mot-de-passe" placeholder="Mot de passe" /><br />
     
       <div class="erreur">
         <?php echo $Erreur ?>
       </div>
     </div>

     <div class="Bouton_centre">
       <button class="Bouton" name="validation">Se connecter</button>
       </form>
     </div>
      
     <div class="Erreur">
        <?php echo $ERR ?>
     </div>
     
   </body>
</html> 

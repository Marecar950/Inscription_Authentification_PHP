<?php
   session_start();
   $nom=$_POST["nom"];
   $prenom=$_POST["prenom"];
   $mail=$_POST["mail"];
   $pass = $_POST['mot-de-passe'];
   $Pass = password_hash($pass, PASSWORD_BCRYPT);
   $confirmation_mdp=$_POST["confirmation_mdp"];
   $validation=$_POST["validation"];
   $erreur="";
   $Erreur="";
   $ERREUR="";
   $ERREURS="";
   $error="";
   
   if(isset($validation)){
      if(empty($nom)) $erreur ="<li>Le nom est obligatoire !</li>";
      if(empty($prenom)) $Erreur ="<li>Le prénom est obligatoire !</li>";
      if(empty($mail)) $ERREUR ="<li>L'adresse email est obligatoire !</li>";
      if(empty($pass)) $ERREURS ="<li>Le mot de passe est obligatoire !</li>";
      if(empty($confirmation_mdp)) $error ="<li>La confirmation de mot de passe est obligatoire !</li>";

      if(empty($erreur)){
         include("connexion_base.php");
         $req=$pdo->prepare("select mail from utilisateurs where mail=?");
         $req->execute(array($mail));
         $tab=$req->fetchAll();
         if(count($tab)>0)
            $ERREUR="L'adresse email existe déjà !";
         else{
           
            $requete=$pdo->prepare("insert into utilisateurs(nom,prenom,mail,mot_de_passe) values(?,?,?,?)");
            if($requete->execute(array($nom,$prenom,$mail,$Pass))) {
            header("location:connexion.php");
         }
         }   
      }
   }
?>
<!DOCTYPE html>
<html>
   <head>
     <meta charset="utf-8" />
     <style>
     
     .lien_connexion {
       text-align: center;
       font-size: 18pt;
     }
     h1 {
       text-align: center;
     }
     h2 {
       text-align: center;
       color: blue;
     }
     input {
       padding: 20px;
       border-radius: 10px;
       margin-bottom: 10px;
     }
     .formulaire {
       text-align: center;
     } 
     .bouton_centre {
       margin-left: 50%;
     }
      .bouton {
       background-color: orange;
       width: 14%;
       padding: 12px;
       font-size: 16px;
     } 
     .erreur {
       color: red;
     }
     .Erreur {
       color: red;
     }
     .ERREUR {
       color: red;
     }
     .ERREURS {
       color: red;
     }
     .error {
       color: red;
     } 
     
     </style> 
   </head>
   <body style="background-color:powderblue;">
   
   <div class="lien_connexion">
      <a href="connexion.php">Connexion</a>
   </div>
   
     <div class="titre">
      <h1>Bienvenue dans la page d'inscription</h1>
      <h2>Veuillez vous inscrire :</h2>
     </div>
     
     <div class="formulaire">
      <form method="post" action="">
         <input type="text" name="nom" placeholder="Votre nom :" value="<?php echo $nom?>" /><br />
         <div class="erreur"><?php echo $erreur ?></div>
         <input type="text" name="prenom" placeholder="Votre prénom :" value="<?php echo $prenom?>" /><br />
         <div class="Erreur"><?php echo $Erreur ?></div>
         <input type="text" name="mail" placeholder="Votre email :" value="<?php echo $mail?>" /><br />
         <div class="ERREUR"><?php echo $ERREUR ?></div>
         <input type="password" name="mot-de-passe" placeholder="Saissiez un mot de passe :" /><br />
         <div class="ERREURS"><?php echo $ERREURS ?></div>
         <input type="password" name="confirmation_mdp" placeholder="Confirmer votre mot de passe :" /><br />
         <div class="error"><?php echo $error ?></div>
     </div>
     
     <div class="bouton_centre">
       <button class="bouton" name="validation">S'inscrire</button> 
       </form>
     </div>
   </body>
</html> 

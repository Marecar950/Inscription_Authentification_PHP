<?php
   session_start();
   
   $nom = $_POST["nom"];
   $prenom = $_POST["prenom"];
   $mail = $_POST["mail"];
   $pass = $_POST['mot-de-passe'];
   $Pass = md5($pass);
   $confirmation_mdp = $_POST["confirmation_mdp"];
   $validation = $_POST["validation"];
   
   $erreur_nom;
   $erreur_prenom;
   $erreur_mail;
   $erreur_mdp;
   $erreur_ConfirmMdp;
   
   if(isset($validation)) {
      if(empty($nom)) $erreur_nom ="Le nom est obligatoire !";
      if(empty($prenom)) $erreur_prenom ="Le prénom est obligatoire !";
      if(empty($mail)) $erreur_mail ="L'adresse email est obligatoire !";
      if(empty($pass)) $erreur_mdp ="Le mot de passe est obligatoire !";
      if(empty($confirmation_mdp)) $erreur_ConfirmMdp ="La confirmation de mot de passe est obligatoire !";
      if($pass != $confirmation_mdp) $erreur_ConfirmMdp = "La confirmation et le mot de passe ne sont pas identiques !";
      
      if(!empty($nom) && !empty($prenom) && !empty($mail) && !empty($pass) && !empty($confirmation_mdp)) {
        include("connexion_base.php");
         
        $req=$pdo->prepare("select mail from utilisateurs where mail=?");
        $req->execute(array($mail));
        $tab=$req->fetchAll();
         
      if(count($tab)>0 && $pass === $confirmation_mdp) { 
        $erreur_mail="L'adresse email existe déjà !";
      }
      else if(!count($tab) && $pass === $confirmation_mdp) {
        $requete=$pdo->prepare("insert into utilisateurs(nom,prenom,mail,mot_de_passe) values(?,?,?,?)");
        $requete->execute(array($nom,$prenom,$mail,$Pass)); 
        header("location:connexion.php");
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
     .erreur, .Erreur, .Erreurs, .Error, .Errors {
       color: red;
     }
     
     </style>
      
   </head>
   <body style="background-color:powderblue">
   
   <div class="lien_connexion">
      <a href="connexion.php" style="color:green">Connexion</a>
   </div>
   
     <div class="titre">
      <h1>Bienvenue dans la page d'inscription</h1>
      <h2>Veuillez vous inscrire :</h2>
     </div>
     
     <div class="formulaire">
      <form method="post" action="">
         <input type="text" name="nom" placeholder="Votre nom :" value="<?php echo $nom?>" /><br />
         <div class="erreur"><?php echo $erreur_nom ?></div> <br />
         <input type="text" name="prenom" placeholder="Votre prénom :" value="<?php echo $prenom?>" /><br />
         <div class="Erreur"><?php echo $erreur_prenom ?></div> <br />
         <input type="text" name="mail" placeholder="Votre email :" value="<?php echo $mail?>" /><br />
         <div class="Erreurs"><?php echo $erreur_mail ?></div> <br />
         <input type="password" name="mot-de-passe" placeholder="Créez un mot de passe :" /><br />
         <div class="Error"><?php echo $erreur_mdp ?></div> <br />
         <input type="password" name="confirmation_mdp" placeholder="Confirmez votre mot de passe :" /><br />
         <div class="Errors"><?php echo $erreur_ConfirmMdp ?></div> <br />
     </div>
     
     <div class="bouton_centre">
       <button class="bouton" name="validation">S'inscrire</button> 
       </form>
     </div>
   </body>
</html> 

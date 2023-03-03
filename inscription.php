<?php 


// Inclusion de la config
require_once 'config.php';

// Inclusion des dépendances
require 'fonction.php';


// Démarrage de la session
session_start();

if (session_status() === PHP_SESSION_ACTIVE) {
    // Vous êtes dans une session active
    echo "Vous êtes dans une session active";
} else {
    // Vous n'êtes pas dans une session active
    echo "Vous êtes pas dans une session active";
}


$nom = '';
$prenom = '';
$dateNaissance = '';
$email = '';
$motDePasse = '';
$errors = [];
$success = null ;
$pdo = getPdoConnection();

// Vérifiez si le formulaire a été soumis
if (!empty($_POST)) {

    // Récupérez les valeurs des champs du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $dateNaissance = $_POST['date_naissance'];
    $date_naissance_mysql = date('Y-m-d', strtotime($dateNaissance));
    $email = $_POST['email'];
    $motDePasse = $_POST['mot_de_passe'];

    // Vérifiez si un abonné existe déjà avec la même adresse email
     if (checkEmailExistence($pdo , $email)) {
        // L'abonné existe déjà, affichez un message d'erreur
            $errors['email'] = "L'adresse email est déjà utilisée. <br> Veuillez en choisir une autre.";
        } 
        
        // Validation 
        if (!$email) {
            $errors['email'] = "Merci d'indiquer une adresse mail";
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "L'adresse email n'est pas valide.";
          }
    
        if (!$prenom) {
            $errors['prenom'] = "Merci d'indiquer un prénom";
        }
    
        if (!$nom) {
            $errors['nom'] = "Merci d'indiquer un nom";
        }

        
        if (!$motDePasse) {
            $errors['mot_de_passe'] = "Merci d'indiquer un mot de passe";
        }

        if (!$dateNaissance) {
            $errors['date_naissance'] = "Merci d'indiquer une date de naissance";
        }


        
    
        // Si tout est OK (pas d'erreur)
        if (empty($errors)) {
    
            // Ajout de l'email dans le fichier csv
            $utilisateur_id = addUtilisateur($nom, $prenom, $date_naissance_mysql, $email, $motDePasse);

            // Réinitialisation des champs du formulaire
            unset($_POST['nom']);
            unset($_POST['prenom']);
            unset($_POST['date_naissance']);
            unset($_POST['email']);
            unset($_POST['mot_de_passe']);
        

            // Vérification de la création du compte
            if ($utilisateur_id) {
                // Stockage de l'ID utilisateur dans la variable de session
                $_SESSION['user_id'] = $utilisateur_id;
                
            
            // Redirection vers la page d'accueil
            header("Location: index.php");
            exit;
      

        }
    }
}


// Affichage : inclusion du template
$template = 'inscription';
include 'base.phtml';
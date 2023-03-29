<?php

// Démarrage de la session
session_start();


// Inclusion de la config
require_once 'config.php';

// Inclusion des dépendances
require 'fonction.php';

// Vérifie si l'utilisateur est déjà connecté
if (isset($_SESSION['user_id'])) {
    header("Location: Accueil");
    exit();
}


$nom = '';
$prenom = '';
$dateNaissance = '';
$email = '';
$motDePasse = '';
$errors = [];
$success = null;
$pdo = getPdoConnection();

// Vérifiez si le formulaire a été soumis
if (!empty($_POST)) {

    // Récupérez les valeurs des champs du formulaire et supprimez les espaces inutiles
    $nom = trim(htmlspecialchars($_POST['nom']));
    $prenom = trim(htmlspecialchars($_POST['prenom']));
    $dateNaissance = trim(htmlspecialchars($_POST['date_naissance']));
    $date_naissance_mysql = date('Y-m-d', strtotime($dateNaissance));
    $email = trim(htmlspecialchars($_POST['email']));
    $motDePasse = trim(htmlspecialchars($_POST['mot_de_passe']));


    // Vérifiez si les champs nom et prénom contiennent uniquement des lettres et des espaces
    if (!preg_match("/^[a-zA-Z\s]*$/", $nom)) {
        $errors['nom'] = "Le nom ne peut contenir que des lettres.";
    }
    if (!preg_match("/^[a-zA-Z\s]*$/", $prenom)) {
        $errors['prenom'] = "Le prénom ne peut contenir que des lettres.";
    }

    // Mettez la première lettre en majuscule et le reste en minuscule
    $nom = ucwords(strtolower($nom));
    $prenom = ucwords(strtolower($prenom));


    // Vérifiez si un abonné existe déjà avec la même adresse email
    if (checkEmailExistence($pdo, $email)) {
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

    if (strlen($motDePasse) < 8) {
        $errors['mot_de_passe'] = "Le mot de passe doit avoir au moins 8 caractères.";
    }

    if (!$dateNaissance) {
        $errors['date_naissance'] = "Merci d'indiquer une date de naissance";
    }

    if (isset($_POST['date_naissance'])) {
        $date_naissance = new DateTime($_POST['date_naissance']);
        $now = new DateTime();
        $age = $now->diff($date_naissance)->y;
        if ($age < 18) {
            $errors['date_naissance'] = 'Vous devez avoir au moins 18 ans pour vous inscrire';
        }
    }


    // Si tout est OK (pas d'erreur)
    if (empty($errors)) {

        // Ajout de l'email dans le fichier csv
        $utilisateur_id = addUtilisateur($nom, $prenom, $date_naissance_mysql, $email, $motDePasse);

        // Initialisation de la session avec l'ID de l'utilisateur
        $_SESSION['user_id'] = $utilisateur_id;


        // Redirection vers la page de soumission
        header("Location: Accueil");
        exit();
    }
}




// Affichage : inclusion du template
$template = 'inscription';
include 'templates/base.phtml';

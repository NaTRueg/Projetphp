<?php

// Démarrage de la session
session_start();

// Vérifie si l'utilisateur est déjà connecté, si oui, redirige-le vers la page d'accueil
if (isset($_SESSION['user_id'])) {
    header("Location: Accueil");
    exit();
}



// Inclusion de init
require_once '../app/init.php';


// Initialisation des variables
$email = '';
$motDePasse = '';
$errors = [];

if (!empty($_POST)) {

    // Récupérez les valeurs des champs du formulaire
    $email = strip_tags(trim(htmlspecialchars($_POST['email'])));
    $motDePasse = strip_tags(trim(htmlspecialchars($_POST['mot_de_passe'])));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "L'adresse email n'est pas valide.";
    }

    // Vérifiez si l'utilisateur existe et que le mot de passe est correct
    $user = check_login($email, $motDePasse);
    if (!$user) {
        $errors['mot_de_passe'] = "L'adresse email ou le mot de passe est incorrect.";
    }

    if ($user) {

        // Stockage de l'ID utilisateur dans la variable de session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['prenom'] . ' ' . $user['nom'];
        $_SESSION['isAdmin'] = $user['isAdmin'];

        // Vérifier si l'utilisateur est connecté
        if (isset($_SESSION['user_id'])) {
            // Rediriger vers la page d'accueil
            header("Location: Accueil");
            exit;
        } else {
            // Le nom d'utilisateur ou le mot de passe est incorrect
            $errors['login'] = "L'adresse email ou le mot de passe est incorrect.";
        }
    }
}

// Définition de la variable $template
$template = '../templates/connexion';

// Inclusion du fichier base.phtml
include '../templates/base.phtml';

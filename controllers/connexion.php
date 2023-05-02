<?php

// Démarrage de la session
session_start();

// Vérifie si l'utilisateur est déjà connecté, si oui, redirige-le vers la page d'accueil
if (isset($_SESSION['user_id'])) {
    header("Location: Accueil");
    exit();
}



// Inclusion de la config
require_once '../app/config.php';

// Inclusion des dépendances
require '../lib/fonction.php';



// Initialisation des variables
$email = '';
$motDePasse = '';
$errors = [];

// Vérifiez si le formulaire a été soumis
if (!empty($_POST)) {

    // Récupérez les valeurs des champs du formulaire
    $email = htmlspecialchars(trim($_POST['email']));
    $motDePasse = htmlspecialchars($_POST['mot_de_passe']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "L'adresse email n'est pas valide.";
    }

    if (!check_login($email, $motDePasse)) {
        $errors['mot_de_passe'] = "L'adresse email ou le mot de passe est incorrect.";
    }

    // Vérifiez si l'utilisateur existe et que le mot de passe est correct
    if (check_login($email, $motDePasse)) {

        // Récupération de l'utilisateur depuis la base de données
        
        $sql = "SELECT id, prenom, nom, isAdmin  FROM utilisateur WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch();

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
include '../public/base.phtml';
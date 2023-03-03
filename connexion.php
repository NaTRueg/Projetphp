<?php

// Inclusion de la config
require_once 'config.php';

// Inclusion des dépendances
require 'fonction.php';

// Démarrage de la session
session_start();

// Initialisation des variables
$email = '';
$motDePasse = '';
$errors = [];

// Vérifiez si le formulaire a été soumis
if (!empty($_POST)) {

    // Récupérez les valeurs des champs du formulaire
    $email = $_POST['email'];
    $motDePasse = $_POST['mot_de_passe'];

    // Vérifiez si l'utilisateur existe et que le mot de passe est correct
    if (check_login($email, $motDePasse)) {

        // Récupération de l'utilisateur depuis la base de données
        $pdo = getPdoConnection();
        $sql = "SELECT id, prenom, nom FROM utilisateur WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        // Stockage de l'ID utilisateur dans la variable de session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['prenom'] . ' ' . $user['nom'];

        if ($utilisateur_id) {
            // Stockage de l'ID utilisateur dans la variable de session
            $_SESSION['user_id'] = $utilisateur_id;
        
            // Redirection vers la page d'accueil
            header("Location: index.php");
            exit;
        }

            } else {
                // Le nom d'utilisateur ou le mot de passe est incorrect
                $errors['login'] = "L'adresse email ou le mot de passe est incorrect.";
            }
        }

// Affichage : inclusion du template
$template = 'connexion';
include 'base.phtml';

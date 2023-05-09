<?php


// Démarrage de la session
session_start();

// Inclusion de init
require_once '../app/init.php';


// Vérifie si l'utilisateur est connecté en tant que super administrateur
if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 2) {
    // Autoriser l'accès aux pages pour les administrateurs normaux et les super administrateurs
} else {
    // Rediriger l'utilisateur vers la page d'erreur
    header('Location: Error');
    exit();
}

// Récupération de tous les utilisateurs
$query = "SELECT * FROM utilisateur";
$statement = $pdo->query($query);
$users = $statement->fetchAll();


if (isset($_POST['submit'])) {
    $user_id = $_POST['user_id'];
    $new_role = $_POST['role'];
    $query = "UPDATE utilisateur SET isAdmin = :isAdmin WHERE id = :id";
    $statement = $pdo->prepare($query);
    $statement->execute(array(
        ':isAdmin' => $new_role,
        ':id' => $user_id
    ));
    // Afficher un message de confirmation
    echo "Le rôle de l'utilisateur a été modifié avec succès.";

    header('Location: Utilisateurs');
    exit();
}

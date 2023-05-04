<?php


// Démarrage de la session
session_start();

// Inclusion de init
require_once '../app/init.php';

// Redirige vers la page d'accueil si l'utilisateur n'est pas admin
if (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] != 1) {
    header('Location: Error');
    exit();
}


// Récupération de tous les médecins
$medecins = getMedecins($pdo);


// Récupération de l'ID du médecin à modifier
$doctor_id = $_GET['id'];

// Récupération des villes
$query = "SELECT * FROM villes";
$stmt = $pdo->prepare($query);
$stmt->execute();
$villes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupération des spécialités
$query = "SELECT * FROM specialites";
$stmt = $pdo->prepare($query);
$stmt->execute();
$specialites = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupération des détails du médecin à modifier
$sql = "SELECT * FROM medecins WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $doctor_id);
$stmt->execute();
$medecin = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $doctor_id = $_POST['id'];
    $nom = strip_tags(trim(htmlspecialchars($_POST['nom'])));;
    $email = strip_tags(trim(htmlspecialchars($_POST['email'])));
    $ville_id = $_POST['ville']; // Ajout de cette variable
    $specialite_id = $_POST['specialite']; // Ajout de cette variable

    // Valider les données du formulaire
    if (empty($nom)) {
        $errors['nom'] = "Le nom est obligatoire";
    }

    if (empty($email)) {
        $errors['email'] = "L'email est obligatoire";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "L'email n'est pas valide";
    }

    if (empty($specialite_id)) {
        $errors['specialite_id'] = "La spécialité est obligatoire";
    }

    if (empty($ville_id)) {
        $errors['ville_id'] = "La ville est obligatoire";
    }

    $sql = "UPDATE medecins SET nom = :nom, email = :email, ville_id = :ville_id, specialite_id = :specialite_id WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nom', $nom);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':ville_id', $ville_id); // Ajout de cette variable
    $stmt->bindValue(':specialite_id', $specialite_id); // Ajout de cette variable
    $stmt->bindValue(':id', $doctor_id);
    $stmt->execute();

    header('Location: GérerDocteurs');
    exit();
}


// Définition de la variable $template
$template = '../templates/modifdoc';

// Inclusion du fichier base.phtml
include '../templates/base.phtml';

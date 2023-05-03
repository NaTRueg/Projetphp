<?php
// Démarrage de la session
session_start();

// Inclusion de la config
require_once '../app/config.php';


// Redirige vers la page d'accueil si l'utilisateur n'est pas admin
if (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] != 1) {
    header('Location: Error');
    exit();
}


// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $nom = trim(htmlspecialchars($_POST['nom']));;
    $email = trim(htmlspecialchars($_POST['email']));
    $specialite_id = $_POST['specialite_id'];
    $ville_id = $_POST['ville_id'];

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

    // S'il n'y a pas d'erreurs, insérer le médecin dans la base de données
    if (empty($errors)) {
        // Préparer la requête d'insertion
        $sql = "INSERT INTO medecins (nom, email, specialite_id, ville_id) VALUES (:nom, :email, :specialite_id, :ville_id)";
        $stmt = $pdo->prepare($sql);

        // Exécuter la requête d'insertion avec les données du formulaire
        $stmt->execute(array(
            ':nom' => $nom,
            ':email' => $email,
            ':specialite_id' => $specialite_id,
            ':ville_id' => $ville_id
        ));

        // Rediriger l'utilisateur vers la page des médecins
        header('Location: GérerDocteurs');
        exit();
    }
}

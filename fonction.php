<?php

// Inclusion de la config
require_once 'config.php';



function getPDOConnection() {

    // Construction du Data Source Name
    $dsn = 'mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8';

    // Tableau d'options pour la connexion PDO
    $options = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    // Création de la connexion PDO (création d'un objet PDO)
    $pdo = new PDO($dsn, DB_USER, DB_PASSWORD, $options);
    $pdo->exec('SET NAMES UTF8');
    
    return $pdo;
}

// $pdo = getPdoConnection();

function checkEmailExistence($pdo, $email)

{
    $sql = 'SELECT COUNT(*) FROM utilisateur WHERE email = ?';

    $query = $pdo->prepare($sql);
    $query->execute([$email]);

    return $query->fetchColumn() > 0;
}

function addUtilisateur(string $nom, string $prenom, string $dateNaissance, string $email, string $motDePasse){
    
    // Construction du Data Source Name
    $dsn = 'mysql:dbname=' . DB_NAME . ';host=' . DB_HOST;

    // Tableau d'options pour la connexion PDO
    $options = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    // Création de la connexion PDO (création d'un objet PDO)
    $pdo = new PDO($dsn, DB_USER, DB_PASSWORD, $options);
    $pdo->exec('SET NAMES UTF8');

    // Hachage du mot de passe
    $hash = password_hash($motDePasse, PASSWORD_DEFAULT);

    // Insertion des informations de l'utilisateur dans la table utilisateur
    $sql = 'INSERT INTO utilisateur (nom, prenom, date_naissance, email, mot_de_passe) VALUES (?, ?, ?, ?, ?)';

    $query = $pdo->prepare($sql);
    $query->execute([$nom, $prenom, $dateNaissance, $email, $hash]);
}



function check_login(string $email, string $motDePasse): bool {
    // Construction du Data Source Name
    $dsn = 'mysql:dbname=' . DB_NAME . ';host=' . DB_HOST;

    // Tableau d'options pour la connexion PDO
    $options = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    // Création de la connexion PDO (création d'un objet PDO)
    $pdo = new PDO($dsn, DB_USER, DB_PASSWORD, $options);
    $pdo->exec('SET NAMES UTF8');

    // Récupération du mot de passe haché de l'utilisateur dans la base de données
    $sql = 'SELECT mot_de_passe FROM utilisateur WHERE email = ?';

    $query = $pdo->prepare($sql);
    $query->execute([$email]);

    $result = $query->fetch();

    if (!$result) {
        // L'utilisateur n'existe pas dans la base de données
        return false;
    }

    $hash = $result['mot_de_passe'];

    // Vérification du mot de passe haché
    if (password_verify($motDePasse, $hash)) {
        // Le mot de passe est correct
        return true;
    } else {
        // Le mot de passe est incorrect
        return false;
    }
}

function getUserEmail($pdo, $userId) {
    $stmt = $pdo->prepare("SELECT email FROM utilisateur WHERE id = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch();
    return $user['email'];
}

function getUserName($pdo, $userId) {
    $stmt = $pdo->prepare("SELECT nom FROM utilisateur WHERE id = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch();
    return $user['nom'];
}

function getUserFirstname($pdo, $userId) {
    $stmt = $pdo->prepare("SELECT prenom FROM utilisateur WHERE id = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch();
    return $user['prenom'];
}
function getUserAge($pdo, $userId) {
    $query = "SELECT date_naissance FROM utilisateur WHERE id = ?";
    $statement = $pdo->prepare($query);
    $statement->bindParam(1, $userId, PDO::PARAM_INT);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $dob = $result['date_naissance'];
    
    // Calculer l'âge à partir de la date de naissance
    $today = new DateTime();
    $birthdate = new DateTime($dob);
    $age = $today->diff($birthdate)->y;
    
    return $age;
}

function deleteUserAndAppointments($pdo, $user_id) {
    // Démarrer une transaction
    $pdo->beginTransaction();

    try {
        // Supprimer tous les rendez-vous de l'utilisateur
        $query = "DELETE FROM rendez_vous WHERE utilisateur_id = ?";
        $statement = $pdo->prepare($query);
        $statement->execute([$user_id]);

        // Supprimer l'utilisateur de la base de données
        $query = "DELETE FROM utilisateur WHERE id = ?";
        $statement = $pdo->prepare($query);
        $statement->execute([$user_id]);

        // Valider la transaction
        $pdo->commit();

        return true;
    } catch (Exception $e) {
        // En cas d'erreur, annuler la transaction
        $pdo->rollback();

        return false;
    }
}

function getRendezVousUtilisateur($pdo, $utilisateur_id) {
    $sql = "SELECT rendez_vous.id, rendez_vous.heure, rendez_vous.date, medecins.nom AS nom_medecin
            FROM rendez_vous
            JOIN medecins ON rendez_vous.medecin_id = medecins.id
            WHERE rendez_vous.utilisateur_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$utilisateur_id]);
    $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $resultats;
}

function deleteRdv($pdo, $id) {
    $stmt = $pdo->prepare('DELETE FROM rendez_vous WHERE id = ?');
    $stmt->execute([$id]);
    return $stmt->rowCount() > 0;
}

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



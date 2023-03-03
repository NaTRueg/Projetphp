<?php

// // Inclusion de la config
// require_once 'config.php';

// class Database {

//     function getPDOConnection() {

//         // Construction du Data Source Name
//         $dsn = 'mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8';
    
//         // Tableau d'options pour la connexion PDO
//         $options = [
//             PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
//             PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
//         ];
    
//         // Création de la connexion PDO (création d'un objet PDO)
//         $pdo = new PDO($dsn, DB_USER, DB_PASSWORD, $options);
//         $pdo->exec('SET NAMES UTF8');
        
//         return $pdo;
//     }
// }
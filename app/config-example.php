<?php  

const DB_HOST = "your-host"; 
const DB_NAME = "your-db-name"; 
const DB_USER = "user";
const DB_PASS = "password";

// Inclusion des fonctions
require '../lib/Functions.php';

// Inclusion de la classe Database
require_once '../lib/Database.php';

// Inclusion de la classe User
require_once '../lib/User.php';

// Instanciation de la classe Database
$database = new Database();

// Appel de la méthode getPDOConnection() pour obtenir une instance de connexion PDO
$pdo = $database->getPDOConnection();

$user = new User($pdo);

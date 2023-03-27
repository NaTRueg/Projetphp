<?php


// Démarrage de la session
session_start();

// Inclusion de la config
require_once 'config.php';

// Inclusion des dépendances
require 'fonction.php';


// Connexion à la base de données
$pdo = getPdoConnection();


// Affichage : inclusion du template
$template = 'error';
include 'templates/base.phtml';
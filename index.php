<?php 


// Démarrage de la session
session_start();

// Inclusion de la config
require_once 'config.php';

// Inclusion des dépendances
require 'fonction.php';




// Affichage : inclusion du template
$template = 'index';
include 'templates/base.phtml';



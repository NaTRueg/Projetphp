<?php

// Démarrage de la session
session_start();

// Inclusion de la config
require_once '../app/config.php';

// Inclusion des dépendances
require '../lib/fonction.php';


// Définition de la variable $template
$template = '../templates/cgu';

// Inclusion du fichier base.phtml
include '../public/base.phtml';
<?php


// Démarrage de la session
session_start();

// Inclusion de la config
require_once '../app/config.php';


// Définition de la variable $template
$template = '../templates/error';

// Inclusion du fichier base.phtml
include '../public/base.phtml';

<?php


// Démarrage de la session
session_start();

// Inclusion de init
require_once '../app/init.php';


// Définition de la variable $template
$template = '../templates/error';

// Inclusion du fichier base.phtml
include '../templates/base.phtml';

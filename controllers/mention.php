<?php

// Démarrage de la session
session_start();

// Inclusion de init
require_once '../app/init.php';


// Définition de la variable $template
$template = '../templates/mention';

// Inclusion du fichier base.phtml
include '../templates/base.phtml';
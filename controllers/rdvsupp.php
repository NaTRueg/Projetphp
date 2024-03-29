<?php

session_start();

// Redirige vers la page d'accueil si la session n'est pas active
if (!isset($_SESSION['user_id'])) {
    header('Location: Accueil');
    exit;
}

// Inclusion de init
require_once '../app/init.php';


if (isset($_POST['rdv_id'])) {
    $rdv_id = $_POST['rdv_id'];
    deleteRdv($pdo, $rdv_id);
}

// Redirige vers la page des rendez-vous
header('Location: MesRendez-vous');
exit;

<?php

session_start();

// Redirige vers la page d'accueil si la session n'est pas active
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

require_once 'config.php';
require_once 'fonction.php';

$pdo = getPdoConnection();

if (isset($_POST['rdv_id'])) {
    $rdv_id = $_POST['rdv_id'];
    deleteRdv($pdo, $rdv_id);
}

// Redirige vers la page des rendez-vous
header('Location: mesrdv.php');
exit;

?>

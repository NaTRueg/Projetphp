<?php
// Démarrage de la session
session_start();


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Redirige vers la page d'accueil si la session n'est pas active
if (!isset($_SESSION['user_id'])) {
  header('Location: Accueil');
  exit;
}

// Inclusion de la configuration et des fonctions
require_once 'config.php';
require 'fonction.php';

// Connexion à la base de données
$pdo = getPdoConnection();



// Redirection vers le formulaire de rendez-vous si la date et l'heure n'ont pas été sélectionnées
if (!isset($_SESSION['date']) || !isset($_SESSION['heure'])) {
  header('Location: rdv.php');
  exit;
}

$utilisateur_id = $_SESSION['user_id'];
$medecins = $_SESSION['medecins'];
$date = $_SESSION['date'];
$heure = $_SESSION['heure'];
$specialite_id = $_SESSION['specialite_id'];
$ville_id = $_SESSION['ville_id'];


$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);



if (isset($_POST['medecin_id'])) {
  $medecin_id = $_POST['medecin_id'];
  if (empty($medecin_id)) {
    $errors['medecin_id'] = 'Veuillez sélectionner un médecin';
  } else {
    // Vérifier si le rendez-vous pour le patient donné à la date et l'heure spécifiées existe déjà
    $sql = "SELECT id FROM rendez_vous WHERE date = :date AND heure = :heure AND utilisateur_id = :utilisateur_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':date', $date);
    $stmt->bindValue(':heure', $heure);
    $stmt->bindValue(':utilisateur_id', $utilisateur_id);
    $stmt->execute();
    $rendezVous = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($rendezVous) {
      // Si le rendez-vous existe déjà, mettre à jour l'ID du médecin pour cette ligne
      $sql = "UPDATE rendez_vous SET medecin_id = :medecin_id WHERE id = :rendezVousId";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':medecin_id', $medecin_id);
      $stmt->bindValue(':rendezVousId', $rendezVous['id']);
      $stmt->execute();
    } else {
      // Sinon, insérer les informations de rendez-vous dans la table
      $query = "INSERT INTO rendez_vous (heure, date, utilisateur_id, medecin_id) VALUES (:heure, :date, :utilisateur_id, :medecin_id)";
      $stmt = $pdo->prepare($query);
      $stmt->bindValue(':heure', $heure);
      $stmt->bindValue(':date', $date);
      $stmt->bindValue(':utilisateur_id', $utilisateur_id);
      $stmt->bindValue(':medecin_id', $medecin_id);
      $stmt->execute();
    }

    // Récupérer l'id du rendez-vous qui vient d'être inséré
    $rendezVousId = $pdo->lastInsertId();

    // Redirection vers la page de confirmation
    header('Location: MesRendez-vous');
    exit;
  }
}


// Affichage : inclusion du template
$template = 'Confirmation';
include 'templates/base.phtml';

<?php

// Inclusion de la config
require_once '../app/config.php';



function checkEmailExistence($pdo, $email)

{
    $sql = 'SELECT COUNT(*) FROM utilisateur WHERE email = ?';

    $query = $pdo->prepare($sql);
    $query->execute([$email]);

    return $query->fetchColumn() > 0;
}



function addUtilisateur(string $nom, string $prenom, string $dateNaissance, string $email, string $motDePasse)
{
    $db = new Database();

    // Hachage du mot de passe
    $hash = password_hash($motDePasse, PASSWORD_DEFAULT);

    // Insertion des informations de l'utilisateur dans la table utilisateur
    $sql = 'INSERT INTO utilisateur (nom, prenom, date_naissance, email, mot_de_passe) VALUES (?, ?, ?, ?, ?)';

    return $db->insert($sql, [$nom, $prenom, $dateNaissance, $email, $hash]);

    
}


function check_login(string $email, string $motDePasse) {
    $db = new Database();

    // Récupération de l'utilisateur depuis la base de données
    $sql = "SELECT id, prenom, nom, isAdmin, mot_de_passe FROM utilisateur WHERE email = ?";
    $user = $db->getOneResult($sql, [$email]);

    if (!$user) {
        // L'utilisateur n'existe pas dans la base de données
        return false;
    }

    // Vérification du mot de passe haché
    if (password_verify($motDePasse, $user['mot_de_passe'])) {
        // Le mot de passe est correct
        return $user;
    } else {
        // Le mot de passe est incorrect
        return false;
    }
}




function deleteUserAndAppointments($pdo, $user_id)
{
    // Démarrer une transaction
    $pdo->beginTransaction();

    try {
        // Supprimer tous les rendez-vous de l'utilisateur
        $query = "DELETE FROM rendez_vous WHERE utilisateur_id = ?";
        $statement = $pdo->prepare($query);
        $statement->execute([$user_id]);

        // Supprimer l'utilisateur de la base de données
        $query = "DELETE FROM utilisateur WHERE id = ?";
        $statement = $pdo->prepare($query);
        $statement->execute([$user_id]);

        // Valider la transaction
        $pdo->commit();

        return true;
    } catch (Exception $e) {
        // En cas d'erreur, annuler la transaction
        $pdo->rollback();

        return false;
    }
}

function deleteDoctorAndAppointments($pdo, $doctor_id)
{
    // Démarrer une transaction
    $pdo->beginTransaction();

    try {
        // Supprimer tous les rendez-vous du médecin
        $query = "DELETE FROM rendez_vous WHERE medecin_id = ?";
        $statement = $pdo->prepare($query);
        $statement->execute([$doctor_id]);

        // Supprimer le médecin de la base de données
        $query = "DELETE FROM medecins WHERE id = ?";
        $statement = $pdo->prepare($query);
        $statement->execute([$doctor_id]);

        // Valider la transaction
        $pdo->commit();

        return true;
    } catch (Exception $e) {
        // En cas d'erreur, annuler la transaction
        $pdo->rollback();

        return false;
    }
}


function getRendezVousUtilisateur($pdo, $utilisateur_id)
{
    $sql = "SELECT rendez_vous.id, rendez_vous.heure, rendez_vous.date, medecins.nom AS nom_medecin, specialites.nom AS specialite_medecin, villes.nom AS ville_medecin
    FROM rendez_vous
    JOIN medecins ON rendez_vous.medecin_id = medecins.id
    JOIN specialites ON medecins.specialite_id = specialites.id
    JOIN villes ON medecins.ville_id = villes.id
    WHERE rendez_vous.utilisateur_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$utilisateur_id]);
    $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $resultats;
}


function deleteRdv($pdo, $id)
{
    $stmt = $pdo->prepare('DELETE FROM rendez_vous WHERE id = ?');
    $stmt->execute([$id]);
    return $stmt->rowCount() > 0;
}


function compareDates($a, $b)
{
    $dateA = strtotime($a['date'] . ' ' . $a['heure']);
    $dateB = strtotime($b['date'] . ' ' . $b['heure']);
    if ($dateA == $dateB) {
        return 0;
    }
    return ($dateA < $dateB) ? -1 : 1;
}


function getMedecins($pdo)
{
    $sql = "SELECT medecins.id, medecins.nom, medecins.email, specialites.nom AS specialite, villes.nom AS ville 
            FROM medecins 
            INNER JOIN specialites ON medecins.specialite_id = specialites.id 
            INNER JOIN villes ON medecins.ville_id = villes.id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $medecins = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $medecin = array();
        $medecin['id'] = $row['id'];
        $medecin['nom'] = $row['nom'];
        $medecin['email'] = $row['email'];
        $medecin['specialite'] = $row['specialite'];
        $medecin['ville'] = $row['ville'];
        array_push($medecins, $medecin);
    }
    return $medecins;
}

function format_rdv_date($date) {
    $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
    $formatter->setPattern('EEEE'); 
    $formatted_date = ucfirst($formatter->format(strtotime($date)));
    $formatted_date .= ' ' . date('d/m/Y', strtotime($date));
    return $formatted_date;
}

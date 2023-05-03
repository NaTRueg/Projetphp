<?php

// Inclusion de la config
require_once '../app/config.php';

class User {
    protected $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }


public function getUserEmail($userId) {
    $stmt = $this->pdo->prepare("SELECT email FROM utilisateur WHERE id = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch();
    return $user['email'];
}

public function getUserName($userId) {
    $stmt = $this->pdo->prepare("SELECT nom FROM utilisateur WHERE id = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch();
    return $user['nom'];
}

public function getUserFirstname($userId) {
    $stmt = $this->pdo->prepare("SELECT prenom FROM utilisateur WHERE id = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch();
    return $user['prenom'];
}

public function getUserAge($userId) {
    $query = "SELECT date_naissance FROM utilisateur WHERE id = ?";
    $statement = $this->pdo->prepare($query);
    $statement->bindParam(1, $userId, PDO::PARAM_INT);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $dob = $result['date_naissance'];

    // Vérifier que la date de naissance n'est pas nulle
    if (!$dob) {
        return null;
    }

    // Calculer l'âge à partir de la date de naissance
    $today = new DateTime();
    $birthdate = new DateTime($dob);
    $age = $today->diff($birthdate)->y;

    return $age;
}

}
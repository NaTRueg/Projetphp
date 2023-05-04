<?php

// Inclusion de la config
require_once '../app/config.php';

class Database
{
    private $pdo;

    public function getPDOConnection()
    {
        // Construction du Data Source Name
        $dsn = 'mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8';

        // Tableau d'options pour la connexion PDO
        $options = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        // Création de la connexion PDO (création d'un objet PDO)
        $this->pdo = new PDO($dsn, DB_USER, DB_PASSWORD, $options);
        $this->pdo->exec('SET NAMES UTF8');

        return $this->pdo;
    }

    public function insert(string $sql, array $params = []): int
    {
        $pdo = $this->getPDOConnection();

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        return $pdo->lastInsertId();
    }

    public function getOneResult(string $sql, array $params = []): array|false
{
    $pdo = $this->getPDOConnection();

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    return $stmt->fetch() ?: false;
}

}

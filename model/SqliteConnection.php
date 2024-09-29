<?php
namespace model;

use PDO;
use PDOException;

class SqliteConnection
{
    private static $instance = null; // Instance unique de la classe
    private PDO $connection; // Instance PDO pour la connexion à la base de données

    /**
     * Constructeur privé pour le patron singleton.
     * Établit la connexion à la base de données SQLite.
     */
    public function __construct()
    {
        try {
            // Établissement de la connexion à la base de données SQLite
            $this->connection = new PDO('sqlite:'.DB_FILE);
            // Configuration du mode d'erreur de PDO
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'ERREUR : Échec de la connexion : ' . $e->getMessage();
            exit();
        }
    }

    /**
     * Obtient une instance de la classe SqliteConnection.
     * @return SqliteConnection L'unique instance de cette classe.
     */
    public static function getInstance(): SqliteConnection
    {
        if (self::$instance == null) {
            self::$instance = new SqliteConnection();
        }
        return self::$instance;
    }

    /**
     * Obtient la connexion PDO établie.
     * @return PDO L'objet de connexion PDO.
     */
    public function getConnection(): PDO
    {
        return $this->connection;
    }
}

<?php
// Inclure Config.php
require_once __DIR__ . '/Config.php';

class dbConfig
{
    private static ?dbConfig $instance = null;
    private \PDO $pdo;

    private function __construct()
    {
        $infoBdd = Config::infoBdd(); // Méthode statique = ::
        $dsn = self::dsnPDOconnection($infoBdd);

        try {
            $this->pdo = new \PDO($dsn, $infoBdd['user'], $infoBdd['pass']);
        } catch (\PDOException $e) {
            throw new \RuntimeException("Database connection error: " . $e->getMessage());
        }
    }

    public function getPdo(): \PDO
    {
        return $this->pdo;
    }

    public static function dsnPDOconnection(array $infoBdd): string
    {
        $myport = ($infoBdd['port']);
        $hostname = ($infoBdd['host']);
        $mydbname = ($infoBdd['dbname']);

        return "pgsql:host=$hostname;port=$myport;dbname=$mydbname";
    }

    public static function getOrCreateInstance(): dbConfig
    {
        if (!isset(static::$instance)) {
            static::$instance = new dbConfig();
        }
        return static::$instance;
    }
}
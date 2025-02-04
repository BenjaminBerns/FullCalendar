<?php
/*
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
            $this->pdo = new \PDO($dsn, $infoBdd['user'], $infoBdd['pass'], [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, 
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            ]);
    
            // Forcer l'encodage UTF-8 pour éviter les problèmes avec PostgreSQL
            $this->pdo->exec("SET NAMES 'utf8'");
    
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
*/


// Database configuration  
define('DB_HOST', 'localhost'); 
define('DB_USERNAME', 'root'); 
define('DB_PASSWORD', ''); 
define('DB_NAME', 'fullcalendar'); 
  
// Create database connection  
$db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);  
  
// Check connection  
if ($db->connect_error) { 
    die("Connection failed: " . $db->connect_error);  
}
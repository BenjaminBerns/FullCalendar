<?php
// Activer l'affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclure dbConfig.php
require_once __DIR__ . '/dbConfig.php';

// Récupérer les événements depuis la base de données
$pdo = dbConfig::getOrCreateInstance()->getPdo();

$sql = "SELECT id, title, description, debut as start, fin as end, url, color FROM events";
$stmt = $pdo->query($sql);

$events = array();
while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
    $row['start'] = date_create($row['start'])->format('Y-m-d');    
    $row['end'] = date_create($row['end'])->format('Y-m-d');
    array_push($events, $row);
}

echo json_encode($events);
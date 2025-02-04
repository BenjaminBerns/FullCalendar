<?php
/*
// Activer l'affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclure dbConfig.php
require_once __DIR__ . '/dbConfig.php';

// Récupérer les événements depuis la base de données
$pdo = dbConfig::getOrCreateInstance()->getPdo();

header('Content-Type: application/json; charset=utf-8');

$sql = "SELECT id, title, description, debut as start, fin as end, url, color FROM events";
$stmt = $pdo->query($sql);

$events = array();
while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
    array_push($events, $row);
}

echo json_encode($events);
*/
// Include database configuration file  
require_once 'dbConfig.php'; 
 
header('Content-Type: application/json; charset=utf-8');
// Filter events by calendar date 
$where_sql = ''; 
if(!empty($_GET['start']) && !empty($_GET['end'])){ 
    $where_sql .= " WHERE start BETWEEN '".$_GET['start']."' AND '".$_GET['end']."' "; 
} 
 
// Fetch events from database 
$sql = "SELECT * FROM events $where_sql"; 
$result = $db->query($sql);  
 
$eventsArr = array(); 
if($result->num_rows > 0){ 
    while($row = $result->fetch_assoc()){ 
        array_push($eventsArr, $row); 
    } 
} 
 
// Render event data in JSON format 
echo json_encode($eventsArr);
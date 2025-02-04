<?php
/*
// Inclure le fichier Config.php
require_once __DIR__ . '/dbConfig.php';

try {
    $pdo = dbConfig::getOrCreateInstance()->getPdo();
    echo "Connexion à la base de données réussie !";
} catch (\PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

$request = json_decode(file_get_contents('php://input'), true);

if ($request['request_type'] == 'addEvent') {
    $eventData = $request['event_data'];
    $title = $eventData[0];
    $description = $eventData[1];
    $url = $eventData[2];
    $start = $eventData[3];
    $end = $eventData[4];
    $color = $eventData[5];

    $sql = "INSERT INTO events (title, description, debut, fin, url, color) VALUES (:title, :description, :start, :end, :url, :color)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':title' => $title,
        ':description' => $description,
        ':start' => $start,
        ':end' => $end,
        ':url' => $url,
        ':color' => $color
    ]);

    echo json_encode(['status' => 1]);
} elseif ($request['request_type'] == 'deleteEvent') {
    $eventId = $request['event_id'];

    $sql = "DELETE FROM events WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $eventId]);

    echo json_encode(['status' => 1]);
} elseif ($request['request_type'] == 'editEvent') {
    $eventId = $request['event_id'];
    $eventData = $request['event_data'];
    $title = $eventData[0];
    $description = $eventData[1];
    $url = $eventData[2];
    $start = $eventData[3];
    $end = $eventData[4];
    $color = $eventData[5];

    $sql = "UPDATE events SET title = :title, description = :description, debut = :start, fin = :end, url = :url, color = :color WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':title' => $title,
        ':description' => $description,
        ':start' => $start,
        ':end' => $end,
        ':url' => $url,
        ':color' => $color,
        ':id' => $eventId
    ]);

    echo json_encode(['status' => 1]);
}


*/
   
// Include database configuration file  
require_once 'dbConfig.php'; 
 
// Retrieve JSON from POST body 
$jsonStr = file_get_contents('php://input'); 
$jsonObj = json_decode($jsonStr); 
 
if($jsonObj->request_type == 'addEvent'){ 
    $start = $jsonObj->start; 
    $end = $jsonObj->end; 
 
    $event_data = $jsonObj->event_data; 
    $eventTitle = !empty($event_data[0])?$event_data[0]:''; 
    $eventDesc = !empty($event_data[1])?$event_data[1]:''; 
    $eventURL = !empty($event_data[2])?$event_data[2]:''; 
     
    if(!empty($eventTitle)){ 
        // Insert event data into the database 
        $sqlQ = "INSERT INTO events (title,description,url,start,end) VALUES (?,?,?,?,?)"; 
        $stmt = $db->prepare($sqlQ); 
        $stmt->bind_param("sssss", $eventTitle, $eventDesc, $eventURL, $start, $end); 
        $insert = $stmt->execute(); 
 
        if($insert){ 
            $output = [ 
                'status' => 1 
            ]; 
            echo json_encode($output); 
        }else{ 
            echo json_encode(['error' => 'Event Add request failed!']); 
        } 
    } 
}elseif($jsonObj->request_type == 'editEvent'){ 
    $start = $jsonObj->start; 
    $end = $jsonObj->end; 
    $event_id = $jsonObj->event_id; 
 
    $event_data = $jsonObj->event_data; 
    $eventTitle = !empty($event_data[0])?$event_data[0]:''; 
    $eventDesc = !empty($event_data[1])?$event_data[1]:''; 
    $eventURL = !empty($event_data[2])?$event_data[2]:''; 
     
    if(!empty($eventTitle)){ 
        // Update event data into the database 
        $sqlQ = "UPDATE events SET title=?,description=?,url=?,start=?,end=? WHERE id=?"; 
        $stmt = $db->prepare($sqlQ); 
        $stmt->bind_param("sssssi", $eventTitle, $eventDesc, $eventURL, $start, $end, $event_id); 
        $update = $stmt->execute(); 
 
        if($update){ 
            $output = [ 
                'status' => 1 
            ]; 
            echo json_encode($output); 
        }else{ 
            echo json_encode(['error' => 'Event Update request failed!']); 
        } 
    } 
}elseif($jsonObj->request_type == 'deleteEvent'){ 
    $id = $jsonObj->event_id; 
 
    $sql = "DELETE FROM events WHERE id=$id"; 
    $delete = $db->query($sql); 
    if($delete){ 
        $output = [ 
            'status' => 1 
        ]; 
        echo json_encode($output); 
    }else{ 
        echo json_encode(['error' => 'Event Delete request failed!']); 
    } 
} 
 
?>
<?php

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
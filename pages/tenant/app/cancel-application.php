<?php
$userId = $_POST['userId'] ?? 0;
$roomId = $_POST['roomId'] ?? 0;

if ($userId == 0 || $roomId == 0) {
    echo "false";
    exit;
}

require_once __DIR__ . '/../../../classes/application.php';

$tempApplication = new Application();

$applicationId = $tempApplication->fetchApplicationIdByUserRoomId($userId, $roomId);

$status = $tempApplication->cancel($applicationId);

echo $status ? true : false;
<?php

$houseId = $_POST['notice-house'] ?? 0;
$roomId = $_POST['notice-room'] ?? 0;
$title = $_POST['notice-title'] ?? 0;
$description = $_POST['notice-description'] ?? 0;

if ($houseId == 0 || $roomId == 0 || $title == 0 || $description == 0)
    exit;

require_once __DIR__ . '/../../../classes/notice.php';
require_once __DIR__ . '/../../../classes/room.php';
require_once __DIR__ . '/../../../classes/notification.php';
$tempNotification = new Notification();

global $conn;

$tempNotice = new Notice();
$tempRoom = new Room();
$tempNotification = new Notification();

$tempRoom->fetch($roomId);

$tempNotice->setHouseId($houseId);
$tempNotice->setRoomId($roomId);
$tempNotice->setTenantId($tempRoom->getTenantId());
$tempNotice->setTitle(mysqli_real_escape_string($conn, $title));
$tempNotice->setDescription(mysqli_real_escape_string($conn, $description));

$status = $tempNotice->register();

if ($status) {
    // notification
    $tempNotification->roomNotice($tempRoom->getTenantId(), $roomId);
}

echo $status;
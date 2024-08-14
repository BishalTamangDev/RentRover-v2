<?php

$roomId = $_POST['leave-room-id'] ?? 0;
$tenantId = $_POST['leave-tenant-id'] ?? 0;
$moveOutDate = $_POST['leave-move-out-date'] ?? 0;
$note = $_POST['leave-note'] ?? 0;

if ($roomId == 0 || $tenantId == 0 || $moveOutDate == 0 || $note == 0)
    exit;

require_once __DIR__ . '/../../../classes/leave-application.php';
require_once __DIR__ . '/../../../classes/notification.php';
require_once __DIR__ . '/../../../classes/room.php';
require_once __DIR__ . '/../../../classes/house.php';

$tempRoom = new Room();
$tempHouse  = new House();
$tempLeave = new Leave();
$tempNotification = new Notification();

global $conn;

$tempLeave->roomId = $roomId;
$tempLeave->setTenantId($tenantId);
$tempLeave->note = mysqli_real_escape_string($conn, $note);
$tempLeave->moveOutDate = $moveOutDate;

$status = $tempLeave->register();

// fetch room detail :: id
$roomExists = $tempRoom->fetch($roomId);

// fetch house :: landlord id
$houseExists = $tempHouse->fetch($tempRoom->houseId);

$landlord = $tempHouse->getLandlordId();

if($status) {
    $res = $tempNotification->leaveApplicationSubmit($landlord, $tenantId, $roomId);
}

echo $status;
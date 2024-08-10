<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

$roomId = $_POST['roomId'] ?? 0;

if ($roomId == 0) {
    echo "Room couldn't be deleted.";
    exit;
}

require_once __DIR__ . '/../../../classes/room.php';
require_once __DIR__ . '/../../../classes/house.php';

$tempRoom = new Room();
$tempRoom->fetch($roomId);

$tempHouse = new House();
$tempHouse->fetch($tempRoom->houseId);

if ($tempHouse->getLandlordId() != $_SESSION['rentrover-id']) {
    echo "Room couldn't be deleted.";
    exit;
}

$status = $tempRoom->delete($roomId);

echo $status ? "true" : "false";
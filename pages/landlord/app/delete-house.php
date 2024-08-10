<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

$houseId = $_POST['houseId'] ?? 0;

if ($houseId == 0) {
    echo "House couldn't be deleted.";
    exit;
}

require_once __DIR__ . '/../../../classes/house.php';
require_once __DIR__ . '/../../../classes/room.php';

$tempHouse = new House();
$tempRoom = new Room();

$tempHouse->fetch($houseId);

if ($tempHouse->getLandlordId() != $_SESSION['rentrover-id']) {
    echo "House couldn't be deleted.";
    exit;
}

$status = $tempHouse->delete($houseId);

// delete rooms
$roomIdList = $tempRoom->fetchRoomIdByHouseId($houseId);

if (sizeof($roomIdList) > 0) {
    foreach ($roomIdList as $roomId) {
        $tempRoom->delete($roomId);
    }
}

echo $status ? "true" : "false";
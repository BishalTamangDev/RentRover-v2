<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

$landlordId = $_SESSION['rentrover-id'] ?? 0;

if ($landlordId == 0) {
    echo "0";
    exit;
}

require_once __DIR__ . '/../../../classes/user.php';
require_once __DIR__ . '/../../../classes/house.php';
require_once __DIR__ . '/../../../classes/room.php';
require_once __DIR__ . '/../../../classes/application.php';

$tempHouse = new House();
$tempUser = new User();
$tempRoom = new Room();
$tempApplication = new Application();

// fetch house
$houseIdList = $tempHouse->fetchHouseIdByLandlordId($landlordId);

// fetch rooms
$roomIdList = $tempRoom->fetchAllRoomIdByLandlord($houseIdList);

// fetch application
$applicationList = $tempApplication->fetchAcceptedExpiredApplicationIdByRoomList($roomIdList);

echo sizeof($applicationList);

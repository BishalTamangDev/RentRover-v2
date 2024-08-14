<?php

if (session_status() == PHP_SESSION_NONE)
    session_start();

$roomId = $_POST['room-id'] ?? 0;
$applicantId = $_SESSION['rentrover-id'] ?? 0;

if ($roomId == 0 || $applicantId == 0) {
    echo false;
    exit;
}

require_once __DIR__ . '/../../../classes/user.php';
require_once __DIR__ . '/../../../classes/house.php';
require_once __DIR__ . '/../../../classes/room.php';
require_once __DIR__ . '/../../../classes/application.php';
require_once __DIR__ . '/../../../classes/notification.php';

global $conn;

$tempUser = new User();
$tempHouse = new House();
$tempRoom = new Room();
$tempApplication = new Application();
$tempNotification = new Notification();

// get owner Id
$tempRoom->fetch($roomId);
$tempHouse->fetch($tempRoom->houseId);
$landlordId = $tempHouse->getLandlordId();

$tempApplication->setApplicantId($applicantId);
$tempApplication->roomId = $roomId;


$tempApplication->rentingType = $_POST['renting-type'];
$tempApplication->date = [
    'moveIn' => $_POST['move-in-date'],
    'moveOut' => $_POST['move-in-date']
];

if ($tempApplication->rentingType == 'not-fixed') {
    $tempApplication->date['moveOut'] = '';
}

$tempApplication->note = mysqli_real_escape_string($conn, $_POST['note']) ?? '';


$status = $tempApplication->register();

if ($status) {
    // notitfication
    $res = $tempNotification->applyForRoom($applicantId, $roomId, $landlordId);
}

echo $status;
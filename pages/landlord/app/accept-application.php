<?php
$applicationId = $_POST['applicationId'] ?? 0;

if ($applicationId == 0) {
    echo false;
    exit;
}

require_once __DIR__ . '/../../../classes/application.php';
require_once __DIR__ . '/../../../classes/room.php';
require_once __DIR__ . '/../../../classes/notification.php';

$tempRoom = new Room();
$tempApplication = new Application();
$tempNotification = new Notification();

$status = $tempApplication->accept($applicationId);

// fetch room is
$roomId = $tempApplication->fetchRoomIdByApplicationId($applicationId);

// reject remaining applications
if ($roomId != 0) {
    $res1 = $tempApplication->rejectRemaining($roomId);
}

// update room flag to on-hold
$res2 = $tempRoom->updateFlag($roomId, "on-hold");

// get applicant id
$tempApplication->fetch($applicationId);

// set the other applications of applicant as expired
$res3 = $tempApplication->expireApplicationOfApplicant($tempApplication->getApplicantId());

$applicantId = $tempApplication->getApplicantId();

// notification :: for accepted applicant
if ($status) {
    $res = $tempNotification->acceptApplication($applicantId, $roomId);
}

echo $status;
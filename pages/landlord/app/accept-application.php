<?php
$applicationId = $_POST['applicationId'] ?? 0;

require_once __DIR__ . '/../../../classes/application.php';
require_once __DIR__ . '/../../../classes/room.php';

$tempApplication = new Application();
$tempRoom = new Room();

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

echo $status;
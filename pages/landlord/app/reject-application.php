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

$status = $tempApplication->reject($applicationId);

// notification purpose
if ($status) {
    // get applicant id
    $tempApplication->fetch($applicationId);
    $applicantId = $tempApplication->getApplicantId();

    // fetch room id
    $roomId = $tempApplication->fetchRoomIdByApplicationId($applicationId);

    $res = $tempNotification->rejectApplication($applicantId, $roomId);
}

echo $status;
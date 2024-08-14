<?php
$roomId = $_POST['roomId'] ?? 0;
$applicantId = $_POST['applicantId'] ?? 0;

if ($roomId == 0 || $applicantId == 0) {
    echo false;
    exit;
}

require_once __DIR__ . '/../../../classes/room.php';
require_once __DIR__ . '/../../../classes/notification.php';
require_once __DIR__ . '/../../../classes/tenancy-history.php';

$tempRoom = new Room();
$tempTenancy = new Tenancy();
$tempNotification = new Notification();

$response = $tempRoom->makeTenant($roomId, $applicantId);

if ($response) {
    // update tenancy table
    $tempTenancy->setTenantId($applicantId);
    $tempTenancy->setRoomId($roomId);

    date_default_timezone_set('Asia/Kathmandu');
    $tempTenancy->moveInDate = date('Y-m-d H:i:s');

    $response2 = $tempTenancy->register();

    // notification :: make tenant
    $res = $tempNotification->acceptAsTenant($applicantId, $roomId);
}

echo $response ? true : false;
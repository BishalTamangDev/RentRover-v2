<?php

$roomId = $_POST['roomId'] ?? 0;
$tenantId = $_POST['tenantId'] ?? 0;

if ($roomId == 0 || $tenantId == 0) {
    echo false;
    exit;
}


require_once __DIR__ . '/../../../classes/room.php';
require_once __DIR__ . '/../../../classes/tenancy-history.php';
require_once __DIR__ . '/../../../classes/notification.php';
require_once __DIR__ . '/../../../classes/application.php';

$tempRoom = new Room();
$tempTenancy = new Tenancy();
$tempApplication = new Application();
$tempNotification = new Notification();

$tempRoom->fetch($roomId);


// remove tenant
$status = $tempRoom->removeTenant($roomId);

// update tenancy history table
if ($status) {
    $tempTenancy->removeTenant($roomId, $tenantId);
}

// update application :: set as ex-tenant
if ($status) {
    $applicationId = $tempApplication->fetchLatestIdByRoomUser($roomId, $tenantId);
}

// update application table :: set as accepted-expired
if ($status) {
    $tempApplication->acceptedExpired($applicationId);
}

// notification
if ($status) {
    $tempNotification->removeTenant($tenantId, $roomId);
}

echo $status;
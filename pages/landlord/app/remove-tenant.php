<?php

$roomId = $_POST['roomId'] ?? 0;
$tenantId = $_POST['tenantId'] ?? 0;

if ($roomId == 0 || $tenantId == 0)
    exit;

require_once __DIR__ . '/../../../classes/room.php';
require_once __DIR__ . '/../../../classes/tenancy-history.php';

$tempRoom = new Room();
$tempTenancy = new Tenancy();

$tempRoom->fetch($roomId);

// remove tenant
$status = $tempRoom->removeTenant($roomId);

// update tenancy history table
if($status) {
    $tempTenancy->removeTenant($roomId, $tenantId);
}

echo $status;
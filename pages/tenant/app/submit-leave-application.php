<?php

$roomId = $_POST['leave-room-id'] ?? 0;
$tenantId = $_POST['leave-tenant-id'] ?? 0;
$moveOutDate = $_POST['leave-move-out-date'] ?? 0;
$note = $_POST['leave-note'] ?? 0;

if ($roomId == 0 || $tenantId == 0 || $moveOutDate == 0 || $note == 0)
    exit;

require_once __DIR__ . '/../../../classes/leave-application.php';

$tempLeave = new Leave();

global $conn;

$tempLeave->roomId = $roomId;
$tempLeave->setTenantId($tenantId);
$tempLeave->note = mysqli_real_escape_string($conn, $note);
$tempLeave->moveOutDate = $moveOutDate;

$status = $tempLeave->register();

echo $status;
<?php
$tenantId = $_POST['userId'] ?? 0;
$roomId = $_POST['roomId'] ?? 0;
$issueNote = $_POST['issue'] ?? 0;

if ($tenantId == 0 || $roomId == 0 || $issueNote == 0) {
    echo false;
    exit;
}

require_once __DIR__ . '/../../../classes/house.php';
require_once __DIR__ . '/../../../classes/room.php';
require_once __DIR__ . '/../../../classes/issue.php';
require_once __DIR__ . '/../../../classes/notification.php';

$tempIssue = new Issue();
$tempHouse = new House();
$tempRoom = new Room();
$tempNotification = new Notification();

$tempIssue->setRoomId($roomId);
$tempIssue->setTenantId($tenantId);
$tempIssue->issue = mysqli_real_escape_string($conn, $issueNote);

$status = $tempIssue->register();

// get owner Id
$tempRoom->fetch($roomId);
$tempHouse->fetch($tempRoom->houseId);
$landlordId = $tempHouse->getLandlordId();

if ($status) {
    $tempNotification->issueSubmit($landlordId, $roomId, $tenantId);
}

echo $status;
<?php
$tenantId = $_POST['userId'] ?? 0;
$roomId = $_POST['roomId'] ?? 0;
$issueNote = $_POST['issue'] ?? 0;

if($tenantId == 0 || $roomId == 0 || $issueNote == 0) {
    echo false;
    exit;
}

require_once __DIR__ . '/../../../classes/issue.php';
$tempIssue = new Issue();

$tempIssue->setRoomId($roomId);
$tempIssue->setTenantId($tenantId);
$tempIssue->issue = mysqli_real_escape_string($conn, $issueNote);

$status = $tempIssue->register();

echo $status;
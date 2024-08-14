<?php
$issueId = $_POST['issueId'] ?? 0;

if ($issueId == 0) {
    echo false;
    exit;
}

require_once __DIR__ . '/../../../classes/issue.php';
require_once __DIR__ . '/../../../classes/notification.php';

$tempIssue = new Issue();
$tempNotification = new Notification();

// fetch issue
$tempIssue->fetch($issueId);

$tenantId = $tempIssue->getTenantId();
$roomId = $tempIssue->getRoomId();

$status = $tempIssue->solve($issueId);

if ($status) {
    // notification
    $res = $tempNotification->issueSolved($roomId, $tenantId);
}

echo $status;
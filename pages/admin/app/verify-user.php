<?php
$userId = $_POST['userId'] ?? 0;

if ($userId == 0) {
    echo false;
    exit;
}

require_once __DIR__ . '/../../../classes/user.php';
require_once __DIR__ . '/../../../classes/notification.php';

$tempUser = new User();
$tempNotification = new Notification();

$status = $tempUser->verifyUser($userId);

if ($status) {
    // user notification
    $res = $tempNotification->verifyAccount($userId);
}

echo $status;
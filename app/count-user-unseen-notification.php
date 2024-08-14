<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

$userId = $_SESSION['rentrover-id'] ?? 0;

if ($userId == 0) {
    echo 0;
    exit;
}

require_once __DIR__ . '/../classes/notification.php';

$tempNotification = new Notification();

$count = $tempNotification->countUserUnseenNotification($userId);

if($count == 0) {
    echo "";
} else {
    echo $count > 9 ? "9<sup>+</sup>" : $count;
}
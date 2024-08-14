<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

$notificationId = $_POST['notificationId'] ?? 0;
$userId = $_SESSION['rentrover-id'] ?? 0;

if ($userId == 0 || $notificationId == 0) {
    exit;
}

require_once __DIR__ . '/../classes/notification.php';

$tempNotification = new Notification();

$tempNotification->click($notificationId);
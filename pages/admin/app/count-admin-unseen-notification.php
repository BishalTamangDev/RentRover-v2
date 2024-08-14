<?php
require_once __DIR__ . '/../../../classes/notification.php';

$tempNotification = new Notification();

$count = $tempNotification->countAdminUnseenNotification();

echo $count > 9 ? "9<sup>+</sup>" : $count;
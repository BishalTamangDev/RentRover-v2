<?php
require_once __DIR__ . '/../../../classes/notification.php';

$tempNotification = new Notification();

$count = $tempNotification->countAdminUnseenNotification();

if($count == 0) {
    echo "";
} else {
    echo $count > 9 ? "9<sup>+</sup>" : $count;
}
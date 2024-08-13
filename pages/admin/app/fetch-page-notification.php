<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

$userId = $_SESSION['rentrover-id'] ?? 0;

if ($userId == 0) {
    echo 0;
    exit;
}

require_once __DIR__ . '/../../../classes/notification.php';

$tempNotification = new Notification();

$list = $tempNotification->fetchAdminNotification();

if (sizeof($list) == 0) {
    ?>
    <!-- empty context -->
    <div class="d-flex flex-row gap-2 p-3 notification">
        <p class="m-0 small text-secondary"> Empty! </p>
    </div>
    <?php
} else {
    echo "Has notification...";
}
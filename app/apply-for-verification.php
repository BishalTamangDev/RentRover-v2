<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

$userId = $_SESSION['rentrover-id'] ?? 0;

if ($userId == 0) {
    echo "An error occured";
    exit;
}

require_once __DIR__ . '/../classes/user.php';

$tempUser = new User();

$status = $tempUser->applyForVerification($userId);

echo $status;
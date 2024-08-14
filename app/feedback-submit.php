<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

$userId = $_SESSION['rentrover-id'] ?? 0;

if ($userId == 0) {
    echo false;
    exit;
}

require_once __DIR__ . '/../classes/feedback.php';
require_once __DIR__ . '/../classes/notification.php';

$tempFeedback = new Feedback();
$tempNotification = new Notification();

global $conn;

$tempFeedback->setUserId($userId);
$tempFeedback->feedback = mysqli_real_escape_string($conn, $_POST['feedback-feedback']);
$tempFeedback->rating = $_POST['feedback-rating'];

$status = $tempFeedback->register();

if($status) {
    $res = $tempNotification->feedbackSubmit($userId);
}

echo $status;
<?php
$userId = $_POST['userId'] ?? 0;
$roomId = $_POST['roomId'] ?? 0;
$review = $_POST['review'] ?? 0;
$rating = $_POST['rating'] ?? 0;

if ($userId == 0 || $roomId == 0 || $review == 0 || $rating == 0)
    exit;

require_once __DIR__ . '/../../../classes/room-review.php';

$tempReview = new Review();

$tempReview->roomId = $roomId;
$tempReview->setUserId($userId);
$tempReview->rating = $rating;
$tempReview->review = mysqli_real_escape_string($conn, $review);

$status = $tempReview->register();

echo $status;
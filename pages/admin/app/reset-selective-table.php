<?php
echo "HELLO!";

require_once __DIR__ . '/../../../app/connection.php';

global $conn;

$query = "UPDATE room_tb SET tenant_id = 0, flag = 'verified'";
$response1 = $conn->query($query);

$query = "TRUNCATE TABLE application_tb";
$response2 = $conn->query($query);

$query = "TRUNCATE TABLE issue_tb";
$response3 = $conn->query($query);

$query = "TRUNCATE TABLE leave_application_tb";
$response4 = $conn->query($query);

$query = "TRUNCATE TABLE notice_tb";
$response5 = $conn->query($query);

$query = "TRUNCATE TABLE notification_tb";
$response6 = $conn->query($query);

$query = "TRUNCATE TABLE review_tb";
$response7 = $conn->query($query);

$query = "TRUNCATE TABLE tenancy_tb";
$response8 = $conn->query($query);

$query = "TRUNCATE TABLE wishlist_tb";
$response9 = $conn->query($query);

if ($response1 && $response2 && $response3 && $response4 && $response5 && $response6 && $response7 && $response8 && $response9) {
    return true;
} else {
    return false;
}
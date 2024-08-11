<?php

if (session_status() == PHP_SESSION_NONE)
    session_start();

$applicantId = $_SESSION['rentrover-id'] ?? 0;

require_once __DIR__ . '/../../../classes/application.php';

global $conn;

$tempApplication = new Application();

$tempApplication->setApplicantId($applicantId);
$tempApplication->roomId = $_POST['room-id'];

$tempApplication->rentingType = $_POST['renting-type'];
$tempApplication->date = [
    'moveIn' => $_POST['move-in-date'],
    'moveOut' => $_POST['move-in-date']
];

if ($tempApplication->rentingType == 'not-fixed') {
    $tempApplication->date['moveOut'] = '';
}

$tempApplication->note = mysqli_real_escape_string($conn, $_POST['note']) ?? '';

$status = $tempApplication->register();

echo $status;
<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

if ($_POST['add-room-csrf-token'] != $_SESSION['csrf-token'])
    echo "An error occured.";

require_once __DIR__ . '/../../../classes/room.php';
require_once __DIR__ . '/../../../functions/file-validity-check.php';
require_once __DIR__ . '/../../../functions/file-upload.php';

$tempRoom = new Room();

if (!isset($_FILES['room-photo-1']) || $_FILES['room-photo-1']['error'] == UPLOAD_ERR_NO_FILE) {
    echo "Error in uploading first photo.";
    exit;
}
if (!isset($_FILES['room-photo-2']) || $_FILES['room-photo-2']['error'] == UPLOAD_ERR_NO_FILE) {
    echo "Error in uploading second photo.";
    exit;
}
if (!isset($_FILES['room-photo-3']) || $_FILES['room-photo-3']['error'] == UPLOAD_ERR_NO_FILE) {
    echo "Error in uploading third photo.";
    exit;
}
if (!isset($_FILES['room-photo-4']) || $_FILES['room-photo-4']['error'] == UPLOAD_ERR_NO_FILE) {
    echo "Error in uploading fourth photo.";
    exit;
}

// check room images for validation
$photoValid1 = fileValidityCheck($_FILES['room-photo-1']);
$photoValid2 = fileValidityCheck($_FILES['room-photo-2']);
$photoValid3 = fileValidityCheck($_FILES['room-photo-3']);
$photoValid4 = fileValidityCheck($_FILES['room-photo-4']);

if (!$photoValid1 || !$photoValid2 || !$photoValid3 || !$photoValid4) {
    if (!$photoValid1) {
        echo "First photo is not valid. Please select another photo.";
        exit;
    }
    if (!$photoValid2) {
        echo "Second photo is not valid. Please select another photo.";
        exit;
    }
    if (!$photoValid3) {
        echo "Third photo is not valid. Please select another photo.";
        exit;
    }
    if (!$photoValid4) {
        echo "Fourth photo is not valid. Please select another photo.";
        exit;
    }
}

global $conn;

$photo1 = uploadFile("room-photo", $_FILES['room-photo-1']);
if ($photo1 == false) {
    echo "Error occured.";
    exit;
}

$photo2 = uploadFile("room-photo", $_FILES['room-photo-2']);
if ($photo2 == false) {
    echo "Error occured.";
    unlink("../../../uploads/houses/$photo1");
    exit;
}

$photo3 = uploadFile("room-photo", $_FILES['room-photo-3']);
if ($photo3 == false) {
    echo "Error occured.";
    unlink("../../../uploads/houses/$photo1");
    unlink("../../../uploads/houses/$photo2");
    exit;
}

$photo4 = uploadFile("room-photo", $_FILES['room-photo-4']);
if ($photo4 == false) {
    echo "Error occured.";
    unlink("../../../uploads/houses/$photo1");
    unlink("../../../uploads/houses/$photo2");
    unlink("../../../uploads/houses/$photo3");
    exit;
}

// all files uploaded

$tempRoom->houseId = $_POST['house-id'];
$tempRoom->type = $_POST['room-type'];

if (isset($_POST['bhk'])) {
    $tempRoom->bhk = $_POST['bhk'] ?? 0;
} else {
    $tempRoom->bhk = 0;
}

if (isset($_POST['number-of-room'])) {
    $tempRoom->numberOfRoom = $_POST['number-of-room'] ?? 0;
} else {
    $tempRoom->numberOfRoom = 0;
}

$tempRoom->number = $_POST['room-number'];
$tempRoom->furnishing = $_POST['furnishing-type'];
$tempRoom->floor = $_POST['floor'];
$tempRoom->rent = $_POST['rent'];
$tempRoom->info = mysqli_real_escape_string($conn, $_POST['info']);
$tempRoom->amenity = $_POST['amenity'];
$tempRoom->photo = [
    'first' => $photo1,
    'second' => $photo2,
    'third' => $photo3,
    'fourth' => $photo4,
];

$status = $tempRoom->register();

echo $status ? "true" : "false";
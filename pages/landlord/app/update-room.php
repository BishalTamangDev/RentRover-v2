<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

if ($_POST['edit-room-csrf-token'] != $_SESSION['csrf-token'])
    echo "An error occured.";

require_once __DIR__ . '/../../../classes/room.php';
require_once __DIR__ . '/../../../functions/file-validity-check.php';
require_once __DIR__ . '/../../../functions/file-upload.php';

$roomId = $_POST['room-id'];

$newPhoto1 = '';
$newPhoto2 = '';
$newPhoto3 = '';
$newPhoto4 = '';


$tempRoom = new Room();
$tempRoom->fetch($roomId);

if (isset($_FILES['room-photo-1']) && $_FILES['room-photo-1']['error'] != UPLOAD_ERR_NO_FILE) {
    $photoValid1 = fileValidityCheck($_FILES['room-photo-1']);
    if ($photoValid1) {
        $newPhoto1 = $photoValid1;
    } else {
        echo "First photo is not valid. Please select another photo.";
        exit;
    }
}
if (isset($_FILES['room-photo-2']) && $_FILES['room-photo-2']['error'] != UPLOAD_ERR_NO_FILE) {
    $photoValid2 = fileValidityCheck($_FILES['room-photo-2']);
    if ($photoValid2) {
        $newPhoto2 = $photoValid2;
    } else {
        echo "Second photo is not valid. Please select another photo.";
        exit;
    }
}
if (isset($_FILES['room-photo-3']) && $_FILES['room-photo-3']['error'] != UPLOAD_ERR_NO_FILE) {
    $photoValid3 = fileValidityCheck($_FILES['room-photo-3']);
    if ($photoValid3) {
        $newPhoto3 = $photoValid3;
    } else {
        echo "Third photo is not valid. Please select another photo.";
        exit;
    }
}
if (isset($_FILES['room-photo-4']) && $_FILES['room-photo-4']['error'] != UPLOAD_ERR_NO_FILE) {
    $photoValid4 = fileValidityCheck($_FILES['room-photo-4']);
    if ($photoValid4) {
        $newPhoto4 = $photoValid4;
    } else {
        echo "Fourth photo is not valid. Please select another photo.";
        exit;
    }
}

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

if ($tempRoom->type == "bhk") {
    $tempRoom->numberOfRoom = 0;
} else {
    $tempRoom->bhk = 0;
}

$tempRoom->number = $_POST['room-number'];
$tempRoom->furnishing = $_POST['furnishing-type'];
$tempRoom->floor = $_POST['floor'];
$tempRoom->rent = $_POST['rent'];
$tempRoom->info = mysqli_real_escape_string($conn, $_POST['info']);
$tempRoom->amenity = ($_POST['amenity']) ?? [''];
$tempRoom->fetchPhotos($roomId);

$status = $tempRoom->update();

if ($status) {
    // update aenity
    $tempRoom->updateAmenity();

    // update room photo
    if ($newPhoto1 != '') {
        $oldPhoto1 = $tempRoom->photo['first'];
        $newPhoto1 = uploadFile("room-photo", $_FILES['room-photo-1']);
        $response = $tempRoom->updatePhoto($roomId, $oldPhoto1, $newPhoto1);
        if ($response) {
            // delete old first photo
            unlink("../../../uploads/rooms/$oldPhoto1");
        }
    }

    if ($newPhoto2 != '') {
        $oldPhoto2 = $tempRoom->photo['second'];
        $newPhoto2 = uploadFile("room-photo", $_FILES['room-photo-2']);
        $response = $tempRoom->updatePhoto($roomId, $oldPhoto2, $newPhoto2);
        if ($response) {
            // delete old first photo
            unlink("../../../uploads/rooms/$oldPhoto2");
        }
    }

    if ($newPhoto3 != '') {
        $oldPhoto3 = $tempRoom->photo['third'];
        $newPhoto3 = uploadFile("room-photo", $_FILES['room-photo-3']);
        $response = $tempRoom->updatePhoto($roomId, $oldPhoto3, $newPhoto3);
        if ($response) {
            // delete old first photo
            unlink("../../../uploads/rooms/$oldPhoto3");
        }
    }

    if ($newPhoto4 != '') {
        $oldPhoto4 = $tempRoom->photo['fourth'];
        $newPhoto4 = uploadFile("room-photo", $_FILES['room-photo-4']);
        $response = $tempRoom->updatePhoto($roomId, $oldPhoto4, $newPhoto4);
        if ($response) {
            // delete old first photo
            unlink("../../../uploads/rooms/$oldPhoto4");
        }
    }
}

echo $status ? "true" : "false";
<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

if (!isset($_POST['edit-house-csrf-token'])) {
    echo "An error occured.";
    exit;
}

if ($_POST['edit-house-csrf-token'] != $_SESSION['csrf-token']) {
    echo "An error occured.";
    exit;
}

$hasPhoto = true;
$newPhotoValid = true;
$newHousePhoto = "";

if (isset($_FILES['house-photo-1']) && $_FILES['house-photo-1']['error'] != UPLOAD_ERR_NO_FILE) {
    $newHousePhoto = $_FILES['house-photo-1'];

    require_once __DIR__ . '/../../../functions/file-validity-check.php';
    require_once __DIR__ . '/../../../functions/file-upload.php';

    $photoValid = fileValidityCheck($newHousePhoto);

    if (!$photoValid) {
        $response = $photoValid;
        echo $response;
        exit;
    }
} else {
    $hasPhoto = false;
}

$newPhotoValid = true;

require_once __DIR__ . '/../../../classes/house.php';

$tempHouse = new House();

$houseId = $_POST['house-id'];

$houseExists = $tempHouse->fetch($houseId);

if (!$houseExists) {
    echo "An error occured.";
    exit;
}

// check if this is the actual owner
if ($tempHouse->getLandlordId() != $_SESSION['rentrover-id']) {
    echo "An error occured";
    exit;
}

$tempHouse->coordinate = [
    'longitude' => $_POST['longitude'],
    'latitude' => $_POST['latitude']
];

$tempHouse->address = [
    'district' => $_POST['district'],
    'municipalityRural' => mysqli_real_escape_string($conn, $_POST['municipality-rural']),
    'toleVillage' => mysqli_real_escape_string($conn, $_POST['tole-village']),
    'ward' => $_POST['ward'],
    'nearestLandmark' => mysqli_real_escape_string($conn, $_POST['nearest-landmark']),
];

$tempHouse->info = mysqli_real_escape_string($conn, $_POST['additional-info']);

// photo
$tempHouse->fetchPhoto($houseId);
$oldHousePhoto = $tempHouse->photo;

$tempHouse->fetchAmenity($houseId);
$oldAmenity = $tempHouse->amenity;

// amenity
$tempHouse->amenity = isset($_POST['amenity']) ? $_POST['amenity'] : $tempHouse->amenity = [''];

$message = "";

if ($tempHouse->update()) {
    $message = "true";

    // update amenity
    $tempHouse->updateAmenity($oldAmenity, $tempHouse->amenity);

    // update photo
    if ($hasPhoto) {
        $fileUploaded = uploadFile("house-photo", $newHousePhoto);
        if ($fileUploaded == false) {
            echo "Error in updating photo";
        } else {
            $res = $tempHouse->updatePhoto($fileUploaded);
            if ($res) {
                // remove old photo
                if ($oldHousePhoto != '') {
                    unlink("../../../uploads/houses/$oldHousePhoto");
                }
            }
        }
    }
} else {
    $message = "House detail couldn't be updated.";
}

echo $message;
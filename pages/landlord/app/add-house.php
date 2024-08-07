<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

$message = "";

$csrfToken = isset($_POST['add-house-csrf-token']) ? $_POST['add-house-csrf-token'] : 0;

if ($csrfToken != $_SESSION['csrf-token']) {
    echo "Error occured";
    exit;
}

require_once __DIR__ . '/../../../classes/house.php';
$tempHouse = new House();

if (isset($_FILES['house-photo-1']) && $_FILES['house-photo-1']['error'] != UPLOAD_ERR_NO_FILE) {
    $hasPhoto = true;
    $housePhoto = $_FILES['house-photo-1'];

    require_once __DIR__ . '/../../../functions/file-validity-check.php';
    require_once __DIR__ . '/../../../functions/file-upload.php';

    $photoValid = fileValidityCheck($housePhoto);

    if ($photoValid) {
        $fileUploaded = uploadFile("house-photo", $housePhoto);
        if ($fileUploaded == false) {
            echo $fileUploaded;
            exit;
        } else {
            $tempHouse->photo = $fileUploaded;
        }
    } else {
        $response = $photoValid;
        echo $response;
        exit;
    }
}

$tempHouse->setLandlordId($_SESSION['rentrover-id']);
$tempHouse->coordinate = [
    'longitude' => $_POST['longitude'],
    'latitude' => $_POST['latitude']
];

$tempHouse->address = [
    'district' => $_POST['district'],
    'municipalityRural' => $_POST['municipality-rural'],
    'toleVillage' => $_POST['tole-village'],
    'ward' => $_POST['ward'],
    'nearestLandmark' => $_POST['nearest-landmark'],
];

if (isset($_POST['amenity'])) {
    $tempHouse->amenity = $_POST['amenity'];
} else {
    $tempHouse->amenity[] = '';
}

$tempHouse->info = $_POST['additional-info'];

$response = $tempHouse->register() ? "true" : "false";

echo $response;
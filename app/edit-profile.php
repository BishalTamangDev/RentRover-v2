<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

require_once __DIR__ . '/../classes/user.php';

global $conn;
$response = "";
$hasPhoto = false;
$fileUploaded = false;

$tempUser = new User();
$tempUser->fetch($_SESSION['rentrover-id'], "all");

if (isset($_FILES['profile-photo']) && $_FILES['profile-photo']['error'] != UPLOAD_ERR_NO_FILE) {
    $hasPhoto = true;
    $profilePhoto = $_FILES['profile-photo'];
    require_once __DIR__ . '/../functions/file-validity-check.php';
    $photoValid = fileValidityCheck($profilePhoto);

    if ($photoValid) {
        $response = "";
        require_once __DIR__ . '/../functions/file-upload.php';
        $fileUploaded = uploadFile("user-profile-photo", $profilePhoto);
        if ($fileUploaded != false) {
            // delete previous photo
            if ($tempUser->profilePhoto != '') {
                unlink("../uploads/users/" . $tempUser->profilePhoto);
            }
            $tempUser->profilePhoto = $fileUploaded;
        }
    } else {
        $response = $photoValid;
    }
}

if ($hasPhoto) {
    if (!$photoValid) {
        echo $response;
        exit;
    }
    if (!$fileUploaded) {
        echo "Error in uploading profile photo";
        exit;
    }
}

$tempUser->name = [
    'first' => $conn->real_escape_string($_POST['first-name']),
    'last' => $conn->real_escape_string($_POST['last-name'])
];

$tempUser->gender = $_POST['gender'];
$tempUser->dob = $_POST['dob'];
$tempUser->address = [
    'province' => $_POST['province'],
    'district' => $_POST['district'],
    'municipalityRural' => $conn->real_escape_string($_POST['municipality-rural']),
    'tole-village' => $conn->real_escape_string($_POST['tole-village']),
    'ward' => $_POST['ward'],
];

$tempUser->setPhoneNumber($_POST['phone-number']);

$response = $tempUser->update($_SESSION['rentrover-id']);

echo $response;
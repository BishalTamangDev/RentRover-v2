<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

$message = "";
if (isset($_FILES['image-input-1']) && isset($_FILES['image-input-2'])) {
    if ($_FILES['image-input-1']['error'] != UPLOAD_ERR_NO_FILE && $_FILES['image-input-2']['error'] != UPLOAD_ERR_NO_FILE) {
        require_once __DIR__ . '/../functions/file-validity-check.php';

        $kycFront = $_FILES['image-input-1'];
        $kycBack = $_FILES['image-input-2'];

        if (fileValidityCheck($kycFront) && fileValidityCheck($kycBack)) {
            require_once __DIR__ . '/../classes/user.php';
            require_once __DIR__ . '/../functions/file-upload.php';

            $tempUser = new User();
            $tempUser->fetch($_SESSION['rentrover-id'], "all");

            // first upload new kycs
            $kycFrontUploaded = uploadFile("user-kyc-photo", $kycFront);
            $kycBackUploaded = uploadFile("user-kyc-photo", $kycBack);

            if ($kycFrontUploaded && $kycBackUploaded) {
                // remove old kyc
                $oldKycFront = '';
                $oldKycBack = '';
                if ($tempUser->kyc['front'] != '') {
                    $oldKycFront = $tempUser->kyc['front'];
                }
                
                if ($tempUser->kyc['back'] != '') {
                    $oldKycBack = $tempUser->kyc['back'];
                }

                // update user details
                $tempUser->kyc['front'] = $kycFrontUploaded;
                $tempUser->kyc['back'] = $kycBackUploaded;

                $response = $tempUser->updateKyc();
                if ($response) {
                    if ($oldKycFront != '')
                        unlink("../uploads/kycs/$oldKycFront");
                    if ($oldKycBack != '')
                        unlink("../uploads/kycs/$oldKycBack");
                    $message = "Your documents has been uploaded.";
                } else {
                    $message = "Documents couln't be submitted.";
                }
            }
        }
    }
}

echo $message;
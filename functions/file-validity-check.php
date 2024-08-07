<?php 
function fileValidityCheck($formFile)
{
    $fileValidMsg = true;
    $fileName = $formFile['name'];
    $fileTmpName = $formFile['tmp_name'];
    $fileSize = $formFile['size'];
    $fileError = $formFile['error'];
    $fileType = $formFile['type'];

    // error check
    if ($fileError) {
        $fileValidMsg = "Error in uploading the file. Make sure you selected the image file that is less than or equal to 2MB.";
    } else {
        // size check
        if ($fileSize >= 2087152) {
            $fileValidMsg = "File size is too big.";
        } else {
            // extension extraction
            $fileTempExtension = explode('.', $fileName);
            $fileExtension = strtolower(end($fileTempExtension));
            $allowedExtension = array('jpg', 'jpeg', 'png', 'webp');

            if (in_array($fileExtension, $allowedExtension)) {
                $newFileName = uniqid('', true) . "." . $fileExtension;
            } else {
                $fileValidMsg = "Invalid file format.";
            }
        }
    }
    return $fileValidMsg;
}
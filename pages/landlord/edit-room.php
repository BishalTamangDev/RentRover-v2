<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

require_once __DIR__ . '/../../classes/user.php';
require_once __DIR__ . '/../../classes/house.php';
require_once __DIR__ . '/../../classes/room.php';

$profileUser = new User();
$houseObj = new House();
$roomObj = new Room();

$profileUser->fetch($r_id, "all");
$roomExists = $roomObj->fetch($roomId);
if (!$roomExists)
    header("Location: /rentrover/landlord/rooms/");

$houseId = $roomObj->houseId;
$roomObj->fetchAmenity($roomId);

$houseExists = $houseObj->fetch($houseId);

if (!$houseExists)
    header("Location: /rentrover/landlord/rooms/");

if ($houseObj->getLandlordId() != $r_id)
    header("Location: /rentrover/landlord/rooms/");

$location = $houseObj->getAddress();

// default photo
$roomObj->fetchPhotos($roomId);

$photoSrc1 = $roomObj->photo['first'];
$photoSrc2 = $roomObj->photo['second'];
$photoSrc3 = $roomObj->photo['third'];
$photoSrc4 = $roomObj->photo['fourth'];

$page = "rooms";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- title -->
    <title> Edit Room : <?= $location ?> </title>

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="/rentrover/assets/brands/rentrover-circular-logo.png">

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- bootstrap :: cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- bootstrap :: local -->
    <link rel="stylesheet" href="/rentrover/bootstrap/bootstrap-css-5.3.3/bootstrap.min.css">

    <!-- css files -->
    <link rel="stylesheet" href="/rentrover/css/style.css">
    <link rel="stylesheet" href="/rentrover/css/aside.css">
    <link rel="stylesheet" href="/rentrover/css/add-house.css">
    <link rel="stylesheet" href="/rentrover/css/popup-alert.css">
    <link rel="stylesheet" href="/rentrover/css/file-input.css">
</head>

<body>
    <!-- aside -->
    <?php require_once __DIR__ . '/sections/aside.php'; ?>

    <?php
    // fetch landlord's houses
    require_once __DIR__ . '/../../classes/house.php';
    require_once __DIR__ . '/../../functions/amenity-array.php';

    $houseObj = new House();
    $eligible = $houseObj->checkIfEligibleToAddRoom($r_id);
    ?>

    <main>
        <?php
        if (!$eligible) {
            ?>
            <div class="alert alert-danger" role="alert">
                You are ineligible to add room.
            </div>
            <?php
        }
        ?>

        <section class="add-house">
            <form action="/rentrover/pages/landlord/app/update-room.php" method="POST"
                class="form d-flex flex-column add-house-form" id="edit-room-form" enctype="multipart/form-data" <?php if (!$eligible)
                    echo "disabled"; ?>>
                <!-- top section -->
                <div class="d-flex flex-column flex-md-row row-gap-3 justify-content-md-between top-section">
                    <!-- heading -->
                    <p class="m-0 fs-3 fw-semibold"> Edit Room </p>
                    <!-- rest or cancel -->
                    <div class="d-flex flex-row gap-2 mb-3">
                        <a href="/rentrover/landlord/edit-room/<?= $roomId ?>" class="btn btn-outline-secondary <?php if (!$eligible)
                              echo "invisible"; ?>" id="form-reset">
                            Reset </a>
                        <a class="btn btn-danger" href="/rentrover/landlord/room-detail/<?= $roomId ?>" id="cancel-btn">
                            Cancel </a>
                    </div>
                </div>

                <!-- error message -->
                <p class="m-0 text-danger small error-message mb-3" id="error-message"> Error message appears here...
                </p>

                <!-- token -->
                <input type="hidden" name="edit-room-csrf-token" class="form-control mt-3" placeholder="token id"
                    id="edit-room-csrf-token" required>

                <!-- room id -->
                <input type="hidden" name="room-id" id="room-id" value="<?= $roomId ?>" class="form-control" required>

                <!-- house and room type -->
                <div class="d-flex flex-column flex-md-row gap-3">
                    <!-- house -->
                    <div class="w-100 w-md-50">
                        <label for="bhk" class="mb-2 fw-semibold mt-3"> Select House </label>
                        <select name="house-id" id="house-id" class="form-select" required <?php if (!$eligible)
                            echo "disabled"; ?>>
                            <option value="" selected hidden> Select house </option>
                        </select>
                    </div>

                    <!-- room type -->
                    <div class="w-100 w-md-50">
                        <label for="bhk" class="mb-2 fw-semibold mt-3"> Room Type </label>
                        <select name="room-type" id="room-type" class="form-select" required <?php if (!$eligible)
                            echo "disabled"; ?>>
                            <option value="<?= $roomObj->type ?>" selected hidden>
                                <?= $roomObj->type == "bhk" ? "BHK" : "Non-BHK" ?>
                            </option>
                            <option value="bhk"> BHK </option>
                            <option value="non-bhk"> Non-BHK </option>
                        </select>
                    </div>
                </div>

                <div class="d-flex flex-column flex-md-row gap-3">
                    <!-- bhK -->
                    <div class="w-100" id="bhk-container">
                        <label for="bhk" class="mb-2 fw-semibold mt-3"> BHK </label>
                        <input type="number" name="bhk" min="" value="<?= $roomObj->bhk ?>" class="form-control"
                            id="bhk" <?php if (!$eligible)
                                echo "disabled"; ?>>
                    </div>

                    <!-- number of room -->
                    <div class="w-100" id="number-of-room-container">
                        <label for="number-of-room" class="mb-2 fw-semibold mt-3"> Number of room </label>
                        <input type="number" name="number-of-room" min="" value="<?= $roomObj->numberOfRoom ?>"
                            class="form-control" id="number-of-room" <?php if (!$eligible)
                                echo "disabled"; ?>>
                    </div>
                </div>

                <div class="d-flex flex-column flex-md-row gap-3">
                    <!-- room number -->
                    <div class="w-100 w-md-50">
                        <label for="room-number" class="mb-2 fw-semibold mt-3"> Room Number </label>
                        <input type="number" name="room-number" min="1" value="<?= $roomObj->number ?>"
                            class="form-control" id="room-number" required <?php if (!$eligible)
                                echo "disabled"; ?>>
                    </div>

                    <!-- furnishing -->
                    <div class="w-100 w-md-50">
                        <label for="" class="mb-2 fw-semibold mt-3"> Furnishing </label>
                        <select name="furnishing-type" id="furnishing-type" class="form-select" required <?php if (!$eligible)
                            echo "disabled"; ?>>
                            <option value="<?= $roomObj->furnishing ?>" selected hidden> <?php
                              switch ($roomObj->furnishing) {
                                  case 'unfurnished':
                                      echo ucfirst($roomObj->furnishing);
                                      break;
                                  case 'semi-furnished':
                                      echo "Semi-Furnished";
                                      break;
                                  default:
                                      echo "Full-furnished";

                              }
                              ?> </option>
                            <option value="unfurnished"> Unfurnished </option>
                            <option value="semi-furnished"> Semi-furnished </option>
                            <option value="fully-furnished"> Fully-furnished </option>
                        </select>
                    </div>
                </div>

                <div class="d-flex flex-column flex-md-row gap-3">
                    <!-- floor -->
                    <div class="w-100 w-md-50">
                        <label for="floor" class="mb-2 fw-semibold mt-3"> Floor </label>
                        <input type="number" name="floor" class="form-control" id="floor" value="<?= $roomObj->floor ?>"
                            min="0" required <?php if (!$eligible)
                                echo "disabled"; ?>>
                    </div>

                    <!-- rent -->
                    <div class="w-100 w-md-50">
                        <label for="rent" class="mb-2 fw-semibold mt-3"> Rent </label>
                        <input type="number" name="rent" class="form-control" id="rent" value="<?= $roomObj->rent ?>"
                            min="0" required <?php if (!$eligible)
                                echo "disabled"; ?>>
                    </div>
                </div>

                <!-- photos -->
                <p class="fw-semibold mb-2 mt-3"> Room Photos </p>
                <div class="d-flex flex-row gap-3 flex-wrap image-input-main-container">
                    <!-- photo 1 -->
                    <div class="image-input-container">
                        <!-- image container -->
                        <div class="image-container" id="image-container-1">
                            <!-- background-image -->
                            <img src="/rentrover/uploads/rooms/<?= $photoSrc1 ?>" alt="image-file-1" id="image-file-1"
                                accept=".jpg, .jpeg, .png, .webp">

                            <!-- delete icon -->
                            <div class="delete-div" id="delete-image-1">
                                <i class="fa fa-trash"> </i>
                            </div>

                            <!-- file input -->
                            <input type="file" name="room-photo-1" id="room-photo-1" <?php if (!$eligible)
                                echo "disabled"; ?>>
                        </div>

                        <label for="room-photo-1" class="upload-label small"> <i class="fa-solid fa-upload"></i> Upload
                            photo
                        </label>
                    </div>

                    <!-- photo 2 -->
                    <div class="image-input-container">
                        <!-- image container -->
                        <div class="image-container" id="image-container-2">
                            <!-- background-image -->
                            <img src="/rentrover/uploads/rooms/<?= $photoSrc2 ?>" alt="image-file-2" id="image-file-2"
                                accept=".jpg, .jpeg, .png, .webp">

                            <!-- delete icon -->
                            <div class="delete-div" id="delete-image-2">
                                <i class="fa fa-trash"> </i>
                            </div>

                            <!-- file input -->
                            <input type="file" name="room-photo-2" id="room-photo-2" <?php if (!$eligible)
                                echo "disabled"; ?>>
                        </div>

                        <label for="room-photo-2" class="upload-label small"> <i class="fa-solid fa-upload"></i> Upload
                            photo
                        </label>
                    </div>

                    <!-- photo 3 -->
                    <div class="image-input-container">
                        <!-- image container -->
                        <div class="image-container" id="image-container-3">
                            <!-- background-image -->
                            <img src="/rentrover/uploads/rooms/<?= $photoSrc3 ?>" alt="image-file-3" id="image-file-3"
                                accept=".jpg, .jpeg, .png, .webp">

                            <!-- delete icon -->
                            <div class="delete-div" id="delete-image-3">
                                <i class="fa fa-trash"> </i>
                            </div>

                            <!-- file input -->
                            <input type="file" name="room-photo-3" id="room-photo-3" <?php if (!$eligible)
                                echo "disabled"; ?>>
                        </div>

                        <label for="room-photo-3" class="upload-label small"> <i class="fa-solid fa-upload"></i> Upload
                            photo
                        </label>
                    </div>

                    <!-- photo 4 -->
                    <div class="image-input-container">
                        <!-- image container -->
                        <div class="image-container" id="image-container-4">
                            <!-- background-image -->
                            <img src="/rentrover/uploads/rooms/<?= $photoSrc4 ?>" alt="image-file-4" id="image-file-4"
                                accept=".jpg, .jpeg, .png, .webp">

                            <!-- delete icon -->
                            <div class="delete-div" id="delete-image-4">
                                <i class="fa fa-trash"> </i>
                            </div>

                            <!-- file input -->
                            <input type="file" name="room-photo-4" id="room-photo-4" <?php if (!$eligible)
                                echo "disabled"; ?>>
                        </div>

                        <label for="room-photo-4" class="upload-label small"> <i class="fa-solid fa-upload"></i> Upload
                            photo
                        </label>
                    </div>
                </div>

                <!-- amenities -->
                <!-- dynamically generate the amenities -->
                <p class="mb-2 mt-4 fw-semibold"> Amenities </p>
                <div class="d-flex gap-2 flex-wrap input-amenity-container" id="amenity-container">
                    <p class="mb-2 text-secondary"> Select house first to add the amenities. </p>
                </div>

                <!-- additional informations -->
                <label for="info" class="mb-2 mt-3 fw-semibold"> Some additional informations </label>
                <textarea name="info" class="form-control mb-2"
                    placeholder="Some information about the house or the requirements." id="info" <?php if (!$eligible)
                        echo "disabled"; ?>><?= $roomObj->info ?></textarea>

                <button type="submit" class="btn btn-brand fit-content mt-3" id="update-room-btn"> Update Now </button>
            </form>
        </section>
    </main>

    <!-- popup alert -->
    <div class="popup-alert-container" id="popup-alert-container">
        <p id="popup-message"> Popup alert content. </p>
    </div>

    <!-- bootstrap js :: cdn -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- bootstrap js :: local -->
    <script type="text/javascript" src="/rentrover/bootstrap/bootstrap-js-5.3.3/bootstrap.bundle.min.js"> </script>

    <!-- jquery -->
    <script src="/rentrover/jquery/jquery-3.7.1.min.js"></script>

    <!-- popup script -->
    <script src="/rentrover/js/popup-alert.js"></script>

    <script>
        $(document).ready(function () {
            // csrf token generation
            function generateCsrfToken() {
                $.ajax({
                    url: '/rentrover/app/csrf-token-generation.php',
                    success: function (data) {
                        $('#edit-room-csrf-token').val(data);
                    }
                });
            }

            generateCsrfToken();

            // load houses
            function loadHouses() {
                $.ajax({
                    url: '/rentrover/pages/landlord/sections/load-house-for-editing-room.php',
                    method: "POST",
                    data: {
                        landlordId: <?= $r_id ?>,
                        roomId: <?= $roomId ?>,
                        houseId: <?= $houseId ?>
                    },
                    success: function (data) {
                        $('#house-id').html(data);
                        loadInitialAmenity();
                    },
                    error: function () {
                        alert("error");
                    }
                });
            }

            loadHouses();

            // form submission
            $('#edit-room-form').submit(function (e) {
                e.preventDefault();

                // check room type and ask user to enter eithr of bhk or number of room
                room_type = $('#room-type').val();

                form_eligible = true;

                if (room_type == 'bhk') {
                    if ($('#bhk').val() == '' || $('#bhk').val() == 0) {
                        form_eligible = false;
                        $('#error-message').html("Please enter the bhk.").fadeIn();
                        $('#bhk').focus();
                    }
                    $('#number-of-room').val('0');
                } else if (room_type == 'non-bhk') {
                    if ($('#number-of-room').val() == '' || $('#number-of-room').val() == 0) {
                        form_eligible = false;
                        $('#number-of-room').focus();
                        $('#error-message').html("Please enter the number of room.").fadeIn();
                    }
                    $('#bhk').val('0');
                }

                if (form_eligible) {
                    var formData = new FormData($('#edit-room-form')[0]);
                    $.ajax({
                        url: '/rentrover/pages/landlord/app/update-room.php',
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        beforeSend: function () {
                            $('#error-message').html("").fadeOut();
                            $('#update-room-btn').html("Updating...").prop("disabled", true);
                        },
                        success: function (response) {
                            if (response == "true") {
                                $('#error-message').html("").fadeOut();
                                showPopupAlert("Room updated successfully.");
                                setTimeout(function () {
                                    window.location.href = "/rentrover/landlord/room-detail/<?= $roomId ?>";
                                }, 2000);
                            } else if (response == "false") {
                                $('#error-message').html("An error occured.").fadeIn();
                            } else {
                                $('#error-message').html(response).fadeIn();
                            }
                            $('#update-room-btn').html("Update Now").prop("disabled", false);
                        },
                        error: function () {
                            // $('#error-message').html("").fadeOut();
                            // $('#update-room-btn').html("Update Now").prop("disabled", false);
                        },
                    });
                }
            });

            // load house amenities
            $('#house-id').change(function () {
                house_id = $('#house-id').val();
                $.ajax({
                    url: '/rentrover/pages/landlord/sections/house-amenity-for-room.php',
                    method: "POST",
                    data: { houseId: house_id, roomId: <?= $roomId ?> },
                    success: function (data) {
                        $('#amenity-container').html(data);
                    }
                });
            });

            // load initial room amenity
            function loadInitialAmenity() {
                house_id = $('#house-id').val();
                $.ajax({
                    url: '/rentrover/pages/landlord/sections/house-amenity-for-room.php',
                    method: "POST",
                    data: { houseId: house_id, roomId: <?= $roomId ?> },
                    success: function (data) {
                        $('#amenity-container').html(data);
                    }
                });
            }

            $('#bhk-container').hide();
            $('#number-of-room-container').hide();

            // toggle bhk && number of room
            $('#room-type').change(function () {
                room_type = $('#room-type').val();
                if (room_type == "bhk") {
                    $('#bhk-container').show();
                    $('#number-of-room-container').hide();
                }
                else if (room_type == "non-bhk") {
                    $('#number-of-room-container').show();
                    $('#bhk-container').hide();
                }
            });

            $('#room-type').change();

            // loading input images instantly
            // room photo 1
            $('#room-photo-1').on('change', function (event) {
                var file = event.target.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#image-file-1').attr('src', e.target.result).show();
                    }
                    reader.readAsDataURL(file);
                } else {
                    event.preventDefault();
                    $('#image-file-1').attr('src', '/rentrover/assets/images/blank.jpg').show();
                }
            });

            // room photo 2
            $('#room-photo-2').on('change', function (event) {
                var file = event.target.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#image-file-2').attr('src', e.target.result).show();
                    }
                    reader.readAsDataURL(file);
                } else {
                    event.preventDefault();
                    $('#image-file-2').attr('src', '/rentrover/assets/images/blank.jpg').show();
                }
            });

            // room photo 3
            $('#room-photo-3').on('change', function (event) {
                var file = event.target.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#image-file-3').attr('src', e.target.result).show();
                    }
                    reader.readAsDataURL(file);
                } else {
                    event.preventDefault();
                    $('#image-file-3').attr('src', '/rentrover/assets/images/blank.jpg').show();
                }
            });

            // room photo 4
            $('#room-photo-4').on('change', function (event) {
                var file = event.target.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#image-file-4').attr('src', e.target.result).show();
                    }
                    reader.readAsDataURL(file);
                } else {
                    event.preventDefault();
                    $('#image-file-4').attr('src', '/rentrover/assets/images/blank.jpg').show();
                }
            });

            // file delete
            // photo 1
            $('#delete-image-1').click(function () {
                $('#image-file-1').attr('src', '/rentrover/uploads/rooms/<?= $photoSrc1 ?>').show();
                $('#room-photo-1').val('');
            });

            // photo 2
            $('#delete-image-2').click(function () {
                $('#image-file-2').attr('src', '/rentrover/uploads/rooms/<?= $photoSrc2 ?>').show();
                $('#room-photo-2').val('');
            });

            // photo 3
            $('#delete-image-3').click(function () {
                $('#image-file-3').attr('src', '/rentrover/uploads/rooms/<?= $photoSrc3 ?>').show();
                $('#room-photo-3').val('');
            });

            // photo 4
            $('#delete-image-4').click(function () {
                $('#image-file-4').attr('src', '/rentrover/uploads/rooms/<?= $photoSrc4 ?>').show();
                $('#room-photo-4').val('');
            });
        });
    </script>
</body>

</html>
<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

require_once __DIR__ . '/../../classes/user.php';
require_once __DIR__ . '/../../functions/district-array.php';
require_once __DIR__ . '/../../functions/amenity-array.php';
$profileUser = new User();

$profileUser->fetch($r_id, "all");

if($profileUser->flag != 'verified')
    header('Location: /rentrover/landlord/houses');

if (!isset($tab))
    $tab = isset($_GET['tab']) ? $_GET['tab'] : "view";

$page = "houses";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- title -->
    <title> Add House </title>

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

    <!-- prevent resubmission of the form -->
    <script>
        if (window.history.replaceState)
            window.history.replaceState(null, null, window.location.href);
    </script>
</head>

<body>
    <!-- aside -->
    <?php require_once __DIR__ . '/sections/aside.php'; ?>

    <main>
        <section class="add-house">
            <form class="form d-flex flex-column add-house-form" method="POST" id="add-house-form" enctype="multipart/form-data">
                <!-- top section -->
                <div class="d-flex flex-column flex-md-row row-gap-2 justify-content-between top-section">
                    <!-- heading -->
                    <p class="m-0 fs-3 fw-semibold"> Add New House </p>
                    <!-- rest or cancel -->
                    <div class="d-flex flex-row gap-2 justify-content-end mb-3">
                        <a class="btn btn-outline-secondary fit-content" id="form-reset"> Reset </a>
                        <a href="/rentrover/landlord/houses" class="btn btn-danger fit-content"> Cancel </a>
                    </div>
                </div>

                <!-- error message -->
                <p class="m-0 text-danger small error-message" id="error-message"> Error message appears here... </p>

                <!-- token -->
                <input type="hidden" name="add-house-csrf-token" class="form-control mt-3" placeholder="token id"
                    id="add-house-csrf-token">

                <!-- longitude & latitude -->
                <div class="d-flex flex-column flex-md-row gap-3 mt-3">
                    <input type="hidden" name="longitude" id="longitude" class="form-control" value="0"
                        placeholder="longitude">
                    <input type="hidden" name="latitude" id="latitude" class="form-control" value="0"
                        placeholder="latitude">
                </div>

                <!-- district && municipality -->
                <div class="d-flex flex-column flex-md-row w-100 gap-3 mt-3">
                    <!-- district -->
                    <div class="d-flex flex-column w-100 w-md-50 district">
                        <label for="district" class="mb-2 fw-semibold"> District </label>
                        <select name="district" class="form-select" id="district" required>
                            <option value="" selected hidden> Select District </option>
                            <?php
                            foreach ($districtArray as $districtList) {
                                ?>
                                <option value="<?= $districtList ?>"><?= $districtList ?> </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <!-- municipality-rural-municipality -->
                    <div class="d-flex flex-column w-100 w-md-50 municipality">
                        <label for="municipality-rural" class="mb-2 fw-semibold"> Municipality/ Rural
                            Municipality </label>
                        <input type="text" name="municipality-rural" id="municipality-rural" class="form-control"
                            required>
                    </div>
                </div>

                <!-- tole/ village && ward-->
                <div class="d-flex flex-column flex-md-row w-100 gap-3 mt-3">
                    <!-- tole/ village -->
                    <div class="w-100 w-md-50">
                        <label for="tole-village" class="mb-2 fw-semibold"> Tole/ Village </label>
                        <input type="text" name="tole-village" id="tole-village" class="form-control" required>
                    </div>

                    <!-- ward -->
                    <div class="w-100 w-md-50">
                        <label for="ward" class="mb-2 fw-semibold"> Ward </label>
                        <select name="ward" id="ward" class="form-select" required>
                            <option value="" selected hidden> Select ward </option>
                            <option value="1"> 1 </option>
                            <option value="2"> 2 </option>
                            <option value="3"> 3 </option>
                            <option value="4"> 4 </option>
                            <option value="5"> 5 </option>
                            <option value="6"> 6 </option>
                            <option value="7"> 7 </option>
                            <option value="8"> 8 </option>
                            <option value="9"> 9 </option>
                        </select>
                    </div>
                </div>

                <!-- landmark && photo -->
                <div class="d-flex flex-column flex-md-row w-100 w-md-50 flex-row gap-3 mt-3">
                    <div class="w-100">
                        <label for="nearest-landmark" class="fw-semibold mb-2"> Nearest Landmark </label>
                        <input type="text" name="nearest-landmark" id="nearest-landmark" class="form-control" maxlength="50" required>
                    </div>
                </div>

                <!-- photos -->
                <p class="fw-semibold mb-2 mt-3"> House Photo </p>
                <div class="d-flex flex-row gap-3 flex-wrap image-input-main-container">
                    <!-- container 1 -->
                    <div class="image-input-container">
                        <!-- image container -->
                        <div class="image-container" id="image-container-1">
                            <!-- background-image -->
                            <img src="/rentrover/assets/images/blank.jpg" alt="image-file-1" id="image-file-1">

                            <!-- delete icon -->
                            <div class="delete-div" id="delete-image-1">
                                <i class="fa fa-trash"> </i>
                            </div>

                            <!-- file input -->
                            <input type="file" name="house-photo-1" id="house-photo-1" accept=".jpg, .jpeg, .png, .webp"
                                required>
                        </div>

                        <label for="house-photo-1" class="upload-label small"> <i class="fa-solid fa-upload"></i> Upload
                            photo
                        </label>
                    </div>
                </div>

                <!-- amenities -->
                <p class="mb-2 mt-4 fw-semibold"> Amenities </p>
                <div class="d-flex gap-2 flex-wrap input-amenity-container">
                    <?php
                    $count = 0;
                    foreach ($amenityList as $amenity) {
                        $count++;
                        ?>
                        <div class="d-flex flex-row gap-2 input-amenity">
                            <input type="checkbox" name="amenity[]" value="<?= $amenity ?>" id="amenity-<?= $count ?>">

                            <label class="amenity-detail" for="amenity-<?= $count ?>">
                                <img src="/rentrover/assets/icons/amenities/<?= amenityIcon($amenity) ?>" alt="">
                                <p> <?= $amenity ?> </p>
                            </label>
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <!-- additional informations -->
                <label for="additional-info" class="mb-2 mt-3 fw-semibold"> Some additional informations </label>
                <textarea name="additional-info" class="form-control mb-2"
                    placeholder="Some information about the house or the requirements." id="additional-info" maxlength="255"></textarea>

                <!-- submit -->
                <button type="submit" class="btn btn-brand fit-content mt-3" id="add-house-btn"> Add Now </button>
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

    <!-- script -->
    <script src="/rentrover/js/popup-alert.js"></script>

    <!-- popup js -->
    <script src="/rentrover/js/popup-alert.js"></script>

    <script>
        $(document).ready(function () {
            // csrf token generation
            function generateCsrfToken() {
                $.ajax({
                    url: '/rentrover/app/csrf-token-generation.php',
                    success: function (data) {
                        $('#add-house-csrf-token').val(data);
                    }
                });
            }

            generateCsrfToken();

            // add house
            $('#add-house-form').submit(function (e) {
                e.preventDefault();
                var formData = new FormData($('#add-house-form')[0]);
                $.ajax({
                    url: '/rentrover/pages/landlord/app/add-house.php',
                    type: "POST",
                    data : formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('#add-house-btn').html("Adding...").prop('disabled', true);
                    },
                    success: function (response) {
                        if (response == "true") {
                            $('#error-message').fadeOut();

                            // show popup message
                            showPopupAlert("House added successfully.");

                            // reset form
                            $('#add-house-form').trigger("reset");

                            setTimeout(function(){
                                location.reload();
                            }, 2000);
                        } else {
                            $('#error-message').html("House counldn't be added.").fadeIn();
                        }
                        $('#add-house-btn').html("Add Now").prop('disabled', false);
                    },
                    error: function () {
                        $('#add-house-btn').html("Add Now").prop('disabled', false);
                    },
                });
            });

            // loading input images instantly
            // input 1
            $('#house-photo-1').on('change', function (event) {
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

            $('#delete-image-1').click(function () {
                $('#image-file-1').attr('src', '/rentrover/assets/images/blank.jpg').show();
                $('#house-photo-1').val('');
            });

            // form reset
            $('#form-reset').click(function () {
                $('#add-house-form').trigger("reset");
                $('#delete-image-1').click();
                generateCsrfToken();
            });
        });
    </script>
</body>

</html>
<?php
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
</head>

<body>
    <!-- aside -->
    <?php require_once __DIR__ . '/sections/aside.php'; ?>

    <main>
        <section class="add-house">
            <form action="" class="form d-flex flex-column add-house-form" id="add-house-form"
                enctype="multipart/form-data">
                <!-- top section -->
                <div class="d-flex flex-row justify-content-between top-section">
                    <!-- heading -->
                    <p class="m-0 fs-3 fw-semibold"> <?=$task == "add" ? "Add New House" : "Edit House"?> </p>
                    <!-- rest or cancel -->
                    <div class="d-flex flex-row gap-2 justify-content-end mb-3">
                        <a class="btn btn-outline-secondary" id="form-reset"> Reset </a>
                        <a href="/rentrover/landlord/houses" class="btn btn-danger"> Cancel </a>
                    </div>
                </div>

                <!-- error message -->
                <p class="m-0 text-danger small error-message" id="error-message"> Error message appears here... </p>

                <!-- token -->
                <input type="text" name="add_house_token" class="form-control mt-3" placeholder="token id"
                    id="add_house_token">

                <!-- longitude & latitude -->
                <div class="d-flex flex-column gap-3">
                    <input type="hidden" name="longitude" id="longitude" class="form-control" value="0"
                        placeholder="longitude">
                    <input type="hidden" name="latitude" id="latitude" class="form-control" value="0"
                        placeholder="latitude">
                </div>

                <!-- district && municipality -->
                <div class="d-flex flex-row w-100 gap-3 mt-3">
                    <!-- district -->
                    <div class="d-flex flex-column w-50 district">
                        <label for="district" class="mb-2 fw-semibold"> District </label>
                        <select name="district" class="form-select" id="district" required>
                            <option value="" selected hidden> Select District </option>
                            <option value="kathmandu"> Kathmandu </option>
                            <option value="bhaktapur"> Bhaktapur </option>
                            <option value="lalitpur"> Lalitpur </option>
                        </select>
                    </div>

                    <!-- municipality-rural-municipality -->
                    <div class="d-flex flex-column w-50 municipality">
                        <label for="municipality-rural-municipality" class="mb-2 fw-semibold"> Municipality/ Rural
                            Municipality </label>
                        <input type="text" name="municipality-rural-municipality" id="municipality-rural-municipality"
                            class="form-control">
                    </div>
                </div>

                <!-- tole/ village && ward-->
                <div class="d-flex flex-row w-100 gap-3 mt-3">
                    <!-- tole/ village -->
                    <div class="w-50">
                        <label for="tole-village" class="w-50 mb-2 fw-semibold"> Tole/ Village </label>
                        <input type="text" name="tole-village" id="tole-village" class="form-control">
                    </div>

                    <!-- ward -->
                    <div class="w-50">
                        <label for="ward" class="w-50 mb-2 fw-semibold"> Ward </label>
                        <select name="ward" id="ward" class="form-select">
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
                <div class="d-flex flex-row gap-3 mt-3">
                    <div class="w-50">
                        <label for="nearest-landmark" class="fw-semibold mb-2"> Nearest Landmark </label>
                        <input type="text" name="nearest-landmark" id="nearest-landmark" class="form-control">
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
                            <input type="file" name="house-photo-1" id="house-photo-1" required>
                        </div>

                        <label for="house-photo-1" class="upload-label small"> <i class="fa-solid fa-upload"></i> Upload
                            photo
                        </label>
                    </div>
                </div>

                <!-- amenities -->
                <p class="mb-2 mt-4 fw-semibold"> Amenities </p>
                <div class="d-flex gap-2 flex-wrap input-amenity-container">
                    <!-- amenity 1 -->
                    <div class="d-flex flex-row gap-2 input-amenity">
                        <input type="checkbox" name="amenity-1" id="amenity-1">

                        <label class="amenity-detail" for="amenity-1">
                            <img src="/rentrover/assets/icons/amenities/air-conditioner.png" alt="">
                            <p> Amenity 1 </p>
                        </label>
                    </div>

                    <!-- amenity 2 -->
                    <div class="d-flex flex-row gap-2 input-amenity">
                        <input type="checkbox" name="amenity-2" id="amenity-2">

                        <label class="amenity-detail" for="amenity-2">
                            <img src="/rentrover/assets/icons/amenities/air-conditioner.png" alt="">
                            <p> Amenity 2 </p>
                        </label>
                    </div>

                    <!-- amenity 3 -->
                    <div class="d-flex flex-row gap-2 input-amenity">
                        <input type="checkbox" name="amenity-3" id="amenity-3">

                        <label class="amenity-detail" for="amenity-3">
                            <img src="/rentrover/assets/icons/amenities/air-conditioner.png" alt="">
                            <p> Amenity 3 </p>
                        </label>
                    </div>
                </div>

                <!-- additional informations -->
                <label for="additional-info" class="mb-2 mt-3 fw-semibold"> Some additional informations </label>
                <textarea name="additional-info" class="form-control mb-2"
                    placeholder="Some information about the house or the requirements." id="additional-info"></textarea>

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

    <script>
        $(document).ready(function () {
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
            });
        });
    </script>
</body>

</html>
<?php
$page = "rooms";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- title -->
    <title> Add Room </title>

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
            <form class="form d-flex flex-column add-house-form" id="add-room-form" enctype="multipart/form-data">
                <!-- top section -->
                <div class="d-flex flex-row justify-content-between top-section">
                    <!-- heading -->
                    <p class="m-0 fs-3 fw-semibold"> Add Room </p>
                    <!-- rest or cancel -->
                    <div class="d-flex flex-row gap-2 justify-content-end mb-3">
                        <a class="btn btn-outline-secondary" id="form-reset"> Reset </a>
                        <a class="btn btn-danger" href="/rentrover/pages/landlord/rooms.php"> Cancel </a>
                    </div>
                </div>

                <!-- error message -->
                <p class="m-0 text-danger small error-message" id="error-message"> Error message appears here... </p>

                <!-- token -->
                <input type="text" name="add_room_token" class="form-control mt-3" placeholder="token id"
                    id="add_room_token" required>

                <div class="d-flex flex-row gap-3">
                    <!-- house -->
                    <div class="w-50">
                        <label for="bhk" class="mb-2 fw-semibold mt-3"> Select House </label>
                        <select name="house-id" id="house-id" class="form-select" required>
                            <option value="" selected hidden> Select house </option>
                            <option value="id-1"> Address 1 </option>
                            <option value="id-2"> Address 2 </option>
                        </select>
                    </div>

                    <!-- room type -->
                    <div class="w-50">
                        <label for="bhk" class="mb-2 fw-semibold mt-3"> Room Type </label>
                        <select name="room-type" id="room-type" class="form-select" required>
                            <option value="" selected hidden> Select room type </option>
                            <option value="bhk"> BHK </option>
                            <option value="non-bhk"> Non-BHK </option>
                        </select>
                    </div>
                </div>


                <div class="d-flex flex-row gap-3">
                    <!-- bhK -->
                    <div class="w-50">
                        <label for="bhk" class="mb-2 fw-semibold mt-3"> BHK </label>
                        <input type="number" name="bhk" class="form-control" id="bhk">
                    </div>

                    <!-- number of room -->
                    <div class="w-50">
                        <label for="number-of-room" class="mb-2 fw-semibold mt-3"> Number of room </label>
                        <input type="number" name="number-of-room" class="form-control" id="number-of-room">
                    </div>
                </div>

                <div class="d-flex flex-row gap-3">
                    <!-- room number -->
                    <div class="w-50">
                        <label for="room-number" class="mb-2 fw-semibold mt-3"> Room Number </label>
                        <input type="number" name="room-number" class="form-control" id="room-number" required>
                    </div>

                    <!-- furnishing -->
                    <div class="w-50">
                        <label for="" class="mb-2 fw-semibold mt-3"> Furnishing </label>
                        <select name="room-type" id="room-type" class="form-select" required>
                            <option value="" selected hidden> Select room type </option>
                            <option value="unfurnished"> Unfurnished </option>
                            <option value="non-semi-furnished"> Semi-furnished </option>
                            <option value="fully-furnished"> Fully-furnished </option>
                        </select>
                    </div>
                </div>

                <div class="d-flex flex-row gap-3">
                    <!-- floor -->
                    <div class="w-50">
                        <label for="floor" class="mb-2 fw-semibold mt-3"> Floor </label>
                        <input type="number" name="floor" class="form-control" id="floor" min="0" required>
                    </div>

                    <!-- rent -->
                    <div class="w-50">
                        <label for="rent" class="mb-2 fw-semibold mt-3"> Rent </label>
                        <input type="number" name="rent" class="form-control" id="rent" min="0" required>
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
                            <img src="/rentrover/assets/images/blank.jpg" alt="image-file-1" id="image-file-1">

                            <!-- delete icon -->
                            <div class="delete-div" id="delete-image-1">
                                <i class="fa fa-trash"> </i>
                            </div>

                            <!-- file input -->
                            <input type="file" name="room-photo-1" id="room-photo-1" required>
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
                            <img src="/rentrover/assets/images/blank.jpg" alt="image-file-2" id="image-file-2">

                            <!-- delete icon -->
                            <div class="delete-div" id="delete-image-2">
                                <i class="fa fa-trash"> </i>
                            </div>

                            <!-- file input -->
                            <input type="file" name="room-photo-2" id="room-photo-2" required>
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
                            <img src="/rentrover/assets/images/blank.jpg" alt="image-file-3" id="image-file-3">

                            <!-- delete icon -->
                            <div class="delete-div" id="delete-image-3">
                                <i class="fa fa-trash"> </i>
                            </div>

                            <!-- file input -->
                            <input type="file" name="room-photo-3" id="room-photo-3" required>
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
                            <img src="/rentrover/assets/images/blank.jpg" alt="image-file-4" id="image-file-4">

                            <!-- delete icon -->
                            <div class="delete-div" id="delete-image-4">
                                <i class="fa fa-trash"> </i>
                            </div>

                            <!-- file input -->
                            <input type="file" name="room-photo-4" id="room-photo-4" required>
                        </div>

                        <label for="room-photo-4" class="upload-label small"> <i class="fa-solid fa-upload"></i> Upload
                            photo
                        </label>
                    </div>
                </div>

                <!-- requirements -->
                <div class="">
                    <label for="additional-info" class="mb-2 fw-semibold mt-3"> Additional Informationn </label>
                    <textarea name="additional-info" class="form-control" id="additional-info"></textarea>
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

                <button type="submit" class="btn btn-brand fit-content mt-3" id="add-room-btn"> Add Now </button>
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
                $('#image-file-1').attr('src', '/rentrover/assets/images/blank.jpg').show();
                $('#room-photo-1').val('');
            });

            // photo 2
            $('#delete-image-2').click(function () {
                $('#image-file-2').attr('src', '/rentrover/assets/images/blank.jpg').show();
                $('#room-photo-2').val('');
            });

            // photo 3
            $('#delete-image-3').click(function () {
                $('#image-file-3').attr('src', '/rentrover/assets/images/blank.jpg').show();
                $('#room-photo-3').val('');
            });

            // photo 4
            $('#delete-image-4').click(function () {
                $('#image-file-4').attr('src', '/rentrover/assets/images/blank.jpg').show();
                $('#room-photo-4').val('');
            });

            // form reset
            $('#form-reset').click(function () {
                $('#add-room-form').trigger("reset");

                // reset photo container
                $('#delete-image-1').click();
                $('#delete-image-2').click();
                $('#delete-image-3').click();
                $('#delete-image-4').click();
            });
        });
    </script>
</body>

</html>
<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

require_once __DIR__ . '/../../classes/user.php';
require_once __DIR__ . '/../../classes/house.php';
require_once __DIR__ . '/../../classes/room.php';

$profileUser = new User();
$profileUser->fetch($r_id, "all");

$houseObj = new House();
$roomObj = new Room();

$roomExists = $roomObj->fetch($roomId);

if (!isset($tab))
    $tab = isset($_GET['tab']) ? $_GET['tab'] : "view";

$page = "rooms";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- title -->
    <title> Room Details </title>

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
    <link rel="stylesheet" href="/rentrover/css/room-detail.css">
    <link rel="stylesheet" href="/rentrover/css/review.css">
    <link rel="stylesheet" href="/rentrover/css/popup-alert.css">
    <link rel="stylesheet" href="/rentrover/css/aside.css">
</head>

<body>
    <!-- aside -->
    <?php include __DIR__ . '/sections/aside.php'; ?>

    <main>
        <?php
        require_once __DIR__ . '/../../functions/amenity-array.php';

        $houseObj = new House();
        $houseExists = $houseObj->fetch($roomObj->houseId);

        if (!$houseExists) {
            ?>
            <p class="m-0 fs-1 fw-bold"> Room not found! </p>
            <?php
        } else {
            if ($houseObj->getLandlordId() != $r_id) {
                ?>
                <p class="m-0 fs-1 fw-bold"> Room not found! </p>
                <?php
            } else {
                ?>
                <!-- room detail -->
                <section class="room-detail-container">
                    <!-- top section -->
                    <!-- address, rating, wishlist -->
                    <div class="d-flex flex-row justify-content-between">
                        <div class="d-flex flex-column gap-1 address-review top-section">
                            <p class="m-0 fw-bold fs-4"> <?= $houseObj->getAddress() ?> </p>

                            <div class="d-flex flex-row gap-2 align-items-center rating-div" id="rating-div">
                                <div class="rating">
                                    <img src="/rentrover/assets/icons/full-star.png" alt="">
                                </div>
                                <p class="m-0 text-secondary small pt-1"> (0 Review) </p>
                            </div>
                        </div>
                    </div>

                    <!-- image -->
                    <div class="d-flex flex-column mt-4 gap-2 room-image-container">
                        <?php $roomObj->fetchPhotos($roomId); ?>

                        <div class="left">
                            <img src="/rentrover/uploads/rooms/<?= $roomObj->photo['first'] ?>" alt="">
                        </div>

                        <div class="d-flex flex-row flex-wrap gap-2 right">
                            <div class="room-image">
                                <img src="/rentrover/uploads/rooms/<?= $roomObj->photo['first'] ?>" alt="">
                            </div>

                            <div class="room-image">
                                <img src="/rentrover/uploads/rooms/<?= $roomObj->photo['second'] ?>" alt="">
                            </div>

                            <div class="room-image">
                                <img src="/rentrover/uploads/rooms/<?= $roomObj->photo['third'] ?>" alt="">
                            </div>

                            <div class="room-image">
                                <img src="/rentrover/uploads/rooms/<?= $roomObj->photo['fourth'] ?>" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column-reverse flex-xl-row details">
                        <!-- requirememnts, amenities and reviews -->
                        <div class="d-flex flex-column gap-3 mt-3 mt-lg-5 requirements-amenities-reviews">
                            <!-- nearest landmark -->
                            <div class="requirements">
                                <h3 class="m-0 fw-semibold"> Nearest Landmark </h3>
                                <p class="m-0 mt-3"> <?= ucfirst($houseObj->address['nearestLandmark']) ?> </p>
                            </div>

                            <!-- additional info -->
                            <div class="requirements mt-4">
                                <h3 class="m-0 fw-semibold"> Additional Information </h3>
                                <p class="m-0 mt-3"> <?= ucfirst($houseObj->info) ?> </p>
                            </div>

                            <!-- amenities -->
                            <h3 class="m-0 fw-semibold mt-4"> Amenities </h3>
                            <div class="d-flex flex-row mt-3 flex-wrap gap-2 amenity-container">
                                <?php $roomObj->fetchAmenity($roomId) ?>
                                <?php
                                foreach ($roomObj->amenity as $amenity) {
                                    if ($amenity != '') {

                                        ?>
                                        <!-- amenity -->
                                        <div class="amenity">
                                            <img src="/rentrover/assets/icons/amenities/<?= amenityIcon($amenity) ?>" alt=""
                                                class="amenity-icon">
                                            <p> <?= $amenity ?> </p>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>

                            <!-- reviews -->
                            <h3 class="m-0 fw-semibold mt-3"> Reviews and Ratings </h3>
                            <div class="review-container" id="review-container">
                                <div class="invisible review-div">
                                    <div class="image">
                                        <img src="/rentrover/assets/images/rupak.png" alt="">
                                    </div>
                                    <div class="review-details">
                                        <p class="reviewer"> Tenant Name </p>
                                        <p class="review"> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Impedit,
                                            cupiditate non eligendi sed reiciendis, sapiente eum deleniti nam recusandae eveniet
                                            commodi suscipit eius architecto ut veniam laboriosam! Provident, nisi natus? </p>
                                        <div class="rating">
                                            <img src="/rentrover/assets/icons/full-star.png" alt="">
                                            <img src="/rentrover/assets/icons/full-star.png" alt="">
                                            <img src="/rentrover/assets/icons/half-star.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- remaining specs -->
                        <div class="mt-4 mt-lg-5 specifications">
                            <table class="border table mt-0 specification-table">
                                <!-- room number -->
                                <tr>
                                    <td class="title"> Room Number </td>
                                    <td class="data"> <?= $roomObj->number ?> </td>
                                </tr>

                                <!-- house -->
                                <tr>
                                    <td class="title"> House ID </td>
                                    <td class="data"> <?= $houseObj->houseId ?> </td>
                                </tr>

                                <!-- type -->
                                <tr>
                                    <td class="title"> Type </td>
                                    <td class="data"> <?= $roomObj->type == 'bhk' ? 'BHK' : "Non-BHK" ?> </td>
                                </tr>

                                <!-- furnishing -->
                                <tr>
                                    <td class="title"> Furnishing </td>
                                    <td class="data"> <?= ucwords($roomObj->furnishing) ?> </td>
                                </tr>

                                <!-- floor -->
                                <tr>
                                    <td class="title"> Floor </td>
                                    <td class="data"> <?= $roomObj->floor ?> </td>
                                </tr>

                                <!-- type -->
                                <tr>
                                    <td class="title"> Rent Amount </td>
                                    <td class="data text-success fw-semibold"> <?= "NPR." . number_format($roomObj->rent, 2) ?>
                                    </td>
                                </tr>

                                <!-- room acquired state -->
                                <tr>
                                    <td class="title"> Room state </td>
                                    <td class="data"> <?= ucfirst($roomObj->flag) ?> </td>
                                </tr>

                                <!-- added date -->
                                <tr>
                                    <td class="title"> Added on </td>
                                    <td class="data"> <?= $roomObj->registrationDate ?> </td>
                                </tr>
                            </table>

                            <!-- actions :: edit || delete -->
                            <div class="room-operations">
                                <a href="/rentrover/landlord/edit-room/<?= $roomId ?>" type="button"
                                    class="btn btn-outlined-brand"> <i class="fa-solid fa-arrow-up-right-from-square"></i> Edit
                                </a>
                                <button class="btn btn-danger" data-leave-application-id="" data-bs-toggle="modal"
                                    data-bs-target="#deleteRoomModal"> <i class="fa fa-trash"></i> Delete Room </button>
                            </div>
                        </div>
                    </div>

                    <!-- room delete modal -->
                    <div class="modal fade" id="deleteRoomModal" tabindex="-1" aria-labelledby="deleteRoomModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="deleteRoomModalLabel"> Delete Room </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="d-flex flex-column modal-body">
                                    <h3> Are your you want to delete this room permanently? </h3>

                                    <p class="text-secondary mb-2"> Note: You must remove the tenant first if your room is still
                                        acquired. </p>

                                    <!-- action -->
                                    <div class="d-flex flex-row row-gap-2 action mt-2 gap-2">
                                        <?php
                                        if ($roomObj->flag == 'verified') {
                                            ?>
                                            <button class="btn btn-outline-danger" id="delete-room-btn"> <i class="fa fa-trash"></i>
                                                Delete Now </button>
                                            <?php
                                        }
                                        ?>
                                        <button class="btn btn-success" data-bs-dismiss="modal" aria-label="Close"> <i
                                                class="fa fa-multiply"></i> Cancel </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php
            }
            ?>
            <?php
        }
        ?>
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

    <!-- top bar rating -->
    <script src="/rentrover/js/load-top-bar-rating.js"></script>

    <script>
        $(document).ready(function () {
            $('#delete-room-btn').click(function () {
                $.ajax({
                    url: '/rentrover/pages/landlord/app/delete-room.php',
                    type: "POST",
                    data: { roomId: <?= $roomId ?> },
                    beforeSend: function () {
                        $('#delete-room-btn').html("Deleting...").prop('disabled', true);
                    }, success: function (response) {
                        if (response == "true") {
                            showPopupAlert("Room deleted successfully.");
                            $(location).attr('href', '/rentrover/landlord/rooms');
                        } else {
                            showPopupAlert("Room couldn't be deleted.");
                        }
                        $('#delete-room-btn').html("<i class='fa fa-trash'></i>Delete Now").prop('disabled', false);
                    }, error: function () {
                        $('#delete-room-btn').html("<i class='fa fa-trash'></i>Delete Now").prop('disabled', false);
                    }
                });
            });

            // loca reviews
            // load reviews
            function loadReviews() {
                $.ajax({
                    url: '/rentrover/pages/tenant/sections/load-review.php',
                    type: 'POST',
                    data: { roomId: <?= $roomId ?> },
                    success: function (data) {
                        loadTopBarRating(<?= $roomId ?>);
                        $('#review-container').html(data);
                    }
                });
            }

            loadReviews();
        });
    </script>
</body>

</html>
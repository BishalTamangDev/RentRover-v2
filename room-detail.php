<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

require_once __DIR__ . '/classes/house.php';
require_once __DIR__ . '/classes/room.php';

$houseObj = new House();
$roomObj = new Room();

// fetch room detail
$roomExists = $roomObj->fetch($roomId);

if ($roomExists) {
    $houseObj->fetch($roomObj->houseId);
    $location = $houseObj->getAddress();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- title -->
    <title> Room Detail: <?php echo $roomExists ? $location : "Room Not Found!"; ?> </title>

    <link rel="icon" type="image/x-icon" href="/rentrover/assets/brands/rentrover-circular-logo.png">

    <!-- css files -->
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- bootstrap :: cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- bootstrap :: local -->
    <link rel="stylesheet" href="/rentrover/bootstrap/bootstrap-css-5.3.3/bootstrap.min.css">

    <!-- favicon -->
    <link rel="stylesheet" href="/rentrover/css/style.css">
    <link rel="stylesheet" href="/rentrover/css/header-unsigned.css">
    <link rel="stylesheet" href="/rentrover/css/room-detail.css">
    <link rel="stylesheet" href="/rentrover/css/review.css">
</head>

<body>
    <!-- header -->
    <?php require_once __DIR__ . '/sections/header-unsigned.php'; ?>

    <!-- room detail -->
    <?php
    if (!$roomExists) {
        ?>
        <section class="container room-detail-container pb-5" style="margin-top: 5rem;">
            <p class="m-0 fs-1 fw-bold"> Room not found! </p>
        </section>
        <?php
    } else {
        require_once __DIR__ . '/functions/amenity-array.php';

        $houseExists = $houseObj->fetch($roomObj->houseId);

        if (!$houseExists) {
            ?>
            <section class="container room-detail-container pb-5" style="margin-top: 5rem;">
                <p class="m-0 fs-1 fw-bold"> House not found! </p>
            </section>
            <?php
        } else {
            ?>
            <!-- room detail -->
            <section class="container room-detail-container pb-5" style="margin-top: 5rem;">
                <!-- top section -->
                <!-- address, rating, wishlist -->
                <div class="d-flex flex-row justify-content-between">
                    <div class="d-flex flex-column gap-1 address-review top-section">
                        <p class="m-0 fw-bold fs-4"> <?=$location?> </p>

                        <div class="d-flex flex-row gap-2 align-items-center rating-div">
                            <div class="rating">
                                <img src="/rentrover/assets/icons/full-star.png" alt="">
                                <img src="/rentrover/assets/icons/full-star.png" alt="">
                                <img src="/rentrover/assets/icons/full-star.png" alt="">
                                <img src="/rentrover/assets/icons/full-star.png" alt="">
                                <img src="/rentrover/assets/icons/half-star.png" alt="">
                            </div>
                            <p class="m-0 text-secondary small pt-1"> (3 Reviews) </p>
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
                        <div class="d-flex flex-row mt-2 flex-wrap gap-2 amenity-container">
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
                        <h3 class="m-0 fw-semibold mt-4"> Reviews and Ratings </h3>
                        <div class="review-container">
                            <div class="review-div">
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
                                <td class="data">
                                    <?php
                                    echo $roomObj->floor;
                                    $x = $roomObj->floor % 10;
                                    ?>
                                    <sup>
                                        <?php
                                        if ($x == 1) {
                                            echo "st";
                                        } elseif ($x == 2) {
                                            echo "nd";
                                        } elseif ($x == 3) {
                                            echo "rd";
                                        } else {
                                            echo "th";
                                        }
                                        ?> </sup>
                                </td>
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
                                <td class="data"> <?= $roomObj->flag == 'verified' ? "Available" : 'Nor-available' ?> </td>
                            </tr>
                        </table>

                        <div class="room-operations">
                            <button type="button" class="btn btn-brand" data-bs-toggle="modal" data-bs-target="#login-modal">
                                Apply Now </button>
                        </div>
                    </div>
                </div>
            </section>
            <?php
        }
    }
    ?>


    <!-- modal -->
    <div class="modal fade" id="login-modal" tabindex="-1" aria-labelledby="login modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="p-3 modal-content">
                <div class="d-flex flex-row justify-content-between heading">
                    <h5 class="m-0"> You need to login first to proceed. </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <a href="/rentrover/login" class="btn btn-brand fit-content mt-3"> Login Now </a>
            </div>
        </div>
    </div>

    <!-- bootstrap js :: cdn -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- bootstrap js :: local -->
    <script type="text/javascript" src="/rentrover/bootstrap/bootstrap-js-5.3.3/bootstrap.bundle.min.js"> </script>

    <!-- jquery -->
    <script src="/rentrover/jquery/jquery-3.7.1.min.js"></script>
</body>

</html>
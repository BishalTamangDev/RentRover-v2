<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

require_once __DIR__ . '/../../classes/admin.php';
require_once __DIR__ . '/../../classes/house.php';
require_once __DIR__ . '/../../classes/room.php';

$profileUser = new Admin();
$profileUser->fetch($r_id, "all");

$houseObj = new House();
$roomObj = new Room();

$roomExists = $roomObj->fetch($roomId);

if (!isset($page))
    $page = "rooms";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- title -->
    <title> Room Detail </title>

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
    <link rel="stylesheet" href="/rentrover/css/aside.css">
</head>

<body>
    <?php require_once __DIR__ . '/sections/aside.php'; ?>

    <main>
        <?php
        if ($roomExists) {
            require_once __DIR__ . '/../../functions/amenity-array.php';

            $houseObj = new House();
            $houseExists = $houseObj->fetch($roomObj->houseId);

            if (!$houseExists) {
                ?>
                <p class="m-0 fs-1 fw-bold"> House not found! </p>
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
                            <div class="review-container" id="review-container">
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

                                <!-- house -->
                                <tr>
                                    <td class="title"> House ID </td>
                                    <td class="data"> <?= $houseObj->houseId ?> </td>
                                </tr>

                                <!-- landlord name -->
                                <tr>
                                    <td class="title"> Landlord </td>
                                    <td class="data"> - </td>
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
                                    <td class="data"> <?php
                                    $floor = $roomObj->floor;
                                    $x = $floor % 10;
                                    switch ($x) {
                                        case 1:
                                            echo '1<sup>st</sup>';
                                            break;
                                        case 2:
                                            echo '2<sup>nd</sup>';
                                            break;
                                        case 3:
                                            echo '3<sup>rd</sup>';
                                            break;
                                        default:
                                            echo "$floor<sup>th</sup>";
                                    }
                                    ?> </td>
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

                            <div class="action">
                                <button type="button" class="btn btn-outline-danger"> <i class="fa-regular fa-flag"></i>
                                    Unverify Room </button>
                                <button type="button" class="btn btn-success"> <i class="fa-solid fa-check"></i> Verify Room
                                </button>
                            </div>
                        </div>
                    </div>
                </section>
                <?php
            }
            ?>
            <?php
        } else {
            ?>
            <p class="m-0 fs-1 fw-bold"> Room not found! </p>
            <?php
        }
        ?>
    </main>

    <!-- bootstrap js :: cdn -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- bootstrap js :: local -->
    <script type="text/javascript" src="/rentrover/bootstrap/bootstrap-js-5.3.3/bootstrap.bundle.min.js"> </script>

    <!-- jquery -->
    <script src="/rentrover/jquery/jquery-3.7.1.min.js"></script>

    <!-- top bar rating -->
    <script src="/rentrover/js/load-top-bar-rating.js"></script>

    <script>
        $(document).ready(function () {
            loadTopBarRating(<?= $roomId ?>);
            loadReviews();

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
        });
    </script>
</body>

</html>
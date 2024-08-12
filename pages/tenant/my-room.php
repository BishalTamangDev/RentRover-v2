<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

require_once __DIR__ . '/../../classes/user.php';
require_once __DIR__ . '/../../classes/house.php';
require_once __DIR__ . '/../../classes/room.php';
require_once __DIR__ . '/../../classes/leave-application.php';
require_once __DIR__ . '/../../functions/amenity-array.php';

$profileUser = new User();
$houseObj = new House();
$roomObj = new Room();
$leaveObj = new Leave();

$profileUser->fetch($r_id, "all");

$page = "my-room";

$tempPhotoSrc = '/rentrover/uploads/blank.jpg';

// fetch room detail
$roomId = $roomObj->fetchTenantRoom($r_id);

$roomExists = $roomId != 0 ? true : false;

if ($roomExists) {
    $roomExists = $roomObj->fetch($roomId);
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
    <title> My Room: <?php echo $roomExists ? $location : "Room Not Found!"; ?> </title>

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
    <link rel="stylesheet" href="/rentrover/css/room-detail.css">
    <link rel="stylesheet" href="/rentrover/css/review.css">
    <link rel="stylesheet" href="/rentrover/css/header.css">
    <link rel="stylesheet" href="/rentrover/css/room.css">
    <link rel="stylesheet" href="/rentrover/css/footer.css">
    <link rel="stylesheet" href="/rentrover/css/popup-alert.css">
    <link rel="stylesheet" href="/rentrover/css/tenant/room-detail.css">

    <!-- prevent resubmission of the form -->
    <script>
        if (window.history.replaceState)
            window.history.replaceState(null, null, window.location.href);
    </script>
</head>

<body>
    <!-- header -->
    <?php require_once __DIR__ . '/sections/header.php'; ?>

    <!-- room detail -->
    <?php
    if (!$roomExists) {
        ?>
        <section class="container room-detail-container pb-4">
            <h3 class="m-0 fw-semibold mt-5"> You are not associated to any room at this moment. </h3>
            <a href="/rentrover/home" class="btn btn-brand mt-3 fit-content"> <i class="fa fa-search"></i> Find Room Now
            </a>
        </section>
        <?php
    } else {
        ?>
        <section class="container room-detail-container pb-4">
            <!-- top section -->
            <!-- address, rating -->
            <div class="d-flex flex-row justify-content-between">
                <div class="d-flex flex-column gap-1 address-review top-section">
                    <p class="m-0 fw-bold fs-4"> <?= $location ?> </p>

                    <div class="d-flex flex-row gap-2 align-items-center rating-div" id="rating-div">
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
                    <h3 class="m-0 fw-semibold mt-4"> Submit your thoughts on for this room </h3>

                    <form action="" class="form review-form rounded shadow p-3" id="review-form">
                        <input type="hidden" name="userId" id="userId" class="form-control mb-3" value="<?= $r_id ?>">
                        <input type="hidden" name="roomId" id="roomId" class="form-control mb-3" value="<?= $roomId ?>">
                        <textarea name="review" id="review" class="form-control mb-3" placeholder="submit your review here"
                            style="min-height:140px;max-height:200px;" required></textarea>
                        <select name="rating" id="rating" class="form-select fit-content mb-3" required>
                            <option value=""> Select rating </option>
                            <option value="1"> 1 </option>
                            <option value="2"> 2 </option>
                            <option value="3"> 3 </option>
                            <option value="4"> 4 </option>
                            <option value="5"> 5 </option>
                        </select>
                        <button class="btn btn-brand"> Submit </button>
                    </form>

                    <h3 class="m-0 fw-semibold mt-4"> Reviews and Ratings </h3>

                    <div class="review-container" id="review-container">
                        <!-- review -->
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

                                <!-- action -->
                                <div>
                                    <abbr title="Delete">
                                        <i class="fa fa-trash"></i>
                                        </a>
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

                        <!-- tenancy hostory -->
                        <tr>
                            <td class="title"> Move in Date </td>
                            <td class="data text-success fw-semibold"> <?= "-" ?>
                            </td>
                        </tr>
                    </table>

                    <div class="d-flex gap-2 flex-wrap room-operations">
                        <!-- check if leave application has been submitted already -->
                        <?php
                            $alreadyApplied = $leaveObj->checkApplicantionForTenantAndRoom($r_id, $roomId);

                            if ($alreadyApplied) {
                                ?>
                                <p class="text-danger small"> <i class="fa-solid fa-arrow-right-from-bracket"></i> Leave application already submitted
                                </p>
                            <?php
                            } else {
                                ?>
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#leave-room-modal" id="leave-room-btn"> <i
                                        class="fa-solid fa-arrow-right-from-bracket"></i> Leave room </button>
                                        
                                        <!-- report issue -->
                                        <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#report-an-issue" id="report-issue-btn">
                                            <i class="fa-regular fa-comment"></i> Report an Issue </button>
                            <?php
                            }
                            ?>
                        
                    </div>
                </div>
        </section>
        <?php
    }
    ?>

    <!-- leave room modal -->
    <div class="modal fade" id="leave-room-modal" tabindex="-1" aria-labelledby="leave-room-modal-label"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="d-flex flex-row justify-content-between modal-header">
                    <h1 class="modal-title fs-5" id="leave-room-modal-label"> Leave Room Application </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="leave-application-modal-close-trigger"></button>
                </div>
                <div class="modal-body">
                    <p class="text-danger small error-message mb-3" id="leave-application-error-message"> Error message
                        appears here...
                    </p>
                    <form method="POST" class="leave-room-form" id="leave-application-form">
                        <!-- room id -->
                        <input type="hidden" name="leave-room-id" id="leave-room-id" value="<?= $roomId ?>"
                            class="form-control mb-3" required>

                        <!-- tenant id -->
                        <input type="hidden" name="leave-tenant-id" id="leave-tenant-id" value="<?= $r_id ?>"
                            class="form-control mb-3" required>

                        <!-- move out date -->
                        <div>
                            <label for="leave-move-out-date" class="mb-2"> Move out date </label>
                            <input type="date" name="leave-move-out-date" id="leave-move-out-date"
                                class="form-control mb-3" required>
                        </div>

                        <!-- note -->
                        <div>
                            <label for="leave-note" class="mb-2"> Note </label>
                            <textarea name="leave-note" id="leave-note" placeholder="write here..."
                                class="form-control mb-3"></textarea>
                        </div>
                        <button class="btn btn-brand fit-content" id="leave-application-button"> Submit </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- report and issue modal -->
    <div class="modal fade" id="report-an-issue" tabindex="-1" aria-labelledby="report-an-issue-label"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="report-an-issue-label"> Report an Issue </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="issue-modal-close"></button>
                </div>

                <div class="modal-body">
                    <p class="text-danger small error-message mb-3" id="issue-error-message"> Error message appears
                        here...
                    </p>
                    <form class="leave-room-form" id="issue-application-form">
                        <!-- room id -->
                        <input type="hidden" name="issue-room-id" id="issue-room-id" value="<?= $roomId ?>"
                            class="form-control mb-3" required>

                        <!-- issue -->
                        <div>
                            <label for="issue-note" class="mb-2"> Issue </label>
                            <textarea name="issue-note" id="issue-note" placeholder="write here..."
                                class="form-control mb-3" required style="max-height: 50vh"></textarea>
                        </div>
                        <button class="btn btn-brand fit-content" id="issue-submit-btn"> Submit </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- popup alert -->
    <div class="popup-alert-container" id="popup-alert-container">
        <p id="popup-message"> Popup alert content. </p>
    </div>

    <!-- footer -->
    <?php require_once __DIR__ . '/../../sections/footer.php'; ?>

    <!-- bootstrap js :: cdn -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- bootstrap js :: local -->
    <script type="text/javascript" src="/rentrover/bootstrap/bootstrap-js-5.3.3/bootstrap.bundle.min.js"> </script>

    <!-- jquery -->
    <script src="/rentrover/jquery/jquery-3.7.1.min.js"></script>

    <!-- js :: notification & profile menu -->
    <script type="text/javascript" src="/rentrover/js/tenant.js"></script>

    <!-- popup js -->
    <script src="/rentrover/js/popup-alert.js"></script>

    <!-- delete review -->
    <!-- <script src="/rentrover/js/delete-review.js"></script> -->

    <!-- top bar rating -->
    <script src="/rentrover/js/load-top-bar-rating.js"></script>

    <!-- script -->
    <script>
        $(document).ready(function () {
            loadTopBarRating(<?= $roomId ?>);

            // load wishlist count
            $(document, loadWishlistCount());

            loadReviews();

            // leave application form
            $('#leave-application-form').submit(function (e) {
                e.preventDefault();

                // check date
                var leave_date = new Date($('#leave-move-out-date').val());
                leave_date.setHours(0, 0, 0, 0);

                var currentDate = new Date();
                currentDate.setHours(0, 0, 0, 0);

                if (leave_date < currentDate) {
                    // show error message
                    $('#leave-application-error-message').html('Please select the valid date').fadeIn();
                } else {
                    $('#leave-application-error-message').fadeOut();
                    $.ajax({
                        url: '/rentrover/pages/tenant/app/submit-leave-application.php',
                        type: 'POST',
                        data: $(this).serialize(),
                        success: function (response) {
                            $('#leave-application-modal-close-trigger').click();
                            if (response) {
                                showPopupAlert('Application has been submitted.');
                                $('#report-issue-btn').fadeOut();
                                $('#leave-room-btn').html("<i class='fa fa-check'> </i> Leave application submitted").prop('disabled', true);
                            } else {
                                $('#leave-application-error-message').html('An error occured').fadeIn();
                            }
                        }
                    });
                }
            });

            // issue application form
            $('#issue-application-form').submit(function (e) {
                e.preventDefault();
                user_id = <?= $r_id ?>;
                room_id = $('#issue-room-id').val() ?? 0;
                form_issue = $('#issue-note').val();

                if (form_issue.trim() === "") {
                    $('#issue-error-message').html("Please enter about the issue first.").fadeIn();
                } else if (room_id == '0') {
                    $('#issue-error-message').html("An error occured.").fadeIn();
                } else {
                    $.ajax({
                        url: '/rentrover/pages/tenant/app/issue-submit.php',
                        type: 'POST',
                        data: {
                            userId: user_id,
                            roomId: room_id,
                            issue: form_issue,
                        },
                        beforeSend: function () {
                            $('#issue-submit-btn').html("Submitting...").prop('disabled', true);
                        },
                        success: function (response) {
                            if (response == true) {
                                $('#issue-modal-close').click();
                                showPopupAlert("Issue has been submitted.");
                                $('#issue-error-message').fadeOut();
                                $('#issue-application-form').trigger("reset");
                            } else {
                                $('#issue-error-message').html("An error occured.").fadeIn();
                            }
                            $('#issue-submit-btn').html("Submit").prop('disabled', false);
                        },
                        error: function () {
                            $('#issue-submit-btn').html("Submit").prop('disabled', false);
                        }
                    });
                }
            });

            // review form
            $('#review-form').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: '/rentrover/pages/tenant/app/review-submit.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        if (response == true) {
                            $('#review-form').trigger('reset');
                            showPopupAlert("Review submitted.");
                            loadReviews();
                        } else {
                            showPopupAlert("Review couldn't be submitted.");
                        }
                    }
                });
            });

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

            // delete review
            $(document).on('click', '.delete-review-icon', function () {
                review_id = $(this).data('review-id');

                $.ajax({
                    url: "/rentrover/pages/tenant/app/delete-review.php",
                    type: "POST",
                    data: { reviewId: review_id },
                    success: function (response) {
                        if (response == true) {
                            loadReviews();
                            showPopupAlert('Review deleted.');
                        } else {
                            showPopupAlert("Review couldn't be deleted.");
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>
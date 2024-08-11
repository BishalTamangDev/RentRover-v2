<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

require_once __DIR__ . '/../../classes/user.php';
require_once __DIR__ . '/../../classes/house.php';
require_once __DIR__ . '/../../classes/room.php';
require_once __DIR__ . '/../../classes/wishlist.php';
require_once __DIR__ . '/../../classes/application.php';

$profileUser = new User();

$houseObj = new House();
$roomObj = new Room();
$applicationObj = new Application();
$tempWishlist = new Wishlist();

$profileUser->fetch($r_id, "all");

$page = "room-detail";

if (!isset($tab))
    $tab = isset($_GET['tab']) ? $_GET['tab'] : "view";

$tempPhotoSrc = '/rentrover/uploads/blank.jpg';

// fetch room detail
$roomExists = $roomObj->fetch($roomId);

if ($roomExists) {
    $houseObj->fetch($roomObj->houseId);
    $location = $houseObj->getAddress();

    $tempWishlist->setUserId($r_id);
    $wishlist = $tempWishlist->fetchList();
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
    <link rel="stylesheet" href="/rentrover/css/room-detail.css">
    <link rel="stylesheet" href="/rentrover/css/review.css">
    <link rel="stylesheet" href="/rentrover/css/header.css">
    <link rel="stylesheet" href="/rentrover/css/room.css">
    <link rel="stylesheet" href="/rentrover/css/popup-alert.css">
    <link rel="stylesheet" href="/rentrover/css/tenant/room-detail.css">

    <!-- prevent resubmission of the form -->
    <script>
        if (window.history.replaceState)
            window.history.replaceState(null, null, window.location.href);
    </script>
</head>

<body class="pb-5">
    <!-- header -->
    <?php require_once __DIR__ . '/sections/header.php'; ?>

    <!-- room detail -->
    <?php
    if (!$roomExists) {
        ?>
        <p class="m-0 fs-1 fw-bold"> Room not found! </p>
        <?php
    } else {
        require_once __DIR__ . '/../../functions/amenity-array.php';

        $houseExists = $houseObj->fetch($roomObj->houseId);

        if (!$houseExists) {
            $houseId = $houseObj->houseId;
            ?>
            <p class="m-0 fs-1 fw-bold"> House not found! </p>
            <?php
        } else {
            ?>
            <section class="container room-detail-container pb-4">
                <!-- top section -->
                <!-- address, rating, wishlist -->
                <div class="d-flex flex-row justify-content-between">
                    <div class="d-flex flex-column gap-1 address-review top-section">
                        <p class="m-0 fw-bold fs-4"> <?= $location ?> </p>

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

                    <!-- wishlist -->
                    <!-- wishlist -->
                    <?php
                    if (in_array($roomId, $wishlist)) {
                        ?>
                        <i class="fa-solid fa-bookmark pointer pt-2" id="selected-room-wishlist-icon" data-task="remove"
                            data-id="<?= $roomId ?>"></i>
                        <?php
                    } else {
                        ?>
                        <i class="fa-regular fa-bookmark pointer pt-2" id="selected-room-wishlist-icon" data-task="add"
                            data-id="<?= $roomId ?>"></i>
                        <?php
                    }
                    ?>
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
                                <td class="data"> <?= $roomObj->flag == 'verified' ? "Available" : 'Not-available' ?> </td>
                            </tr>
                        </table>

                        <div class="room-operations">
                            <?php
                            // check if the room is acceptiong application :: flag - on-hold text
                            if ($roomObj->flag == 'verified') { // accepting application
                                // check if the user is eligible to applly
                                if ($profileUser->flag != 'verified') {
                                    ?>
                                    <p class="text-danger small"> Please verify your account first to apply for a room. </p>
                                    <?php
                                } else {
                                    $isEligibleToApply = $applicationObj->eligibilityTestForTenantToApply($r_id);

                                    if ($isEligibleToApply) {
                                        ?>
                                        <button type="button" class="btn btn-brand" data-bs-toggle="modal"
                                            data-bs-target="#room-apply-modal" id="apply-form-trigger-btn"> Apply Now </button>
                                        <?php
                                    } else {
                                        // check if another applied room is the current
                                        // if current room :: show move in button 
                                        // check if the applied room is the current one 
                                        $appliedRoomId = $applicationObj->fetchAppliedRoomId($r_id);
                                        if ($appliedRoomId == $roomId) {
                                            ?>
                                            <p class="text-success mb-3"> You have already applied for this room. </p>
                                            <!-- show application state -->
                                            <?php
                                            $status = $applicationObj->fetchApplicationStatus($roomId, $r_id);
                                            if ($status == 'pending') {
                                                ?>
                                                <button class="btn btn-brand"> <i class="fa fa-spinner"></i> Application Pending </button>
                                                <button class="btn btn-danger" id="cancel-application"> <i class="fa fa-multiply"></i> Cancel
                                                </button>
                                                <?php
                                            } elseif ($status == 'accepted') {
                                                ?>
                                                <button class="btn btn-success"> <i class="fa fa-multiply"></i> Application Accepted </button>
                                                <?php
                                            } elseif ($status == 'rejected') {
                                                ?>
                                                <button class="btn btn-danger"> <i class="fa fa-check"></i> Application Accepted </button>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <p class="text-danger mb-3 small"> Your another application has been accepted. So you won't be able
                                                to apply for another room. </p>
                                            <button type="button" class="btn btn-brand"> Apply Now </button>
                                            <?php
                                        }
                                        ?>
                                        <?php
                                    }
                                }
                            } else {
                                // if the applicant is the user - show move in button
                                $isAcceptedApplicant = $applicationObj->checkIfAcceptedApplicant($r_id);

                                if ($isAcceptedApplicant) {
                                    ?>
                                    <p class="text-success mb-3 small"> Your application is already accepted. </p>
                                    <button class="btn btn-brand mb-3"> Apply Now </button>
                                    <?php
                                } else {
                                    ?>
                                    <p class="text-danger mb-3"> This room is not accepting the application at this moment. </p>
                                    <button type="button" class="btn btn-brand" disabled> Apply Now </button>
                                    <?php
                                }
                                ?>
                                <?php
                            }
                            ?>
                            <button type="button" class="invisible btn btn-success" id="success-btn"> <i
                                    class="fa fa-check"></i> Application Submitted </button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- room of the same house -->
            <section class="container room-container" id="same-house-room-container">
                <!-- backup -->
                <div class="d-none room shadow-sm room-element bhk-element non-bhk-element unfurnished-element semi-furnished-element full-furnished-element district-kathmandu-element"
                    data-rent="17000" data-floor="4">
                    <!-- image -->
                    <div class="room-image-div">
                        <img src="/rentrover/assets/images/room-2.jpg" alt="room image">
                    </div>

                    <!-- details -->
                    <div class="room-details">
                        <!-- location -->
                        <div class="location-wishlist">
                            <div class="location-container">
                                <abbr title="Pipalboat, Kathmandu">
                                    <p class="location">
                                        Pipalboat, Kathmandu
                                    </p>
                                </abbr>
                            </div>
                            <i class="fa-regular fa-bookmark"></i>
                        </div>

                        <!-- specs :: number of room & floor -->
                        <p class="spec"> 2 Rooms, 3rd floor </p>

                        <!-- rent -->
                        <p class="rent"> NPR. 12,000/month </p>

                        <div class="room-bottom">
                            <div class="rating">
                                <img src="/rentrover/assets/icons/full-star.png" alt="">
                                <p class="fw-semibold small"> 2.4 </p>
                            </div>

                            <a href="/rentrover/room-detail/1" class="btn btn-outlined-brand show-more-btn"> Show More </a>
                        </div>
                    </div>
                </div>
            </section>
            <?php
        }
    }
    ?>

    <!-- application modal -->
    <div class="modal fade" id="room-apply-modal" tabindex="-1" aria-labelledby="room apply modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="p-3 modal-content">
                <div class="d-flex flex-row justify-content-between heading pt-2">
                    <h5 class="m-0"> Fill the form below to apply. </h5>
                    <button type="button" class="btn-close" id="close-application-btn" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <form method="POST" action="/rentrover/pages/tenant/app/apply-for-room.php" class="form mt-3"
                    id="room-application-form">
                    <p class="text-danger mb-3 small" id="error-message"> Error message appears here.. </p>

                    <!-- room id -->
                    <input type="hidden" name="room-id" value="<?= $roomId ?>" class="form-control mb-3">

                    <!-- renting type -->
                    <div class="">
                        <select name="renting-type" id="renting-type" class="form-select" required>
                            <option value="" selected hidden> Select renting type </option>
                            <option value="fixed"> Fixed </option>
                            <option value="not-fixed"> Not-Fixed </option>
                        </select>
                    </div>

                    <!-- move in date -->
                    <div class="mt-2">
                        <label for="move-in-date" class="px-1"> Move in Date </label>
                        <input type="date" name="move-in-date" id="move-in-date" class="mt-2 mb-3 form-control"
                            required>
                    </div>

                    <!-- move out date -->
                    <div class="mt-2 mb-2" id="move-out-date-div">
                        <label for="move-out-date" class="px-1"> Move out Date </label>
                        <input type="date" name="move-out-date" id="move-out-date" class="mt-2 form-control">
                    </div>

                    <!-- additional info -->
                    <textarea name="note" id="note" class="form-control mt-3"
                        placeholder="some notes if necessary"></textarea>

                    <!-- submit -->
                    <button type="submit" class="btn btn-brand mt-2 w-100" id="room-application-btn"> Apply Now
                    </button>
                </form>
            </div>
        </div>
    </div>

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

    <!-- js :: notification & profile menu -->
    <script type="text/javascript" src="/rentrover/js/tenant.js"></script>

    <!-- popup js -->
    <script src="/rentrover/js/popup-alert.js"></script>

    <!-- script -->
    <script>
        // room apply form
        $('#room-application-form').submit(function (e) {
            e.preventDefault();

            // check date
            var currentDate = new Date();
            currentDate.setHours(0, 0, 0, 0);
            var renting_type = $('#renting-type').val();
            var move_in_date = new Date($('#move-in-date').val());
            var move_out_date = 0;

            move_in_date.setHours(0, 0, 0, 0);

            if (renting_type == 'fixed') {
                move_out_date = new Date($('#move-out-date').val());
                move_out_date.setHours(0, 0, 0, 0);
            }

            // check if the dates are past date
            if (move_in_date < currentDate) {
                $('#error-message').html("Please set the valid move in date.").show();
                formValid = false;
            } else {
                if (renting_type == "fixed") {
                    if (move_in_date > move_out_date) {
                        $('#error-message').html("Please set the valid move out date.").show();
                    } else {
                        // minimum days to rent :: 28 days
                        var timeDiff = move_out_date.getTime() - move_in_date.getTime();
                        var dayDiff = Math.round(timeDiff / (1000 * 60 * 60 * 24));

                        if (dayDiff < 28) {
                            $('#error-message').html("The minimun days for renting is 28 days.").show();
                        } else {
                            $('#error-message').html("Valid").hide();
                            var formData = $(this).serialize();
                            submitApplication(formData);
                        }
                    }
                } else {
                    $('#error-message').hide();
                    $('#move-out-date').val('');
                    var formData = $(this).serialize();
                    submitApplication(formData);
                }
            }
        });

        function submitApplication(formData) {
            console.clear();
            $.ajax({
                url: '/rentrover/pages/tenant/app/apply-for-room.php',
                type: "POST",
                data: formData,
                beforeSend: function () {
                    $('#room-application-btn').html("Applying..").prop('disabled', true);
                },
                success: function (response) {
                    if (response == true) {
                        $('#error-message').fadeOut();
                        $('#close-application-btn').click();
                        $('#success-btn').removeClass('invisible');
                        $('#apply-form-trigger-btn').fadeOut();
                        showPopupAlert("Application has been submitted.");
                    } else {
                        $('#error-message').html("Application couldn't be submitted").fadeIn();
                    }
                    $('#room-application-btn').html("Apply Now").prop('disabled', false);
                }, error: function () {
                    $('#room-application-btn').html("Apply Now").prop('disabled', false);
                }
            });
        }

        // renting type
        $('#renting-type').change(function () {
            if ($('#renting-type').val() == "fixed") {
                $('#move-out-date-div').show();
                $('#move-out-date').attr("required", "required");
            } else {
                $('#move-out-date-div').hide();
                $('#move-out-date').removeAttr("required");
            }
        });

        // loading the rooms of the same
        function loadSameHouseRooms() {
            house_id = <?= $roomObj->houseId ?? 0 ?>;
            room_id = <?= $roomId ?? 0 ?>;

            if (house_id != 0 && room_id != 0) {
                $.ajax({
                    url: '/rentrover/pages/tenant/sections/load-room-of-same-house.php',
                    method: "POST",
                    data: { houseId: house_id, roomId: room_id },
                    success: function (data) {
                        $('#same-house-room-container').html(data);
                    }
                });
            }
        }

        loadSameHouseRooms();

        // toggle selected room wish
        $('#selected-room-wishlist-icon').click(function () {
            room_id = $('#selected-room-wishlist-icon').data('id');
            task = $('#selected-room-wishlist-icon').data('task');
            $.ajax({
                url: '/rentrover/pages/tenant/app/toggle-wishlist.php',
                type: 'POST',
                data: { roomId: room_id, toDo: task },
                beforeSend: function () {
                    if (task == 'add') {
                        $('#selected-room-wishlist-icon').data('task', 'remove').addClass('fa-solid').removeClass('fa-regular');
                    } else {
                        $('#selected-room-wishlist-icon').data('task', 'add').addClass('fa-regular').removeClass('fa-solid');
                    }
                },
                success: function (response) {
                    if (response != true) {
                        location.reload();
                    }
                    // load wishlist count
                    $(document, loadWishlistCount());
                }
            })
        });

        // wishlist for room of same house
        $(document).on('click', '.wish-icon', function (e) {
            room_id = $(this).data('id');
            task = $(this).data('task');

            var targetIcon = $(this).closest("i");

            $.ajax({
                url: '/rentrover/pages/tenant/app/toggle-wishlist.php',
                data: { roomId: room_id, toDo: task },
                type: 'POST',
                beforeSend: function () {
                    if (task == 'add') {
                        targetIcon.data('task', 'remove');
                        targetIcon.addClass('fa-solid');
                        targetIcon.removeClass('fa-regular');
                    } else {
                        targetIcon.data('task', 'add');
                        targetIcon.addClass('fa-regular');
                        targetIcon.removeClass('fa-solid');
                    }
                },
                success: function (response) {
                    if (response != true) {
                        location.reload();
                    }
                }
            });
        });

        // cancel application
        $('#cancel-application').click(function () {
            const room_id = <?= $roomId ?>;
            const user_id = <?= $r_id ?? 0 ?>;

            $.ajax({
                url: '/rentrover/pages/tenant/app/cancel-application.php',
                type: "POST",
                data: { userId: user_id, roomId: room_id },
                success: function (data) {
                    location.reload();
                }
            });
        });

        // load wishlist count
        $(document, loadWishlistCount());
    </script>
</body>

</html>
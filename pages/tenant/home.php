<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

require_once __DIR__ . '/../../classes/user.php';
require_once __DIR__ . '/../../classes/house.php';
require_once __DIR__ . '/../../classes/room.php';
require_once __DIR__ . '/../../classes/wishlist.php';
require_once __DIR__ . '/../../functions/amenity-array.php';
require_once __DIR__ . '/../../functions/district-array.php';

$profileUser = new User();
$profileUser->fetch($r_id, "all");

$houseObj = new House();
$roomObj = new Room();
$wishlistObj = new Wishlist();

$wishlistObj->setUserId($r_id);

$page = "home";
if (!isset($tab))
    $tab = isset($_GET['tab']) ? $_GET['tab'] : "view";

// search
$searchState = isset($_GET['search']) ? "search" : "no-search";

$searchContent = $searchState == "search" ? $_GET['search'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- title -->
    <title> Home </title>

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
    <link rel="stylesheet" href="/rentrover/css/header.css">
    <link rel="stylesheet" href="/rentrover/css/room.css">
    <link rel="stylesheet" href="/rentrover/css/footer.css">
    <link rel="stylesheet" href="/rentrover/css/popup-alert.css">
    <link rel="stylesheet" href="/rentrover/css/tenant/home.css">

    <!-- prevent resubmission of the form -->
    <script>
        if (window.history.replaceState)
            window.history.replaceState(null, null, window.location.href);
    </script>
</head>

<body>
    <!-- header -->
    <?php require_once __DIR__ . '/sections/header.php'; ?>

    <!-- search -->
    <section class="d-flex flex-column container align-items-center search-container">
        <h1 class="m-0 mb-3 text-light"> Find the best room that suits you. </h1>
        <form class="d-flex flex-row gap-1 form fit-content mb-5" method="GET" id="search-form">
            <input type="search" name="search" value="<?= $searchState == 'search' ? $searchContent : '' ?>"
                placeholder="search by location" id="search" class="form-control" required>
            <button type="submit" name="" id="" class="form-control btn btn-brand fit-content m-auto">
                Search
            </button>
        </form>
    </section>

    <!-- filter && rooms -->
    <div class="container d-flex flex-column flex-xl-row gap-3 mt-4 mt-xl-5 mb-5">
        <!-- filter -->
        <div class="filter-container-with-background" id="filter-container-with-background">
            <form id="filter-form" class="flex-column gap-2 borders border fit-content rounded filter-container">
                <div class="d-flex flex-row w-100 align-items-center justify-content-between top">
                    <p class="m-0 fw-semibold text-secondary"> Filter </p>

                    <div class="d-flex flex-row align-items-center gap-2 action">
                        <i class="fa fa-undo pointer" id="filter-reset-btn"></i>
                        <i class="fa fa-multiply fs-4 pointer" id="filter-close"></i>
                    </div>
                </div>

                <!-- district -->
                <div class="">
                    <hr class="m-0 mb-2 mt-1">
                    <p class="m-0 px-1 small mb-1"> District </p>
                    <select name="filter-district" id="filter-district" class="form-select-sm w-100">
                        <option value="all" selected> All </option>
                        <?php
                        foreach ($districtArray as $district) {
                            ?>
                            <option value="<?= $district ?>"> <?= $district ?> </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

                <!-- rent -->
                <div class="">
                    <p class="m-0 px-1 small mb-1"> Rent </p>
                    <div class="d-flex flex-row align-items-center gap-2 rent">
                        <input type="number" name="filter-min-rent" id="filter-min-rent" class="form-control-sm w-50"
                            placeholder="min rent" min="0">
                        <p class="m-0"> - </p>
                        <input type="number" name="filter-max-rent" id="filter-max-rent" class="form-control-sm w-50"
                            placeholder="max rent" min="0">
                    </div>
                </div>

                <!-- room type -->
                <div class="">
                    <p class="m-0 px-1 small mb-1"> Room Type </p>
                    <select name="filter-room-type" id="filter-room-type" class="form-select-sm w-100">
                        <option value="all"> All </option>
                        <option value="bhk"> BHK </option>
                        <option value="non-bhk"> Non-BHK </option>
                    </select>
                </div>

                <!-- furnishing -->
                <div class="">
                    <p class="m-0 px-1 small mb-1"> Furnishing </p>
                    <select name="filter-furnishing" id="filter-furnishing" class="form-select-sm w-100">
                        <option value="all"> All </option>
                        <option value="unfurnished"> Unfurnished </option>
                        <option value="semi-furnished"> Semi-furnished </option>
                        <option value="full-furnished"> Full-furnished </option>
                    </select>
                </div>

                <!-- Floor -->
                <div class="">
                    <p class="m-0 px-1 small mb-1"> Floor </p>
                    <input type="number" name="filter-floor" id="filter-floor" class="form-control-sm w-100" min="0"
                        placeholder="floor">
                </div>

                <!-- filter btn -->
                <a id="filter-btn" class="btn btn-outlined-brand py-1 mt-2"> Filter </a>
            </form>
        </div>

        <!-- all room container -->
        <div class="all-room-container">
            <div class="d-flex flex-row justify-content-between">
                <p class="m-0 mt-1 mb-2 fw-semibold fs-4 px-1">
                    <?= $searchState == 'search' ? "Search Results" : "All Rooms" ?>
                </p>
                <i class="fa fa-filter pointer" id="filter-trigger"></i>
            </div>

            <!-- search result count -->
            <?php
            if ($searchState == 'search') {
                ?>
                <a href="/rentrover/home" class="btn btn-danger fit-content mt-3 mb-4"> Clear Search </a>
                <?php
            }
            ?>

            <section class="room-container" id="all-room-container">
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

                            <a href="/rentrover/pages/tenant/room-detail/1"
                                class="btn btn-outlined-brand show-more-btn"> Show More </a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- load more -->
            <div class="d-none mt-4 d-flex flex-row load-more-container">
                <button class="btn btn-brand"> Load More </button>
            </div>
        </div>
    </div>

    <!-- feedback trigger -->
    <div class="container">
        <a class="pointer" data-bs-toggle="modal" data-bs-target="#feedback-modal"> <i
                class="fa-regular fa-paper-plane"></i> Submit a feeback </a>
    </div>

    <!-- footer -->
    <?php require_once __DIR__ . '/../../sections/footer.php'; ?>

    <!-- modal :: feedback modal-->
    <?php require_once __DIR__ . '/../../sections/feedback.php'; ?>

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

    <!-- feedback-js -->
    <script src="/rentrover/js/feedback-submit.js"></script>

    <script type="text/javascript" src="/rentrover/js/tenant.js"></script>

    <!-- popup js -->
    <script src="/rentrover/js/popup-alert.js"></script>

    <script>
        $(document).ready(function () {
            var search_state = "<?= $searchState ?>";
            var search_content = "<?= $searchContent ?>";

            if ($.trim(search_state) == "search") {
                search(search_content);
            }

            if ($.trim(search_state) == "no-search") {
                loadAllRoom();
            }

            function search(s_content) {
                $.ajax({
                    url: '/rentrover/pages/tenant/sections/search.php',
                    type: 'POST',
                    data: { content: search_content },
                    success: function (data) {
                        $('#all-room-container').html(data);
                    }, error: function () {
                        $('#all-room-container').html("An error occured");
                    }
                });
            }

            // load all room
            function loadAllRoom() {
                $.ajax({
                    url: '/rentrover/pages/tenant/sections/load-all-room.php',
                    success: function (data) {
                        $('#all-room-container').html(data);
                    }, error: function () {
                        $('#all-room-container').html("An error occured");
                    }
                });
            }

            // filter open
            $('#filter-trigger').click(function () {
                $('#filter-container-with-background').css('display', "flex");
            });

            // filter close
            $('#filter-close').click(function () {
                $('#filter-container-with-background').css('display', "none");
            });

            $(window).resize(function () {
                if (window.innerWidth <= 1200) {
                    $('#filter-container-with-background').css('display', "none");
                } else {
                    $('#filter-container-with-background').css('display', "flex");
                }
            });

            // filtering
            var district = "all";
            var minRent = 0;
            var maxRent = Infinity;
            var roomType = "all";
            var furnishing = "all";
            var floor = Infinity;

            // filter reset btn
            $('#filter-reset-btn').click(function () {
                district = "all";
                minRent = 0;
                maxRent = Infinity;
                roomType = "all";
                furnishing = "all";
                floor = Infinity;
                $('#filter-form').trigger('reset');
                filterRoom();
            });

            // filter btn
            $('#filter-btn').click(function () {
                district = $('#filter-district').val();
                roomType = $('#filter-room-type').val();
                furnishing = $('#filter-furnishing').val();

                minRent = $('#filter-min-rent').val() != '' ? parseFloat($('#filter-min-rent').val()) : 0;
                maxRent = $('#filter-max-rent').val() != '' && $('#filter-max-rent').val() != 0 ? parseFloat($('#filter-max-rent').val()) : Infinity;
                floor = $('#filter-floor').val() != '' && $('#filter-floor').val() != 0 ? $('#filter-floor').val() : Infinity;

                if (minRent <= maxRent) {
                    filterRoom();
                }
            });

            // filter function
            function filterRoom() {
                // district
                $('.room-element').show();
                if (district != "all") {
                    $('.room-element').hide();
                    $('.district-' + district + '-element').show();
                }

                // rent
                if (minRent > 0 || maxRent > 0) {
                    $('.room-element:visible').each(function () {
                        var rent = parseFloat($(this).data('rent'));
                        (rent >= minRent && rent <= maxRent) ? $(this).show() : $(this).hide();
                    });
                }

                // room type
                if (roomType != "all") {
                    roomType == "bhk" ? $('.non-bhk-element').hide() : $('.bhk-element').hide();
                }

                // furnishing
                if (furnishing != "all") {
                    if (furnishing == "unfurnished") {
                        $('.semi-furnished-element').hide();
                        $('.full-furnished-element').hide();
                    } else if (furnishing == "semi-furnished") {
                        $('.unfurnished-element').hide();
                        $('.full-furnished-element').hide();
                    } else {
                        $('.unfurnished-element').hide();
                        $('.semi-furnished-element').hide();
                    }
                }

                // floor
                if (floor != Infinity) {
                    $('.room-element:visible').each(function () {
                        var data_floor = parseFloat($(this).data('floor'));
                        data_floor == floor ? $(this).show() : $(this).hide();
                    });
                }

                if (window.innerWidth < 1200) {
                    $('#filter-container-with-background').css('display', "none");
                };
            }

            // wishlist
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
                        $(document, loadWishlistCount());
                    }
                });
            });

            // load wishlist count
            $(document, loadWishlistCount());
        });
    </script>
</body>

</html>
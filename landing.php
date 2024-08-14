<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- title -->
    <title> RentRover </title>

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
    <link rel="stylesheet" href="/rentrover/css/header-unsigned.css">
    <link rel="stylesheet" href="/rentrover/css/room.css">
    <link rel="stylesheet" href="/rentrover/css/feedback.css">
    <link rel="stylesheet" href="/rentrover/css/footer.css">
    <link rel="stylesheet" href="/rentrover/css/popup-alert.css">
    <link rel="stylesheet" href="/rentrover/css/landing.css">
</head>

<body>
    <!-- header -->
    <?php require_once __DIR__ . '/sections/header-unsigned.php'; ?>

    <!-- landing-container -->
    <section class="container position-relative landing-container">
        <div class="position-absolute d-flex flex-column gap-4 p-3 landing-info">
            <h1 class="m-0  fw-semibold"> Stop Roaming Around; Go Digital
                <!-- Unlock the Door to Seamless Room Renting and Finding: Your Space, Digitized for Easy, Hassle-Free
                Accommodation Solutions. -->
            </h1>

            <a href="/rentrover/registration" class="btn btn-brand fit-content" id="register-btn"> Register&nbsp;Now
            </a>
        </div>
    </section>

    <!-- all room container -->
    <div class="container all-room-container mt-5">
        <div class="d-flex flex-row justify-content-between mb-4">
            <p class="m-0 mt-1 mb-2 fw-semibold fs-4 px-1"> Available Rooms </p>
        </div>

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

                        <a href="/rentrover/room-detail/1" class="btn btn-outlined-brand show-more-btn"> Show More </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- load more -->
        <div class="mt-5 d-flex flex-row load-more-container">
            <button class="btn btn-outlined-brand" id="load-more-btn" data-bs-toggle="modal"
                data-bs-target="#login-modal"> Load More </button>
        </div>
    </div>

    <!-- about us -->
    <p class="container heading fw-semibold mt-5 fs-1 text-secondary"> About US </p>
    <section class="container section d-flex flex-column gap-1 about-us mb-4 section">
        <div class="about-us-detail">
            <p class="m-0 fs-5" style="line-height: 2rem"> RentRover is an innovative PropTech platform designed to
                revolutionize the rental experience
                for both landlords and tenants. By leveraging technology, RentRover streamlines the process of finding
                and managing rental properties. Tenants can easily browse a wide range of available rooms, make informed
                decisions by analyzing property details, and communicate directly with landlords without the hassle of
                traditional agents. Landlords benefit from tools that allow them to evaluate potential tenants, manage
                properties efficiently, and send targeted notifications. As a comprehensive real estate and
                service-based platform, RentRover acts as a digital marketplace, offering a seamless and modern approach
                to property rental and management. </p>
        </div>
        <div class="d-flex flex-row justify-content-end about-us-bottom">
            <!-- <a class="btn btn-brand"> More </a> -->
        </div>
    </section>

    <!-- services -->
    <p class="container heading fw-semibold mt-5 fs-1 text-secondary"> What do we offer? </p>
    <section class="section container mt-5 mb-5 service-container">
        <div class="d-flex flex-column flex-md-row">
            <div class="service odd-service">
                <i class="fa-regular fa-building"></i>
                <p class="service-title"> OVERSEE MULTIPLE HOUSES & ROOMS </p>
                <p class="service-detail"> Landlord can add different rooms by adding multiple houses accordingly. </p>
            </div>

            <div class="service even-service">
                <i class="fa-solid fa-people-arrows"></i>
                <p class="service-title"> COMMUNICATE DIRECTLY WITH LANDLORD </p>
                <p class="service-detail"> Tenant has provision of directly contacting with the landlord without
                    including third party. </p>
            </div>
        </div>

        <div class="d-flex flex-column-reverse flex-md-row">
            <div class="service even-service">
                <i class="fa-solid fa-timeline"></i>
                <p class="service-title"> TRACK YOUR TENANCY HISTORY </p>
                <p class="service-detail"> Keeping the track of tenancy history has never been easier. </p>
            </div>

            <div class="service odd-service">
                <i class="fa-solid fa-users"></i>
                <p class="service-title"> ADDRESS TENANT ISSUES WITH EASE </p>
                <p class="service-detail"> Tenant has provision of directly contacting with the landlord without
                    including third party. </p>
            </div>
        </div>
    </section>

    <!-- feedback -->
    <p class="container heading fw-semibold mt-5 fs-2 pt-5"> What our happy members says about us? </p>
    <section class="container section user-feedback-container pt-4 pb-5" id="feedback-container">
        <!-- feedback -->
        <div class="d-none user-feedback">
            <div class="user-feedback-top">
                <div class="img-div">
                    <img src="/rentrover/assets/images/bishal.jpg" alt="">
                </div>
                <div class="user-details">
                    <p class="feedback-user-name"> Username </p>
                    <p class="feedback-role"> Role </p>
                </div>
            </div>

            <div class="feedback">
                <div class="feedback-detail">
                    <p> "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quos velit sed ea reprehenderit
                        corporis dolor cupiditate fugiat qui ratione hic, placeat, sint odit earum consequatur." </p>
                </div>
                <div class="rating-div">
                    <img src="/rentrover/assets/icons/full-star.png" alt="">
                    <img src="/rentrover/assets/icons/full-star.png" alt="">
                    <img src="/rentrover/assets/icons/half-star.png" alt="">
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <?php include 'sections/footer.php'; ?>


    <!-- login modal -->
    <div class="modal fade" id="login-modal" tabindex="-1" aria-labelledby="login modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="d-flex flex-column modal-header">
                    <div class="d-flex flex-column align-items-center gap-3 pt-3 mb-4 content">
                        <img class="w-25" src="/rentrover/assets/icons/user-login.png" alt="">
                    </div>

                    <h1 class="modal-title fs-5 fw-semibol mb-4" id="exampleModalLabel"> LOGIN TO BROWSE MORE </h1>

                    <div class="action mb-3">
                        <a href="/rentrover/login" class="btn btn-outlined-brand px-4"> Login Now </a>
                    </div>
                </div>
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
    <script type="text/" src="/rentrover/bootstrap/bootstrap-js-5.3.3/bootstrap.bundle.min.js"> </script>

    <!-- jquery -->
    <script src="/rentrover/jquery/jquery-3.7.1.min.js"></script>

    <!-- script -->
    <script src="/rentrover/js/popup-alert.js"></script>

    <script>
        $(document).ready(function () {
            // load all room
            function loadAllRoom() {
                $.ajax({
                    url: '/rentrover/sections/load-all-room.php',
                    success: function (data) {
                        $('#all-room-container').html(data);
                    }, error: function () {
                        $('#all-room-container').html("An error occured");
                    }
                });
            }

            loadAllRoom();
        });

        function loadFeedback() {
            $.ajax({
                url: '/rentrover/sections/feedback-for-user.php',
                success: function (data) {
                    $('#feedback-container').html(data);
                }
            });
        }

        loadFeedback();
    </script>
</body>

</html>
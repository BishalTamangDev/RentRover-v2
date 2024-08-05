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
    <link rel="stylesheet" href="/rentrover/css/landing.css">
    <link rel="stylesheet" href="/rentrover/css/room.css">
    <link rel="stylesheet" href="/rentrover/css/feedback.css">
    <link rel="stylesheet" href="/rentrover/css/footer.css">
    <link rel="stylesheet" href="/rentrover/css/popup-alert.css">
</head>

<body>
    <!-- header -->
    <header class="position-fixed w-100 header unsigned-header">
        <div class="container py-3 bg-white d-flex flex-row align-items-center justify-content-between">
            <a href="/rentrover/landing.php">
                <img src="/rentrover/assets/brands/rentrover-rectangular-logo.png" alt="">
            </a>

            <div class="d-flex flex-row gap-3 align-items-center">
                <a href="/rentrover/login.php" class="btn btn-brand"> Log&nbsp;In </a>
            </div>
        </div>
    </header>

    <!-- landing-container -->
    <section class="container position-relative landing-container">
        <div class="position-absolute d-flex flex-column gap-2 p-3 landing-info">
            <h5 class="m-0">
                Unlock the Door to Seamless Room Renting and Finding: Your Space, Digitized for Easy, Hassle-Free
                Accommodation Solutions.
            </h5>

            <a href="/rentrover/registration.php" class="btn btn-brand fit-content" id="register-btn"> Register&nbsp;Now </a>
        </div>
    </section>

    <!-- all room container -->
    <div class="container all-room-container mt-4">
        <div class="d-flex flex-row justify-content-between">
            <p class="m-0 mt-1 mb-2 fw-semibold fs-4 px-1"> Available Rooms </p>
        </div>

        <section class="room-container">
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

                        <a href="/rentrover/room-detail.php" class="btn btn-outlined-brand show-more-btn"> Show More </a>
                    </div>
                </div>
            </div>

            <!-- room 2 -->
            <div class="room shadow-sm room-element bhk-element unfurnished-element district-kathmandu-element"
                data-rent="12000" data-floor="3">
                <!-- image -->
                <div class="room-image-div">
                    <img src="/rentrover/assets/images/room-1.jpg" alt="room image">
                </div>

                <!-- details -->
                <div class="room-details">
                    <!-- location -->
                    <div class="location-wishlist">
                        <div class="location-container">
                            <abbr title="Jaldhunga Marg, Pipalboat, Kathmandu">
                                <p class="location">
                                    Pipalboat, Kathmandu
                                </p>
                            </abbr>
                        </div>
                        <i class="fa-regular fa-bookmark"></i>
                    </div>

                    <!-- specs :: number of room & floor -->
                    <p class="spec"> 2 BHK, 3rd floor, Unfurnished </p>

                    <!-- rent -->
                    <p class="rent"> NPR. 12,000/month </p>

                    <div class="room-bottom">
                        <div class="rating">
                            <img src="/rentrover/assets/icons/full-star.png" alt="">
                            <p class="fw-semibold small"> 2.4 </p>
                        </div>

                        <a href="/rentrover/room-detail.php" class="btn btn-outlined-brand show-more-btn"> Show More </a>
                    </div>
                </div>
            </div>

            <!-- room 3 -->
            <div class="room shadow-sm room-element non-bhk-element semi-furnished-element district-bhaktapur-element"
                data-rent="35000" data-floor="5">
                <!-- image -->
                <div class="room-image-div">
                    <img src="/rentrover/assets/images/room-3.jpg" alt="room image">
                </div>

                <!-- details -->
                <div class="room-details">
                    <!-- location -->
                    <div class="location-wishlist">
                        <div class="location-container">
                            <abbr title="Sallaghari, Bhaktapur">
                                <p class="location">
                                    Sallaghari, Bhaktapur
                                </p>
                            </abbr>
                        </div>
                        <i class="fa-regular fa-bookmark"></i>
                    </div>

                    <!-- specs :: number of room & floor -->
                    <p class="spec"> 2 Rooms, 5th floor, Semi-furnished </p>

                    <!-- rent -->
                    <p class="rent"> NPR. 35,000/month </p>

                    <div class="room-bottom">
                        <div class="rating">
                            <img src="/rentrover/assets/icons/full-star.png" alt="">
                            <p class="fw-semibold small"> 2.4 </p>
                        </div>

                        <a href="/rentrover/room-detail.php" class="btn btn-outlined-brand show-more-btn"> Show More </a>
                    </div>
                </div>
            </div>

            <!-- room 4 -->
            <div class="room shadow-sm room-element bhk-element full-furnished-element district-lalitpur-element"
                data-rent="45000" data-floor="4">
                <!-- image -->
                <div class="room-image-div">
                    <img src="/rentrover/assets/images/room-4.jpg" alt="room image">
                </div>

                <!-- details -->
                <div class="room-details">
                    <!-- location -->
                    <div class="location-wishlist">
                        <div class="location-container">
                            <abbr title="Imadol, Lalitpur">
                                <p class="location">
                                    Imadol, Lalitpur
                                </p>
                            </abbr>
                        </div>
                        <i class="fa-regular fa-bookmark"></i>
                    </div>

                    <!-- specs :: number of room & floor -->
                    <p class="spec"> 1 BHK, 4th floor, Full-furnished </p>

                    <!-- rent -->
                    <p class="rent"> NPR. 45,000/month </p>

                    <div class="room-bottom">
                        <div class="rating">
                            <img src="/rentrover/assets/icons/full-star.png" alt="">
                            <p class="fw-semibold small"> 2.4 </p>
                        </div>

                        <a href="/rentrover/room-detail.php" class="btn btn-outlined-brand show-more-btn"> Show More </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- load more -->
        <div class="mt-4 d-flex flex-row load-more-container">
            <button class="btn btn-brand"> Load More </button>
        </div>
    </div>

    <!-- about us -->
    <p class="container heading fw-semibold mt-5 fs-2"> About Us </p>
    <section class="container section d-flex flex-column gap-1 about-us section">
        <div class="about-us-detail">
            <p class="m-0"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis, adipisci, aspernatur
                quasi nihil atque ut cupiditate officiis sequi explicabo ratione odio debitis consectetur maxime
                nesciunt? Quae temporibus minus ea molestiae assumenda vitae ab reiciendis inventore voluptatem! Sed
                laudantium eos nesciunt eligendi aspernatur et aperiam omnis odit, labore, ad repudiandae autem! </p>
        </div>
        <div class="d-flex flex-row justify-content-end about-us-bottom">
            <a class="btn btn-brand"> More </a>
        </div>
    </section>

    <!-- feedback -->
    <p class="container heading fw-semibold mt-5 fs-2"> What our happy members says about us? </p>
    <section class="container section user-feedback-container">
        <!-- feedback -->
        <div class="user-feedback">
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

        <!-- feedback -->
        <div class="user-feedback">
            <div class="user-feedback-top">
                <div class="img-div">
                    <img src="/rentrover/assets/images/shristi.jpg" alt="">
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

        <!-- feedback -->
        <div class="user-feedback">
            <div class="user-feedback-top">
                <div class="img-div">
                    <img src="/rentrover/assets/images/rupak.png" alt="">
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

    <!-- services -->
    <p class="container heading fw-semibold mt-5 fs-2"> What do we offer? </p>
    <section class="section container d-flex flex-column flex-md-row flex-wrap gap-3 service-container">
        <div class="d-flex align-items-center flex-column gap-2 service">
            <img src="/rentrover/assets/icons/custom-application.png" alt="service icon">
            <p class="m-0 fw-bold service-title"> Custom Room Application </p>
            <p class="m-0 service-detail"> Lorem ipsum nsectetur atque. Est facere deleniti facilis veniam laudantium
                tempora sunt quisquam! </p>
        </div>

        <div class="d-flex align-items-center flex-column gap-2 service">
            <img src="/rentrover/assets/icons/building.png" alt="service icon">
            <p class="m-0 fw-bold service-title"> Multiple House & Room Support </p>
            <p class="m-0 service-detail"> Lorem ipsum dolor sit ansectetur atque facilis veniam m tempora sunt
                quisquam! </p>
        </div>

        <div class="d-flex align-items-center flex-column gap-2 service">
            <img src="/rentrover/assets/icons/announcement.png" alt="service icon">
            <p class="m-0 fw-bold service-title"> Direct Communication With The Landlord </p>
            <p class="m-0 service-detail"> Lorem ipsum dolonsectetur atque. Est facere deleniti facilis veniam
                laudantium tempora sunt quisquam! </p>
        </div>
    </section>

    <!-- footer -->
    <footer class="bg-dark text-light mt-5">
        <div class="container d-flex flex-row flex-wrap w-100 gap-2 py-4 footer-container">
            <!-- website -->
            <div class="website footer-section">
                <p class="heading"> Website </p>
                <ul>
                    <li> <i class="fa-solid fa-angles-right"></i> <span> About Us </span> </li>
                    <li> <i class="fa-solid fa-angles-right"></i> <span> FAQ </span> </li>
                    <li> <i class="fa-solid fa-angles-right"></i> <span> Blog </span> </li>
                    <li> <i class="fa-solid fa-angles-right"></i> <span> Policy </span> </li>
                </ul>
            </div>

            <!-- shortcuts -->
            <div class="shortcut footer-section">
                <p class="heading"> Shortcuts </p>
                <ul>
                    <li> <i class="fa-solid fa-angles-right"></i> <span> Popular rooms </span> </li>
                    <li> <i class="fa-solid fa-angles-right"></i> <span> Newply added Rooms </span> </li>
                    <li> <i class="fa-solid fa-angles-right"></i> <span> Be a tenant </span> </li>
                    <li> <i class="fa-solid fa-angles-right"></i> <span> Be a landlord </span> </li>
                </ul>
            </div>

            <!-- related links -->
            <div class="related-links footer-section">
                <p class="heading"> Heading </p>
                <ul>
                    <li> <i class="fa-solid fa-angles-right"></i> <span> Popular rooms </span> </li>
                    <li> <i class="fa-solid fa-angles-right"></i> <span> Newply added Rooms </span> </li>
                    <li> <i class="fa-solid fa-angles-right"></i> <span> Be a tenant </span> </li>
                    <li> <i class="fa-solid fa-angles-right"></i> <span> Be a landlord </span> </li>
                </ul>
            </div>

            <!-- contact -->
            <div class="contact footer-section">
                <p class="heading"> Contact </p>
                <ul>
                    <li> <i class="fa-solid fa-angles-right"></i> <span> Phone Number </span> </li>
                    <li> <i class="fa-solid fa-angles-right"></i> <span> Email address </span> </li>
                </ul>
            </div>
        </div>
    </footer>

    <!-- popup alert -->
     <div class="popup-alert-container" id="popup-alert-container">
        <p id="popup-message"> Popup alert content. </p>
    </div>

    <!-- copyright -->
    <div class="py-2 section bg-primary text-light d-flex flex-row justify-content-around copyright">
        <p class="m-0 small"> Copyright © 2024 RentRover.com - All rights reserved</p>
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
</body>

</html>
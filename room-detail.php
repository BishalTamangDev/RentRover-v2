<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- title -->
    <title> Room Detail </title>

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
</head>

<body>
    <!-- room detail -->
    <section class="container mt-5 room-detail-container pb-5">
        <!-- top section -->
        <!-- address, rating, wishlist -->
        <div class="d-flex flex-row justify-content-between">
            <div class="d-flex flex-column gap-1 address-review top-section">
                <p class="m-0 fw-bold fs-4"> Jaldhunga Marga, Pipalboat, Kathmandu </p>

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
            <i class="fa-regular fa-bookmark pointer fs-5 pt-2" id="wishlist-trigger"></i>
        </div>

        <!-- image -->
        <div class="d-flex flex-column mt-4 gap-2 room-image-container">
            <div class="left">
                <img src="/rentrover/assets/images/room-2.jpg" alt="">
            </div>

            <div class="d-flex flex-row flex-wrap gap-2 right">
                <div class="room-image">
                    <img src="/rentrover/assets/images/room-2.jpg" alt="">
                </div>

                <div class="room-image">
                    <img src="/rentrover/assets/images/room-2.jpg" alt="">
                </div>

                <div class="room-image">
                    <img src="/rentrover/assets/images/room-2.jpg" alt="">
                </div>

                <div class="room-image">
                    <img src="/rentrover/assets/images/room-2.jpg" alt="">
                </div>
            </div>
        </div>

        <div class="d-flex flex-column-reverse flex-xl-row details">
            <!-- requirememnts, amenities and reviews -->
            <div class="d-flex flex-column gap-3 mt-3 mt-lg-5 requirements-amenities-reviews">
                <!-- requirements -->
                <div class="requirements">
                    <h3 class="m-0 fw-semibold"> Room Requirements </h3>
                    <p class="m-0 mt-1"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi maiores rerum
                        repellendus mollitia nesciunt error voluptatum commodi esse placeat. Maxime aliquid accusantium,
                        ad amet reiciendis obcaecati inventore mollitia ullam esse doloremque modi! Id dolorum a
                        excepturi, veniam sequi labore sint praesentium est tempora, cum dolorem officia vitae iure
                        earum repellendus! </p>
                </div>

                <!-- amenities -->
                <h3 class="m-0 fw-semibold mt-3"> Amenities </h3>
                <div class="d-flex flex-row flex-wrap gap-2 amenity-container">
                    <!-- amenity -->
                    <div class="amenity">
                        <img src="/rentrover/assets/icons/amenities/air-conditioner.png" alt="" class="amenity-icon">
                        <p> Air Contitioning </p>
                    </div>

                    <!-- amenity -->
                    <div class="amenity">
                        <img src="/rentrover/assets/icons/amenities/balcony.png" alt="" class="amenity-icon">
                        <p> Balcony </p>
                    </div>

                    <!-- amenity -->
                    <div class="amenity">
                        <img src="/rentrover/assets/icons/amenities/fire-place.png" alt="" class="amenity-icon">
                        <p> Fireplace </p>
                    </div>

                    <!-- amenity -->
                    <div class="amenity">
                        <img src="/rentrover/assets/icons/amenities/internet.png" alt="" class="amenity-icon">
                        <p> Internet </p>
                    </div>

                    <!-- amenity -->
                    <div class="amenity">
                        <img src="/rentrover/assets/icons/amenities/laundry.png" alt="" class="amenity-icon">
                        <p> Laundry </p>
                    </div>

                    <!-- amenity -->
                    <div class="amenity">
                        <img src="/rentrover/assets/icons/amenities/parking.png" alt="" class="amenity-icon">
                        <p> Parking </p>
                    </div>

                    <!-- amenity -->
                    <div class="amenity">
                        <img src="/rentrover/assets/icons/amenities/pets-allowed.png" alt="" class="amenity-icon">
                        <p> Pets Allowed </p>
                    </div>

                    <!-- amenity -->
                    <div class="amenity">
                        <img src="/rentrover/assets/icons/amenities/prompt-repair-service.png" alt=""
                            class="amenity-icon">
                        <p> Promt Repair Service </p>
                    </div>

                    <!-- amenity -->
                    <div class="amenity">
                        <img src="/rentrover/assets/icons/amenities/security.png" alt="" class="amenity-icon">
                        <p> Security </p>
                    </div>

                    <!-- amenity -->
                    <div class="amenity">
                        <img src="/rentrover/assets/icons/amenities/solar-heating.png" alt="" class="amenity-icon">
                        <p> Solar Heating </p>
                    </div>

                    <!-- amenity -->
                    <div class="amenity">
                        <img src="/rentrover/assets/icons/amenities/swimming-pool.png" alt="" class="amenity-icon">
                        <p> Swimming Pool </p>
                    </div>
                </div>

                <!-- reviews -->
                <h3 class="m-0 fw-semibold mt-3"> Reviews and Ratings </h3>
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
                        <td class="data"> 100 </td>
                    </tr>

                    <!-- type -->
                    <tr>
                        <td class="title"> Type </td>
                        <td class="data"> BHK || Non-BHK </td>
                    </tr>

                    <!-- furnishing -->
                    <tr>
                        <td class="title"> Furnishing </td>
                        <td class="data"> Unfirnished </td>
                    </tr>

                    <!-- floor -->
                    <tr>
                        <td class="title"> Floor </td>
                        <td class="data"> 3rd </td>
                    </tr>

                    <!-- type -->
                    <tr>
                        <td class="title"> Rent Amount </td>
                        <td class="data text-success fw-semibold"> NRS. 12,000.00 </td>
                    </tr>

                    <!-- room acquired state -->
                    <tr>
                        <td class="title"> Room state </td>
                        <td class="data"> Acquired </td>
                    </tr>
                </table>

                <div class="room-operations">
                    <button type="button" class="btn btn-brand" data-bs-toggle="modal" data-bs-target="#login-modal">
                        Apply Now </button>
                </div>
            </div>
        </div>
    </section>

    <!-- modal -->
    <div class="modal fade" id="login-modal" tabindex="-1" aria-labelledby="login modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="p-3 modal-content">
                <div class="d-flex flex-row justify-content-between heading">
                    <h5 class="m-0"> You need to login first to proceed. </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <a href="/rentrover/login.php" class="btn btn-brand fit-content mt-3"> Login Now </a>
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
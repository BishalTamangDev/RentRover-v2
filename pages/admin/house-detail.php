<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

require_once __DIR__ . '/../../classes/admin.php';
$profileUser = new Admin();

$profileUser->fetch($r_id, "all");

if (!isset($page))
    $page = "houses";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- title -->
    <title> House Details </title>

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
    <link rel="stylesheet" href="/rentrover/css/room.css">
    <link rel="stylesheet" href="/rentrover/css/review.css">
    <link rel="stylesheet" href="/rentrover/css/aside.css">
</head>

<body>
    <?php require_once __DIR__ . '/sections/aside.php'; ?>

    <main>
        <!-- room detail -->
        <section class="room-detail-container">
            <!-- top section -->
            <!-- address, rating, wishlist -->
            <div class="d-flex flex-row justify-content-between">
                <div class="d-flex flex-column gap-1 address-review top-section">
                    <p class="m-0 fw-bold fs-4"> Jaldhunga Marga, Pipalboat, Kathmandu </p>
                </div>
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
                    <!-- Notes -->
                    <div class="requirements">
                        <h3 class="m-0 fw-semibold"> Important Notes </h3>
                        <p class="m-0 mt-1"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi maiores rerum
                            repellendus mollitia nesciunt error voluptatum commodi esse placeat. Maxime aliquid
                            accusantium,
                            ad amet reiciendis obcaecati inventore mollitia ullam esse doloremque modi! Id dolorum a
                            excepturi, veniam sequi labore sint praesentium est tempora, cum dolorem officia vitae iure
                            earum repellendus! </p>
                    </div>

                    <!-- amenities -->
                    <h3 class="m-0 fw-semibold mt-3"> Amenities </h3>
                    <div class="d-flex flex-row flex-wrap gap-2 amenity-container">
                        <!-- amenity -->
                        <div class="amenity">
                            <img src="/rentrover/assets/icons/amenities/air-conditioner.png" alt=""
                                class="amenity-icon">
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
                </div>

                <!-- remaining specs -->
                <div class="mt-4 mt-lg-5 specifications">
                    <table class="border table mt-0 specification-table">
                        <!-- landlord name -->
                        <tr>
                            <td class="title"> Landlord </td>
                            <td class="data"> Rupak Dangi </td>
                        </tr>

                        <!-- location -->
                        <tr>
                            <td class="title"> Location </td>
                            <td class="data"> Bansbari, Kathmandu </td>
                        </tr>

                        <!-- number of rooms -->
                        <tr>
                            <td class="title"> No. of Rooms </td>
                            <td class="data"> 3 </td>
                        </tr>

                        <!-- added date -->
                        <tr>
                            <td class="title"> Added on </td>
                            <td class="data"> 0000-00-00 </td>
                        </tr>
                    </table>

                    <div class="action">
                        <button type="button" class="btn btn-outline-danger"> <i class="fa-regular fa-flag"></i>
                            Unverify House </button>
                        <button type="button" class="btn btn-success"> <i class="fa-solid fa-check"></i> Verify House
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- rooms in this house -->
        <p class="heading fw-semibold mt-5 fs-2"> Rooms in this house </p>
        <section class="room-container">
            <!-- backup -->
            <div class="room shadow-sm room-element bhk-element non-bhk-element unfurnished-element semi-furnished-element full-furnished-element district-kathmandu-element"
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

                        <a href="/rentrover/admin/room-detail/1" class="btn btn-outlined-brand show-more-btn">
                            Show More </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

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
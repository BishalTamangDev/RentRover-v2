<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

require_once __DIR__ . '/../../classes/admin.php';
$profileUser = new Admin();

$profileUser->fetch($r_id, "all");


if (!isset($page))
    $page = "users";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- title -->
    <title> User Details </title>

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
    <link rel="stylesheet" href="/rentrover/css/aside.css">
    <link rel="stylesheet" href="/rentrover/css/user-detail.css">
</head>

<body>
    <?php require_once __DIR__ . '/sections/aside.php'; ?>

    <main>
        <!-- my profile -->
        <section class="d-nones d-flex flex-column user-profile-container profile-content">
            <p class="m-0 fs-4 fw-semibold"> User Information </p>

            <!-- top section -->
            <div class="d-flex flex-row gap-3 mt-4 align-items-center photo-username-email">
                <div class="photo">
                    <img src="/rentrover/assets/images/bishal.jpg" alt="">
                </div>
                <div class="username-email">
                    <p class="m-0 fw-semibold"> Mr. Beast | Landlord </p>
                    <p class="m-0 text-secondary small"> someone@gmail.com </p>
                </div>
            </div>

            <hr class="mt-4 text-secondary" />

            <div class="d-nones mb-3 profile-informations">
                <div class="d-flex">
                    <div class="w-50">
                        <p class="m-0 text-secondary"> First Name </p>
                        <p class="m-0 fw-semibold"> Bishal </p>
                    </div>

                    <div class="w-50">
                        <p class="m-0 text-secondary"> Last Name </p>
                        <p class="m-0 fw-semibold"> Tamang </p>
                    </div>
                </div>

                <div class="mt-3 d-flex">
                    <div class="w-50">
                        <p class="m-0 text-secondary"> Gender </p>
                        <p class="m-0 fw-semibold"> Male </p>
                    </div>

                    <div class="w-50">
                        <p class="m-0 text-secondary"> DoB </p>
                        <p class="m-0 fw-semibold"> 2000-06-06 </p>
                    </div>
                </div>

                <div class="mt-3 d-flex">
                    <div class="w-50">
                        <p class="m-0 text-secondary"> Email </p>
                        <p class="m-0 fw-semibold"> bishaltamang117@gmail.com </p>
                    </div>

                    <div class="w-50">
                        <p class="m-0 text-secondary"> Phone Number </p>
                        <p class="m-0 fw-semibold"> 9823645014 </p>
                    </div>
                </div>

                <p class="m-0 mt-3 text-secondary"> Address </p>
                <div class="d-flex flex-column">
                    <div class="d-flex">
                        <div class="w-50">
                            <p class="m-0 mt-2 text-secondary"> Province </p>
                            <p class="m-0 fw-semibold"> Bagmati </p>
                        </div>
                        <div class="w-50">
                            <p class="m-0 mt-2 text-secondary"> District </p>
                            <p class="m-0 fw-semibold"> Sindhupalchowk </p>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="w-50">
                            <p class="m-0 mt-3 text-secondary"> Municipality/ Rupal Municipality </p>
                            <p class="m-0 fw-semibold"> Melamchi </p>
                        </div>

                        <div class="w-50">
                            <p class="m-0 mt-3 text-secondary"> Ward </p>
                            <p class="m-0 fw-semibold"> 3 </p>
                        </div>
                    </div>

                    <div class="">
                        <p class="m-0 mt-3 text-secondary"> Tole/ Village </p>
                        <p class="m-0 fw-semibold"> Bobrang </p>
                    </div>
                </div>

                <!-- documents -->
                <p class="m-0 mt-3 text-secondary"> Documents </p>
                <div class="d-flex flex-row gap-2 mt-2 document-div">
                    <div class="document">
                        <img src="/rentrover/assets/images/blank.jpg" class="pointer" alt="" id="document-1">
                    </div>

                    <div class="document">
                        <img src="/rentrover/assets/images/blank.jpg" class="pointer" alt="" id="document-2">
                    </div>
                </div>

                <!-- action :: verify || unverify user -->
                <div class="d-flex flex-row gap-2 mt-3 action">
                    <a href="" class="btn btn-success" id="verify-user-btn"> Verify User </a>
                    <a href="" class="btn btn-danger" id="unverify-user-btn"> Unverify User </a>
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
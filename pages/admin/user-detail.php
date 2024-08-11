<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

require_once __DIR__ . '/../../classes/admin.php';
$profileUser = new Admin();

$profileUser->fetch($r_id, "all");

if (!isset($page))
    $page = "users";

require_once __DIR__ . '/../../classes/user.php';
$userObj = new User();

// check if user exists
$userExists = $userObj->fetch($userId, "all");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- title -->
    <title>
        <?php
        if($userExists) {
            if($userObj->getFullName() != '') {
                echo "User Detail : ".$userObj->getFullName();
            }
        } else {
            echo "User Not Found!";
        }
        ?>    
     </title>

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
    <link rel="stylesheet" href="/rentrover/css/popup-alert.css">
    <link rel="stylesheet" href="/rentrover/css/user-detail.css">
</head>

<body>
    <?php require_once __DIR__ . '/sections/aside.php'; ?>

    <main>
        <!-- my profile -->
        <section class="d-nones d-flex flex-column user-profile-container profile-content">
            <?php
            if($userExists) {
                ?>
                <p class="m-0 fs-4 fw-semibold"> User Information </p>

                <!-- top section -->
                <div class="d-flex flex-row gap-3 mt-4 align-items-center photo-username-email">
                    <div class="photo">
                        <?php
                        $profilePhotoSrc = ($userObj->profilePhoto != '') ? "/rentrover/uploads/users/$userObj->profilePhoto" : "/rentrover/uploads/blank.jpg";
                        ?>
                        <img src="<?= $profilePhotoSrc ?>" alt="">
                    </div>
                    <div class="username-email">
                        <p class="m-0 fw-semibold"> <?= $userObj->getFullName() ?> | <?= ucfirst($userObj->role) ?> </p>
                        <p class="m-0 text-secondary small"> <?= $userObj->email ?> </p>
                    </div>
                </div>
                
                <hr class="mt-4 text-secondary" />
                
                <div class="d-nones mb-3 profile-informations">
                    <div class="d-flex">
                        <div class="w-50">
                            <p class="m-0 text-secondary"> First Name </p>
                            <p class="m-0 fw-semibold"> <?= ucfirst($userObj->name['first']) ?> </p>
                        </div>
                
                        <div class="w-50">
                            <p class="m-0 text-secondary"> Last Name </p>
                            <p class="m-0 fw-semibold"> <?= ucfirst($userObj->name['first']) ?> </p>
                        </div>
                    </div>
                
                    <div class="mt-3 d-flex">
                        <div class="w-50">
                            <p class="m-0 text-secondary"> Gender </p>
                            <p class="m-0 fw-semibold"> <?= ucfirst($userObj->gender) ?> </p>
                        </div>
                
                        <div class="w-50">
                            <p class="m-0 text-secondary"> DoB </p>
                            <p class="m-0 fw-semibold"> <?= $userObj->dob ?> </p>
                        </div>
                    </div>
                
                    <div class="mt-3 d-flex">
                        <div class="w-50">
                            <p class="m-0 text-secondary"> Email </p>
                            <p class="m-0 fw-semibold"> <?= $userObj->email ?> </p>
                        </div>
                
                        <div class="w-50">
                            <p class="m-0 text-secondary"> Phone Number </p>
                            <p class="m-0 fw-semibold"> <?= $userObj->getPhoneNumber() ?> </p>
                        </div>
                    </div>
                
                    <p class="m-0 mt-3 text-secondary"> Address </p>
                    <div class="d-flex flex-column">
                        <div class="d-flex">
                            <div class="w-50">
                                <p class="m-0 mt-2 text-secondary"> Province </p>
                                <p class="m-0 fw-semibold"> <?= ucfirst($userObj->address['province']) ?> </p>
                            </div>
                            <div class="w-50">
                                <p class="m-0 mt-2 text-secondary"> District </p>
                                <p class="m-0 fw-semibold"> <?= ucfirst($userObj->address['district']) ?> </p>
                            </div>
                        </div>
                
                        <div class="d-flex">
                            <div class="w-50">
                                <p class="m-0 mt-3 text-secondary"> Municipality/ Rupal Municipality </p>
                                <p class="m-0 fw-semibold"> <?= ucfirst($userObj->address['municipalityRural']) ?> </p>
                            </div>
                
                            <div class="w-50">
                                <p class="m-0 mt-3 text-secondary"> Ward </p>
                                <p class="m-0 fw-semibold"> <?= $userObj->address['ward'] ?> </p>
                            </div>
                        </div>
                
                        <div class="w-100">
                            <p class="m-0 mt-3 text-secondary"> Tole/ Village </p>
                            <p class="m-0 fw-semibold"> <?= ucfirst($userObj->address['toleVillage']) ?> </p>
                        </div>

                        <div class="w-100">
                            <p class="m-0 mt-3 text-secondary"> Joined on </p>
                            <p class="m-0 fw-semibold"> <?= ucfirst($userObj->registrationDate) ?> </p>
                        </div>
                    </div>
                
                    <!-- documents -->
                    <p class="m-0 mt-3 text-secondary"> Documents </p>
                    <?php
                    if ($userObj->kyc['front'] == '' || $userObj->kyc['back'] == '') {
                        ?>
                        <p class="text-danger mb-3 mt-2"> User has not uploaded the KYC documents yet. </p>
                        <?php
                    } else {
                        ?>
                        <div class="d-flex flex-row gap-2 mt-2 document-div">
                            <div class="document">
                                <?php
                                $frontKyc = $userObj->kyc['front'];
                                $frontKycSrc = ($userObj->kyc['front'] != '') ? "/rentrover/uploads/kycs/$frontKyc" : "/rentrover/uploads/blank.jpg";
                                ?>
                                <img src="<?= $frontKycSrc; ?>" class="pointer" alt="" id="document-1">
                            </div>
                
                            <div class="document">
                                <?php
                                $backKyc = $userObj->kyc['back'];
                                $backKycSrc = ($userObj->kyc['back'] != '') ? "/rentrover/uploads/kycs/$backKyc" : "/rentrover/uploads/blank.jpg";
                                ?>
                                <img src="<?= $backKycSrc; ?>" class="pointer" alt="" id="document-1">
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                
                    <!-- action :: verify || unverify user -->
                    <div class="d-flex flex-row gap-2 mt-3 action">
                        <?php
                        if($userObj->flag == 'verified') {
                            ?>
                            <button class="btn btn-danger" id="unverify-user-btn"> Unverify User </button>
                            <?php
                        } elseif($userObj->flag == 'on-hold') {
                            ?>
                            <button class="btn btn-success" id="verify-user-btn"> Verify User </button>
                           <?php
                        } elseif($userObj->flag == 'pending') {
                            ?>
                            <p class="text-danger"> This account is not verfied yet. </p>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <p class="m-0 text fs-1 fw-bold"> User not found! </p>
                <?php
            }
            ?>

        </section>
    </main>


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

    <!-- popup js -->
    <script src="/rentrover/js/popup-alert.js"></script>

    <!-- script -->
    <script type="text/javascript">
        $(document).ready(function () {
            // verify user
            $('#verify-user-btn').click(function () {
                const user_id = <?= $userId ?>;
                $.ajax({
                    url: '/rentrover/pages/admin/app/verify-user.php',
                    type: "POST",
                    data: { userId: user_id },
                    beforeSend: function () {
                        $('#verify-user-btn').html("Verifying...").prop('disabled', true);
                    },
                    success: function (response) {
                        // show alert
                        if (response) {
                            showPopupAlert("Account verified.");
                            setTimeout(() => { location.reload(); }, 2000);
                        }
                        else {
                            showPopupAlert("Account couldn't be verified.");
                            setTimeout(() => {
                                $('#verify-user-btn').html("Verify").prop('disabled', false);
                            }, 2000);
                        }
                    }
                });
            });

            // unverify user
            $('#unverify-user-btn').click(function () {
                const user_id = <?= $userId ?>;
                $.ajax({
                    url: '/rentrover/pages/admin/app/unverify-user.php',
                    type: "POST",
                    data: { userId: user_id },
                    beforeSend: function () {
                        $('#unverify-user-btn').html("Unverifying...").prop('disabled', true);
                    },
                    success: function (response) {
                        // show alert
                        if (response) {
                            showPopupAlert("Account unverified.");
                            setTimeout(() => { location.reload() }, 2000);
                        }
                        else {
                            showPopupAlert("Account couldn't be unverified.");
                            setTimeout(() => {
                                $('#unverify-user-btn').html("Verify").prop('disabled', false);
                            }, 2000);
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>
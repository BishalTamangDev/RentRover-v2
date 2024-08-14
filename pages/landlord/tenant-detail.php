<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

require_once __DIR__ . '/../../classes/user.php';
require_once __DIR__ . '/../../classes/house.php';
require_once __DIR__ . '/../../classes/room.php';
require_once __DIR__ . '/../../classes/tenancy-history.php';

$profileUser = new User();
$houseObj = new House();
$roomObj = new Room();
$tenancyObj = new Tenancy();

$profileUser->fetch($r_id, "all");

if (!isset($tab))
    $tab = isset($_GET['tab']) ? $_GET['tab'] : "view";

$page = "tenant-detail";

// get tenancy id
$houseIdList = $houseObj->fetchHouseIdByLandlordId($r_id);
$roomIdList = $roomObj->fetchAllRoomIdByLandlord($houseIdList);
$histories = $tenancyObj->fetchHistoryForLandlord($roomIdList);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- title -->
    <title> Tenant Details </title>

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
    <link rel="stylesheet" href="/rentrover/css/popup-alert.css">
</head>

<body>
    <!-- aside -->
    <?php require_once __DIR__ . '/sections/aside.php'; ?>

    <main>
        <?php
        $tenant = new User();
        $tenant->fetch($tenantId, "all");
        ?>
        <!-- my profile -->
        <section class="d-flex flex-column user-profile-container profile-content">
            <p class="m-0 fs-4 fw-semibold"> Tenant Information </p>

            <!-- top section -->
            <div class="d-flex flex-row gap-3 mt-4 align-items-center photo-username-email">
                <div class="photo">
                    <img src="/rentrover/uploads/users/<?= $tenant->profilePhoto ?>" alt="">
                </div>
                <div class="username-email">
                    <p class="m-0 fw-semibold"> <?= $tenant->getFullName() ?> </p>
                </div>
            </div>

            <hr class="mt-4 text-secondary" />

            <div class="d-nones mb-3 profile-informations">
                <!-- name -->
                <div class="d-flex flex-column flex-md-row row-gap-3">
                    <div class="w-50">
                        <p class="m-0 text-secondary"> First Name </p>
                        <p class="m-0 fw-semibold"> <?= ucfirst($tenant->name['first']) ?> </p>
                    </div>

                    <div class="w-50">
                        <p class="m-0 text-secondary"> Last Name </p>
                        <p class="m-0 fw-semibold"> <?= ucfirst($tenant->name['last']) ?> </p>
                    </div>
                </div>

                <div class="d-flex flex-column flex-md-row row-gap-3 mt-3">
                    <div class="w-50">
                        <p class="m-0 text-secondary"> Gender </p>
                        <p class="m-0 fw-semibold"> Male </p>
                    </div>

                    <div class="w-50">
                        <p class="m-0 text-secondary"> Phone Number </p>
                        <p class="m-0 fw-semibold"> 9823645014 </p>
                    </div>
                </div>

                <p class="m-0 mt-3 text-secondary"> Address </p>
                <div class="d-flex flex-column">
                    <div class="d-flex flex-column flex-md-row row-gap-3 mt-1">
                        <div class="w-50">
                            <p class="m-0 mt-2 text-secondary"> Province </p>
                            <p class="m-0 fw-semibold"> <?= $tenant->address['province'] ?> </p>
                        </div>
                        <div class="w-50">
                            <p class="m-0 mt-2 text-secondary"> District </p>
                            <p class="m-0 fw-semibold"> <?= $tenant->address['district'] ?> </p>
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-md-row row-gap-3 mt-3">
                        <div class="w-50">
                            <p class="m-0 mt-3 text-secondary"> Municipality/ Rupal Municipality </p>
                            <p class="m-0 fw-semibold"> <?= $tenant->address['municipalityRural'] ?> </p>
                        </div>

                        <div class="w-50">
                            <p class="m-0 mt-3 text-secondary"> Ward </p>
                            <p class="m-0 fw-semibold"> <?= $tenant->address['ward'] ?> </p>
                        </div>
                    </div>

                    <div>
                        <p class="m-0 mt-3 text-secondary"> Tole/ Village </p>
                        <p class="m-0 fw-semibold"> <?= ucfirst($tenant->address['toleVillage']) ?> </p>
                    </div>
                </div>
            </div>

            <hr class="m-0" />

            <?php
            $currentRoom = "";
            foreach ($histories as $history) {
                $tenancyObj->fetch($history);
                if ($tenancyObj->getTenantId() == $tenantId) {
                    $moveInDate = $tenancyObj->moveInDate;
                    $currentRoom = $tenancyObj->getRoomId();
                    $moveOutDate = $tenancyObj->moveOutDate != '0000-00-00 00:00:00' ? $tenancyObj->moveOutDate : 'Still Residing';
                    ?>
                    <!-- tenancy details -->
                    <div class="mt-3 tenancy-info">
                        <p class="m-0 fw-semibold fs-4" style="color:var(--brand-color)"> Tenancy History </p>
                        <div class="mt-2">
                            <table>
                                <tr>
                                    <td> Move in Date </td>
                                    <td class="px-3 fw-semibold"> <?= $moveInDate ?> </td>
                                </tr>

                                <tr>
                                    <td> Move out Date </td>
                                    <td class="px-3 fw-semibold"> <?= $moveOutDate ?> </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>

            <!-- check if current tenant -->
            <?php
            if ($moveOutDate == 'Still Residing') {
                ?>
                <!-- action -->
                <button class="btn btn-danger fit-content py-1 mt-3" data-room-id="<?= $currentRoom ?>"
                    data-tenant-id="<?= $tenantId ?>" id="remove-tenant-btn"> Remove Tenant </button>
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

    <!-- script -->
    <script src="/rentrover/js/popup-alert.js"></script>

    <script>
        $(document).ready(function () {
            $('#remove-tenant-btn').click(function () {
                var room_id = $(this).data('room-id');
                var tenant_id = $(this).data('tenant-id');

                $.ajax({
                    url: '/rentrover/pages/landlord/app/remove-tenant.php',
                    data: { tenantId: tenant_id, roomId: room_id },
                    type: "POST",
                    beforeSend: function () {
                        $('#remove-tenant-btn').html("Removing...").prop('disabled', true);
                    },
                    success: function (response) {
                        console.log(response);
                        if (response == true) {
                            $('#remove-tenant-btn').html("Tenant Removed").prop('disabled', true);
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>
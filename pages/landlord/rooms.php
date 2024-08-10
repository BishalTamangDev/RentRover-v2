<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

require_once __DIR__ . '/../../classes/user.php';
require_once __DIR__ . '/../../classes/house.php';

$profileUser = new User();
$house = new House();

$profileUser->fetch($r_id, "all");

if (!isset($tab))
    $tab = isset($_GET['tab']) ? $_GET['tab'] : "view";

$page = "rooms";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- title -->
    <title> Rooms </title>

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
    <link rel="stylesheet" href="/rentrover/css/filter.css">
</head>

<body>
    <!-- aside -->
    <?php require_once __DIR__ . '/sections/aside.php'; ?>

    <main>
        <?php
        $eligible = $house->checkIfEligibleToAddRoom($r_id);

        if (!$eligible) {
            ?>
            <div class="alert alert-danger" role="alert">
                Please add house first to add room. <a href="/rentrover/landlord/add-house" class="text-primary"> Click here
                </a> to add house.
            </div>
            <?php
        }
        ?>

        <!-- card container -->
        <section class="card-v2-container">
            <!-- total rooms -->
            <div class="card-v2">
                <p class="title"> Number of rooms </p>
                <p class="data" id="all-room-count"> 0 </p>
            </div>

            <!-- acquired rooms -->
            <div class="card-v2">
                <p class="title"> Acquired </p>
                <p class="data" id="acquired-room-count"> 0 </p>
            </div>

            <!-- Unacquired room -->
            <div class="card-v2">
                <p class="title"> Unacquired </p>
                <p class="data" id="unacquired-room-count"> 0 </p>
            </div>
        </section>

        <!-- check if the landlord is eligible for adding room -->

        <!-- add room button -->
        <button onclick="window.location.href='/rentrover/landlord/add-room'"
            class="d-flex flex-row gap-2 align-items-center btn btn-brand mb-3 mt-4 fit-content" <?php if (!$eligible)
                echo "disabled"; ?>> <i class="fa fa-add"></i> Add New Room </button>

        <!-- filter -->
        <section class="flex-wrap filter-container">
            <!-- room type -->
            <div class="parameter">
                <label for="type"> Room Type </label>
                <select name="type" class="form-select-sm" id="type">
                    <option value="all" selected> All </option>
                    <option value="bhk"> BHK </option>
                    <option value="non-bhk"> Non-BHK </option>
                </select>
            </div>

            <!-- furnishing -->
            <div class="parameter">
                <label for="furnishing"> Furnishing </label>
                <select name="furnishing" class="form-select-sm" id="furnishing">
                    <option value="all" selected> All </option>
                    <option value="unfurnished"> Unfurnished </option>
                    <option value="semi-furnished"> Semi-furnished </option>
                    <option value="fully-furnished"> Fully-furnished </option>
                </select>
            </div>

            <!-- acquired -->
            <div class="parameter">
                <label for="acquired"> Acquired </label>
                <select name="acquired" class="form-select-sm" id="acquired">
                    <option value="all" selected> All </option>
                    <option value="acquired"> Acquired </option>
                    <option value="unacquired"> Unacquired </option>
                </select>
            </div>

            <div class="clear" id="clear">
                <p> Clear <span> <i class="fa fa-multiply"></i></span> </p>
            </div>
        </section>

        <!-- room table -->
        <section class="table-container room-table-container mt-3">
            <table class="table table-striped mt-4">
                <thead>
                    <tr>
                        <th scope="col" class="serial"> S.N. </th>
                        <th scope="col"> House ID </th>
                        <th scope="col"> Location </th>
                        <th scope="col"> Room Type </th>
                        <th scope="col"> Furnishing </th>
                        <th scope="col"> Acquired </th>
                        <th scope="col"> Added Date </th>
                        <th scope="col" class="action"> </th>
                    </tr>
                </thead>
                <tbody id="room-table-body">
                    <!-- <tr class="room-row bhk-row unfurnished-row unacquired-row">
                        <th scope="row" class="serial"> 1 </th>
                        <td> 10256 </td>
                        <td> Phungling, Pathivara, 3 </td>
                        <td> BHK, 4BHK </td>
                        <td> Unfurnished </td>
                        <td> Unacquired </td>
                        <td> 0000-00-00 00:00:00 </td>
                        <td class="action">
                            <a href="/rentrover/landlord/room-detail/1" class="text-primary small">
                                Show details
                            </a>
                        </td>
                    </tr> -->
                </tbody>

                <tfoot id="empty-data-foot">
                    <tr>
                        <td colspan="9"> No data found! </td>
                    </tr>
                </tfoot>
            </table>
        </section>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
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

    <!-- script -->
    <script>
        $(document).ready(function () {
            let type = "all";
            let furnishing = "all";
            let acquired = "all";
            let filterState = false;

            // count rooms :: all, acquired , unacquired
            function countRooms(){
                // all rooms
                $.ajax({
                    url: '/rentrover/pages/landlord/app/count-room.php',
                    success : function (data) {
                        $('#all-room-count').html(data);
                    }, error :function () {
                        $('#all-room-count').html("0");
                    }
                });

                // acquired rooms
                $.ajax({
                    url: '/rentrover/pages/landlord/app/count-acquired-room.php',
                    success : function (data) {
                        $('#acquired-room-count').html(data);
                    }, error :function () {
                        $('#acquired-room-count').html("0");
                    }
                });

                // unacquired rooms
                $.ajax({
                    url: '/rentrover/pages/landlord/app/count-unacquired-room.php',
                    success : function (data) {
                        $('#unacquired-room-count').html(data);
                    }, error :function () {
                        $('#unacquired-room-count').html("0");
                    }
                });
            }

            countRooms();

            // load all rooms
            function loadAllRoom() {
                const landlord_id = <?= $r_id ?>;
                $.ajax({
                    url: '/rentrover/pages/landlord/sections/room-table.php',
                    success: function (data) {
                        $('#room-table-body').html(data);
                        toggleEmptyContent();
                    }
                });
            }

            loadAllRoom();

            // type
            $('#type').change(function () {
                type = $('#type').val();
                toggleData();
            });

            // furnishing
            $('#furnishing').change(function () {
                furnishing = $('#furnishing').val();
                toggleData();
            });

            // acquired
            $('#acquired').change(function () {
                acquired = $('#acquired').val();
                toggleData();
            });

            // clear
            $('#clear').click(function () {
                $('#type').val("all");
                $('#furnishing').val("all");
                $('#acquired').val("all");

                type = "all";
                furnishing = "all";
                acquired = "all";
                filterState = false;
                toggleData();
            });

            // toggle empty data
            function toggleEmptyContent() {
                $('.room-row:visible').length == 0 ? $('#empty-data-foot').show() : $('#empty-data-foot').hide();
            }

            function toggleData() {
                filterState = false;
                $('.room-row').show();
                // type
                if (type != "all") {
                    filterState = true;
                    type == 'bhk' ? $('.non-bhk-row').hide() : $('.bhk-row').hide();
                }

                // furnishing
                if (furnishing != "all") {
                    filterState = true;
                    if (furnishing == 'unfurnished') {
                        $('.semi-furnished-row').hide();
                        $('.fully-furnished-row').hide();
                    } else if (furnishing == 'semi-furnished') {
                        $('.unfurnished-row').hide();
                        $('.fully-furnished-row').hide();
                    } else {
                        $('.unfurnished-row').hide();
                        $('.semi-furnished-row').hide();
                    }
                }

                // acquired
                if (acquired != "all") {
                    filterState = true;
                    acquired == "acquired" ? $('.unacquired-row').hide() : $('.acquired-row').hide();
                }

                filterState ? $('#clear').show() : $('#clear').hide();

                toggleEmptyContent();
            }

            toggleEmptyContent();
        });
    </script>
</body>

</html>
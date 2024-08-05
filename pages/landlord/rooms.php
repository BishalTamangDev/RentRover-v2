<?php
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
        <!-- card container -->
        <section class="card-v2-container">
            <!-- total rooms -->
            <div class="card-v2">
                <p class="title"> Number of rooms </p>
                <p class="data"> 120 </p>
            </div>

            <!-- acquired rooms -->
            <div class="card-v2">
                <p class="title"> Acquired </p>
                <p class="data"> 12 </p>
            </div>

            <!-- Unacquired room -->
            <div class="card-v2">
                <p class="title"> Unacquired </p>
                <p class="data"> 108 </p>
            </div>
        </section>

        <!-- add room button -->
        <a href="/rentrover/landlord/add-room"
            class="d-flex flex-row gap-2 align-items-center btn btn-brand mb-3 mt-4 fit-content"> <i class="fa fa-add"></i>
            Add New Room </a>

        <!-- filter -->
        <section class="filter-container">
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
                <tbody>
                    <tr class="room-row bhk-row unfurnished-row unacquired-row">
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
                    </tr>

                    <tr class="room-row non-bhk-row semi-furnished-row acquired-row">
                        <th scope="row" class="serial"> 2 </th>
                        <td> 2324 </td>
                        <td> Bhojpur </td>
                        <td> Non-BHK, 3 Rooms</td>
                        <td> Semi-furnished </td>
                        <td> Acquired </td>
                        <td> 0000-00-00 00:00:00 </td>
                        <td class="action">
                            <a href="/rentrover/landlord/room-detail/2" class="text-primary small">
                                Show details
                            </a>
                        </td>
                    </tr>

                    <tr class="room-row bhk-row fully-furnished-row acquired-row">
                        <th scope="row" class="serial"> 3 </th>
                        <td> 784516 </td>
                        <td> Sindhupalchowk </td>
                        <td> 2 BHK </td>
                        <td> Fully-furnished </td>
                        <td> Acquired </td>
                        <td> 0000-00-00 00:00:00 </td>
                        <td class="action">
                            <a href="/rentrover/landlord/room-detail/3" class="text-primary small">
                                Show details
                            </a>
                        </td>
                    </tr>
                </tbody>

                <tfoot id="empty-data-foot">
                    <tr>
                        <td colspan="9"> No data found! </td>
                    </tr>
                </tfoot>
            </table>
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

    <!-- script -->
    <script>
        $(document).ready(function () {
            let type = "all";
            let furnishing = "all";
            let acquired = "all";
            let filterState = false;

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
                console.clear();
                console.log(type);
                console.log(furnishing);
                console.log(acquired);

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
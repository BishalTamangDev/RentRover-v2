<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

require_once __DIR__ . '/../../classes/user.php';
$profileUser = new User();

$profileUser->fetch($r_id, "all");

if (!isset($tab))
    $tab = isset($_GET['tab']) ? $_GET['tab'] : "view";

$page = "houses";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- title -->
    <title> Houses </title>

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
            <!-- total house -->
            <div class="card-v2">
                <p class="title"> Number of houses </p>
                <p class="data" id="house-count"> 0 </p>
            </div>
        </section>

        <!-- add house button -->
        <a href="/rentrover/landlord/add-house"
            class="d-flex flex-row gap-2 align-items-center btn btn-brand mb-3 mt-4 fit-content"> <i
                class="fa fa-add"></i> Add New House </a>

        <!-- house table -->
        <section class="table-container user-table-container mt-3">
            <table class="table table-striped mt-4">
                <thead>
                    <tr>
                        <th scope="col" class="serial"> S.N. </th>
                        <th scope="col"> Location </th>
                        <th scope="col"> Number of rooms </th>
                        <th scope="col"> Added on </th>
                        <th scope="col" class="action"> </th>
                    </tr>
                </thead>
                <tbody id="house-table-body">
                    <!-- <tr class="house-row">
                        <th scope="row" class="serial"> 1 </th>
                        <td> address </td>
                        <td> no. of rooms </td>
                        <td class="small text-secondary"> registration date </td>
                        <td class="action">
                            <a href="/rentrover/landlord/house-detail/1" class="text-primary small">
                                Show details
                            </a>
                        </td>
                    </tr> -->
                </tbody>

                <tfoot id="empty-data-foot">
                    <tr>
                        <td colspan="7"> No data found! </td>
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

    <script>
        $(document).ready(function () {
            // count house
            $.ajax({
                url: '/rentrover/pages/landlord/app/count-house.php',
                type: "POST",
                data: { landlordId: <?= $r_id ?> },
                success: function (data) {
                    $('#house-count').html(data);
                }
            });

            function loadHouse() {
                $.ajax({
                    url: '/rentrover/pages/landlord/sections/house-table.php',
                    // house-table-body
                    type: "POST",
                    data: { landlordId: <?= $r_id ?> },
                    success: function (data) {
                        $('#house-table-body').html(data);
                        // toggle empty
                        toggleEmptyContent();
                    }
                });
            }

            loadHouse();

            // toggle empty data
            function toggleEmptyContent() {
                $('.house-row:visible').length == 0 ? $('#empty-data-foot').show() : $('#empty-data-foot').hide();
            }
        });
    </script>
</body>

</html>
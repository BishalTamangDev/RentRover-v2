<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

require_once __DIR__ . '/../../classes/admin.php';
$profileUser = new Admin();

$profileUser->fetch($r_id, "all");

$page = "users";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- title -->
    <title> Users </title>

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
    <?php require_once __DIR__ . '/sections/aside.php'; ?>

    <main>
        <!-- card container -->
        <section class="card-v2-container">
            <!-- total users -->
            <div class="card-v2">
                <p class="title"> Number of users </p>
                <p class="data"> 120 </p>
            </div>

            <!-- landlords -->
            <div class="card-v2">
                <p class="title"> Landlords </p>
                <p class="data"> 50 </p>
            </div>

            <!-- tenants -->
            <div class="card-v2">
                <p class="title"> Tenant </p>
                <p class="data"> 70 </p>
            </div>
        </section>

        <!-- filter -->
        <section class="filter-container">
            <div class="parameter">
                <label for="filter-role"> Role </label>
                <select name="filter-role" class="form-select-sm" id="filter-role">
                    <option value="all"> All </option>
                    <option value="landlord"> Landlord </option>
                    <option value="tenant"> Tenant </option>
                </select>
            </div>

            <div class="clear" id="clear">
                <p> Clear <span> <i class="fa fa-multiply"></i></span> </p>
            </div>
        </section>

        <!-- user table -->
        <section class="table-container user-table-container">
            <table class="table table-striped mt-4">
                <thead>
                    <tr>
                        <th scope="col" class="serial"> S.N. </th>
                        <th scope="col"> Name </th>
                        <th scope="col"> Address </th>
                        <th scope="col"> Role </th>
                        <th scope="col"> Contact </th>
                        <th scope="col"> Joined Date </th>
                        <th scope="col" class="action"> </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="user-row landlord-row">
                        <th scope="row" class="serial"> 1 </th>
                        <td> Rupak dangi </td>
                        <td> Phungling, Pathivara, 3 </td>
                        <td> Landlord </td>
                        <td> 984514586 </td>
                        <td> 0000-00-00 00:00:00 </td>
                        <td class="action">
                            <a href="/rentrover/admin/user-detail/1" class="text-primary small"> Show details
                            </a>
                        </td>
                    </tr>

                    <tr class="user-row tenant-row">
                        <th scope="row" class="serial"> 2 </th>
                        <td> Shristi Pradhan </td>
                        <td> Bhojpur </td>
                        <td> Tenant </td>
                        <td> 984514586 </td>
                        <td> 0000-00-00 00:00:00 </td>
                        <td class="action">
                            <a href="/rentrover/admin/user-detail/1" class="text-primary small"> Show details
                            </a>
                        </td>
                    </tr>
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

    <!-- script -->
    <script>
        $(document).ready(function () {
            // role
            $('#filter-role').change(function () {
                toggleData($('#filter-role').val());
            });

            // clear
            $('#clear').click(function () {
                $('#filter-role').val("all");
                toggleData("all");
            });

            // toggle empty data
            function toggleEmptyContent() {
                $('.user-row:visible').length == 0 ? $('#empty-data-foot').show() : $('#empty-data-foot').hide();
            }

            function toggleData(role) {
                if (role == "all") {
                    $('.user-row').show();
                    $('#clear').hide();
                } else if (role == 'landlord') {
                    $('.tenant-row').hide();
                    $('#clear').show();
                } else if (role == 'tenant') {
                    $('.landlord-row').hide();
                    $('#clear').show();
                }
                toggleEmptyContent();
            }

            toggleEmptyContent();
        });
    </script>
</body>

</html>
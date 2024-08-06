<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

require_once __DIR__ . '/../../classes/user.php';
$profileUser = new User();

$profileUser->fetch($r_id, "all");

if (!isset($tab))
    $tab = isset($_GET['tab']) ? $_GET['tab'] : "view";

$page = "tenants";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- title -->
    <title> Tenants </title>

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
            <!-- total tenants -->
            <div class="card-v2">
                <p class="title"> Total Tenants </p>
                <p class="data"> 120 </p>
            </div>

            <!-- current tenants -->
            <div class="card-v2">
                <p class="title"> Current Tenant </p>
                <p class="data"> 50 </p>
            </div>

            <!-- ex-tenants -->
            <div class="card-v2">
                <p class="title"> Ex-Tenant </p>
                <p class="data"> 70 </p>
            </div>
        </section>

        <!-- filter -->
        <section class="filter-container">
            <div class="parameter">
                <label for="filter-status"> Status </label>
                <select name="filter-status" class="form-select-sm" id="filter-status">
                    <option value="all"> All </option>
                    <option value="current"> Current Tenant </option>
                    <option value="ex"> Ex-tenant </option>
                </select>
            </div>

            <div class="clear" id="clear">
                <p> Clear <span> <i class="fa fa-multiply"></i></span> </p>
            </div>
        </section>

        <!-- tenant table -->
        <section class="table-container tenant-table-container">
            <table class="table table-striped mt-4">
                <thead>
                    <tr>
                        <th scope="col" class="serial"> S.N. </th>
                        <th scope="col"> Name </th>
                        <th scope="col"> Room </th>
                        <th scope="col"> Contact </th>
                        <th scope="col"> Move in Date </th>
                        <th scope="col"> Move out Date </th>
                        <th scope="col" class="action"> </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="tenant-row current-row">
                        <th scope="row" class="serial"> 1 </th>
                        <td> Rupak dangi </td>
                        <td> Phungling, Pathivara, 3 </td>
                        <td> 984514586 </td>
                        <td> 0000-00-00 </td>
                        <td> Still residing </td>
                        <td class="action">
                            <a href="/rentrover/landlord/tenant-detail/1" class="text-primary pointer small">
                                Show details
                            </a>
                        </td>
                    </tr>

                    <tr class="tenant-row ex-row">
                        <th scope="row" class="serial"> 2 </th>
                        <td> Shristi Pradhan </td>
                        <td> Bhojpur, Myanglung </td>
                        <td> 984514586 </td>
                        <td> 0000-00-00 </td>
                        <td> 0000-00-00 </td>
                        <td class="action">
                            <a href="/rentrover/landlord/tenant-detail/2" class="text-primary pointer small">
                                Show details
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
            // status
            $('#filter-status').change(function () {
                toggleData($('#filter-status').val());
            });

            // clear
            $('#clear').click(function () {
                $('#filter-status').val("all");
                toggleData("all");
            });

            // toggle empty data
            function toggleEmptyContent() {
                $('.tenant-row:visible').length == 0 ? $('#empty-data-foot').show() : $('#empty-data-foot').hide();
            }

            function toggleData(status) {
                if (status == "all") {
                    $('.tenant-row').show();
                    $('#clear').hide();
                } else {
                    $('.tenant-row').show();
                    status == 'current' ? $('.ex-row').hide() : $('.current-row').hide();
                    $('#clear').show();
                }
                toggleEmptyContent();
            }

            toggleEmptyContent();
        });
    </script>
</body>

</html>
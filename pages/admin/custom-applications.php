<?php
if(!isset($page)) 
    $page = "custom-applications";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- title -->
    <title> Custom Room Application </title>

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
</head>

<body>
    <?php require_once __DIR__ . '/sections/aside.php'; ?>

    <main>
        <!-- card container -->
        <section class="card-v2-container">
            <!-- application -->
            <div class="card-v2">
                <p class="title"> Total Application </p>
                <p class="data"> 120 </p>
            </div>
        </section>

        <!-- custom room applciation table -->
        <section class="table-container custom-app-container mt-3">
            <table class="table table-striped mt-4">
                <thead>
                    <tr>
                        <th scope="col" class="serial"> S.N. </th>
                        <th scope="col"> Tenant </th>
                        <th scope="col"> Location </th>
                        <th scope="col"> Room Type </th>
                        <th scope="col"> Min Rent </th>
                        <th scope="col"> Max Rent </th>
                        <th scope="col"> Furnishing </th>
                        <th scope="col"> Applied Date </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="house-row">
                        <th scope="row" class="serial"> 1 </th>
                        <td>
                            <a href="/rentrover/pages/admin/user-detail.php" class="text-primary"> Rupak Dangi </a>
                        </td>
                        <td> Lalitpur </td>
                        <td> BHK </td>
                        <td> 17,000.00 </td>
                        <td> 25,000.00 </td>
                        <td> Unfurnished </td>
                        <td> 0000-00-00 00:00:00 </td>
                    </tr>

                    <tr class="house-row">
                        <th scope="row" class="serial"> 2 </th>
                        <td>
                            <a href="/rentrover/pages/admin/user-detail.php" class="text-primary">
                                Shristi Pradhan
                            </a>
                        </td>
                        <td> Bhaktapur </td>
                        <td> Non-BHK </td>
                        <td> 1,000.00 </td>
                        <td> 12,000.00 </td>
                        <td> Fulli-furnished </td>
                        <td> 0000-00-00 00:00:00 </td>
                    </tr>
                </tbody>

                <tfoot>
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
</body>

</html>
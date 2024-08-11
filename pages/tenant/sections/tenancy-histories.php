<div class="d-flex flex-column border rounded tenancy-history-container profile-content">
    <p class="m-0 fs-4 fw-semibold"> Tenancy History </p>
    <div class="table-container">
        <table class="mt-4 table-striped table">
            <thead>
                <tr>
                    <th scope="col"> S.N. </th>
                    <th scope="col"> Location </th>
                    <th scope="col"> Room No. </th>
                    <th scope="col"> Specification </th>
                    <th scope="col"> Rent </th>
                    <th scope="col"> Move in date </th>
                    <th scope="col"> Move out date </th>
                </tr>
            </thead>

            <tbody id="tenancy-table-body">
                <tr class="invisible">
                    <td scope="row"> 1. </td>
                    <td> Jaldhunga Marga, Pipalboat </td>
                    <td> 200 </td>
                    <td> 1 BHK, Un-furnished </td>
                    <td class="text-success"> NRS. 18,000.00 </td>
                    <td class="small text-secondary"> 0000-00-00 </td>
                    <td class="small text-secondary"> Still Residing </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- jquery -->
<script src="/rentrover/jquery/jquery-3.7.1.min.js"></script>

<script>
    $(document).ready(function () {
        $.ajax({
            url: '/rentrover/pages/tenant/sections/fetch-tenancy-history.php',
            type: 'POST',
            data: { tenantId: <?= $r_id ?> },
            success: function (data) {
                $('#tenancy-table-body').html(data);
            }
        });
    });
</script>
<div class="d-flex flex-column border rounded applied-room-container profile-content">
    <p class="m-0 fs-4 fw-semibold text-secondary"> Applied Rooms </p>
    <div class="table-container">
        <table class="mt-4 table-striped table">
            <thead>
                <tr>
                    <th scope="col"> S.N. </th>
                    <th scope="col"> Location </th>
                    <th scope="col"> Room No. </th>
                    <th scope="col"> Specification </th>
                    <th scope="col"> Move in date </th>
                    <th scope="col"> Move out date </th>
                    <th scope="col"> Status </th>
                </tr>
            </thead>

            <tbody id="application-table-body">
                
            </tbody>
        </table>
    </div>
</div>

<script src="/rentrover/jquery/jquery-3.7.1.min.js"></script>

<script>
    $(document).ready(function () {
        $.ajax({
            url: '/rentrover/pages/tenant/sections/load-applications.php',
            success: function (data) {
                $('#application-table-body').html(data);
            }
        });
    });
</script>
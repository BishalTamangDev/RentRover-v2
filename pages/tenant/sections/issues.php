<div class="d-flex flex-column border rounded issues-container profile-content">
    <p class="m-0 fs-4 fw-semibold text-secondary"> Issues </p>

    <!-- simple card -->
    <div class="simple-card-container mt-3">
        <p class="simple-card active" id="all-simple-card"> All </p>
        <p class="simple-card" id="unsolved-simple-card"> Unsolved </p>
        <p class="simple-card" id="solved-simple-card"> Solved </p>
    </div>


    <div class="table-container">
        <table class="mt-4 table-striped table">
            <thead>
                <tr>
                    <th scope="col"> S.N. </th>
                    <th scope="col"> Room ID </th>
                    <th scope="col"> Location </th>
                    <th scope="col"> Issues Date </th>
                    <th scope="col"> Solved Date </th>
                    <th scope="col"> State </th>
                </tr>
            </thead>

            <tbody>
                <tr class="issue-row solved-row">
                    <td scope="row"> 1. </td>
                    <td> 7854 </td>
                    <td> Jaldhunga Marga, Pipalboat </td>
                    <td> 0000-00-00 </td>
                    <td> 0000-00-00 </td>
                    <td> Unsolved </td>
                </tr>
            </tbody>

            <tfoot id="empty-data-foot">
                <tr>
                    <td colspan="9"> No data found! </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
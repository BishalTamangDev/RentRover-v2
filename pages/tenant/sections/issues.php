<div class="d-flex flex-column issues-container profile-content">
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
                    <th scope="col"> Room </th>
                    <th scope="col"> Issue </th>
                    <th scope="col"> Issues Date </th>
                    <th scope="col"> Solved Date </th>
                    <th scope="col"> State </th>
                </tr>
            </thead>

            <tbody id="issue-table-body">
                <tr class="d-none issue-row solved-row">
                    <td scope="row"> 1. </td>
                    <td> 7854 </td>
                    <td> Issue </td>
                    <td> 0000-00-00 </td>
                    <td> 0000-00-00 </td>
                    <td> Unsolved </td>
                </tr>
            </tbody>

            <tfoot id="issue-empty-data-foot">
                <tr>
                    <td colspan="9"> No data found! </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<script>
    $(document).ready(function () {
        // fetch issue
        type = "all";

        function fetchIssue() {
            $.ajax({
                url: '/rentrover/pages/tenant/sections/issue-fetch.php',
                type: 'POST',
                data: { tenantId: <?= $r_id ?? 0 ?> },
                success: function (data) {
                    if (data != false) {
                        $('#issue-table-body').html(data);
                    }
                    toggleData("all");
                    toggleIssueEmptySection();
                },
                error: function () {
                    toggleIssueEmptySection();
                }
            });
        }

        fetchIssue();

        // issues
        $('#all-simple-card').click(function () {
            toggleData("all");
            type = "all";
        });

        $('#unsolved-simple-card').click(function () {
            toggleData("unsolved");
            type = "unsolved";
        });

        $('#solved-simple-card').click(function () {
            toggleData("solved");
            type = "solved";
        });


        // toggle issues
        function toggleData(type) {
            $('#all-simple-card').removeClass("active");
            $('#unsolved-simple-card').removeClass("active");
            $('#solved-simple-card').removeClass("active");

            if (type == "all") {
                $('.issue-row').show();
                $('#all-simple-card').addClass("active");
            } else {
                $('.issue-row').hide();

                if (type == "unsolved") {
                    $('.unsolved-row').show();
                    $('#unsolved-simple-card').addClass("active");
                } else if (type == "solved") {
                    $('.solved-row').show();
                    $('#solved-simple-card').addClass("active");
                }
            }
            toggleIssueEmptySection();
        }


        function toggleIssueEmptySection() {
            if ($('.issue-row:visible').length == 0) {
                $('#issue-empty-data-foot').show();
            } else {
                $('#issue-empty-data-foot').hide();
            }
        }
    });
</script>
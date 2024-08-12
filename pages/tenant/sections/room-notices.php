<!-- room notices -->
<div class="d-flex flex-column border rounded landlord-notice-container profile-content">
    <p class="m-0 fs-4 fw-semibold"> Notice from Landlord </p>
    <!-- room notice -->
    <section class="room-notice-container mt-4" id="notice-container">
        <!-- notice -->
        <div class="d-none invisibles room-notice">
            <div class="top">
                <p class="title"> Title </p>
            </div>

            <p class="description"> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Est sint possimus esse
                voluptas accusamus nobis expedita cupiditate tempore suscipit perspiciatis, culpa dolores dolorem
                reprehenderit amet eos incidunt maiores recusandae doloribus minus quisquam unde nihil quia illum
                saepe! Asperiores, illo esse odit nam nisi, dolor quos ullam neque aliquid sint unde? </p>

            <p class="date"> 0000-00-00 00:00:00 </p>
        </div>
    </section>

    <div class="d-none empty-context-container" id="empty-context-container">
        <img src="/rentrover/assets/images/empty.png" alt="">
        <p class="m-0 text-danger"> Empty! </p>
    </div>
</div>

<script>
    $(document).ready(function () {
        $.ajax({
            type: "POST",
            url: "/rentrover/pages/tenant/sections/load-room-notice.php",
            data: { tenantId: <?= $r_id ?> },
            success: function (data) {
                $('#notice-container').html(data);
            }
        });
    });
</script>
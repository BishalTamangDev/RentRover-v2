<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

$userId = $_SESSION['rentrover-id'] ?? 0;

if ($userId == 0) {
    echo 0;
    exit;
}

require_once __DIR__ . '/../../../classes/notification.php';
require_once __DIR__ . '/../../../classes/user.php';

$tempUser = new User();
$tempNotification = new Notification();

$list = $tempNotification->fetchAdminNotification();

if (sizeof($list) == 0) {
    ?>
    <!-- empty context -->
    <div class="d-flex flex-row gap-2 p-3 notification">
        <p class="m-0 small text-secondary"> Empty! </p>
    </div>
    <?php
} else {
    foreach ($list as $row) {
        $id = $row['notification_id'];
        $type = $row['type'];
        $date = $row['date'];
        $status = $row['status'];
        $userId = $row['user_id'];
        // $tenantId = $row['tenant_id'];
        $roomId = $row['room_id'];
        $houseId = $row['house_id'];
        // $applicationId = $row['application_id'];
        // $leaveApplicationId = $row['leave_application_id'];
        // $issueId = $row['issue_id'];
        // $noticeId = $row['notice_id'];
        $feedbackId = $row['feedback_id'];

        $statusClass = $status == 'seen' ? "seen-notification" : "unseen-notification";
        ?>

        <?php
        if ($type == 'account-verification-apply') {
            $tempUser->fetch($userId, "mandatory");
            $userName = $tempUser->getFullName();
            $profilePhoto = $tempUser->profilePhoto;

            $link = "/rentrover/admin/user-detail/$userId";
            ?>
            <!-- room verification apply-->
            <div class="d-flex flex-row gap-2 notification <?= $statusClass ?>" onclick="window.location.href='<?= $link ?>'">
                <!-- icon -->
                <div class="notification-icon">
                    <img src="/rentrover/uploads/users/<?= $profilePhoto ?>" alt="">
                </div>

                <!-- details -->
                <div class="notification-details">
                    <!-- detail -->
                    <p class="m-0 small"> <?= $userName ?> applied for account verification. </p>

                    <!-- date -->
                    <p class="m-0 small text-secondary"> <?= $date ?> </p>
                </div>
            </div>
            <?php
        }
        ?>
        <!-- backup -->
        <div class="d-none d-flex flex-row gap-2 notification">
            <!-- icon -->
            <div class="notification-icon">
                <img src="/rentrover/assets/icons/verified.png" alt="">
            </div>

            <!-- details -->
            <div class="notification-details">
                <!-- detail -->
                <p class="m-0 small"> asdqwe Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus,
                    numquam? </p>

                <!-- date -->
                <p class="m-0 small text-secondary"> 0000-00-00 00:00:00 </p>
            </div>
        </div>
        <?php
    }
}
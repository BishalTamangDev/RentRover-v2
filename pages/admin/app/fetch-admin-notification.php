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
        <p class="m-0 small text-secondary"> No new notification! </p>
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
            <div class="notification notification-card <?= $statusClass ?>" onclick="window.location.href='<?= $link ?>'"
                data-notification-id="<?= $id ?>">
                <div class="notification-icon">
                    <img src="/rentrover/uploads/users/<?= $profilePhoto ?>" alt="">
                </div>

                <div class="notification-details">
                    <p class="note"> <?= $userName ?> applied for account verification. </p>
                    <p class="date"> <?= $date ?> </p>
                </div>
            </div>
            <?php
        } elseif ($type == 'feedback-submit') {
            // user feedback
            $tempUser->fetch($userId, "mandatory");
            $userName = $tempUser->getFullName();
            $profilePhoto = $tempUser->profilePhoto;

            $link = "/rentrover/admin/feedbacks";
            ?>
            <div class="notification notification-card <?= $statusClass ?>" onclick="window.location.href='<?= $link ?>'"
                data-notification-id="<?= $id ?>">
                <div class="notification-icon">
                    <img src="/rentrover/assets/icons/notifications/feedback.png" alt="">
                </div>
                <div class="notification-details">
                    <p class="note"> <?= $userName ?> submitted the feedback. </p>
                    <p class="date"> <?= $date ?> </p>
                </div>
            </div>
            <?php
        }
    ?>
    <?php
    }
}
?>

<!-- backup -->
<div class="d-none notifications">
    <!-- icon -->
    <div class="notification-icon">
        <img src="/rentrover/assets/icons/verified.png" alt="">
    </div>

    <!-- details -->
    <div class="notification-details">
        <!-- detail -->
        <p class="note"> asdqwe Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus,
            numquam? </p>

        <!-- date -->
        <p class="date"> 0000-00-00 00:00:00 </p>
    </div>
</div>
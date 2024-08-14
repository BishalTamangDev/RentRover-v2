<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

$userId = $_SESSION['rentrover-id'] ?? 0;

if ($userId == 0) {
    echo 0;
    exit;
}

require_once __DIR__ . '/../classes/notification.php';
require_once __DIR__ . '/../classes/user.php';

$tempUser = new User();
$tempNotification = new Notification();

$list = $tempNotification->fetchUserNotification($userId);

if (sizeof($list) == 0) {
    ?>
    <!-- empty notification -->
    <div class="p-2 px-3 py-4">
        <p class="m-0 text-secondary">
            No new notification!
        </p>
        <?php
} else {
    foreach ($list as $row) {
        $id = $row['notification_id'];
        $type = $row['type'];
        $date = $row['date'];
        $status = $row['status'];
        $userId = $row['user_id'];
        $tenantId = $row['tenant_id'];
        $roomId = $row['room_id'];
        $houseId = $row['house_id'];
        $applicationId = $row['application_id'];
        $leaveApplicationId = $row['leave_application_id'];
        $issueId = $row['issue_id'];
        $noticeId = $row['notice_id'];
        $feedbackId = $row['feedback_id'];

        $statusClass = $status == 'seen' ? "seen-notification" : "unseen-notification";

        $link = '/rentrover/tenant/';
        ?>
            <?php
            if ($type == 'account-verified') {
                $tempUser->fetch($userId, "mandatory");
                $link = $tempUser->role == 'tenant' ? "/rentrover/tenant/profile" : "/rentrover/landlord/profile";
                ?>
                <!-- account verified -->
                <div class="notification <?=$statusClass?>" onclick="window.location.href='<?=$link?>'">
                    <!-- icon -->
                    <div class="notification-icon">
                        <img src="/rentrover/assets/icons/notifications/verified.png" alt="">
                    </div>

                    <!-- details -->
                    <div class="notification-details">
                        <!-- detail -->
                        <p class="note"> Your account has been verified. Now you can apply for any room you like. </p>

                        <!-- date -->
                        <p class="date"> <?=$date?> </p>
                    </div>
                </div>
                <?php
            }  elseif ($type == 'account-unverified') {
                $tempUser->fetch($userId, "mandatory");
                $link = $tempUser->role == 'tenant' ? "/rentrover/tenant/profile" : "/rentrover/landlord/profile";
                ?>
                <!-- account unverified -->
                <div class="notification <?=$statusClass?>" onclick="window.location.href='<?=$link?>'">
                    <!-- icon -->
                    <div class="notification-icon">
                        <img src="/rentrover/assets/icons/notifications/unverified.png" alt="">
                    </div>

                    <!-- details -->
                    <div class="notification-details">
                        <!-- detail -->
                        <p class="note"> Your account is unverified. Please update your profile detail. </p>

                        <!-- date -->
                        <p class="date"> <?=$date?> </p>
                    </div>
                </div>
                <?php
            }
            ?>
            
            <!-- backup notification -->
            <div class="d-none d-flex flex-row gap-2 notification">
                <!-- icon -->
                <div class="notification-icon">
                    <img src="/rentrover/assets/icons/notifications/verified.png" alt="">
                </div>

                <!-- details -->
                <div class="notification-details">
                    <!-- detail -->
                    <p class="note"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus,
                        numquam? </p>

                    <!-- date -->
                    <p class="date"> 0000-00-00 00:00:00 </p>
                </div>
            </div>
            <?php
    }
}
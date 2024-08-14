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
require_once __DIR__ . '/../classes/room.php';
require_once __DIR__ . '/../classes/house.php';

$tempUser = new User();
$tempHouse = new House();
$tempRoom = new Room();
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
                // account verified
                $tempUser->fetch($userId, "mandatory");
                $link = $tempUser->role == 'tenant' ? "/rentrover/tenant/profile" : "/rentrover/landlord/profile";
                ?>
                <div class="notification notification-card <?= $statusClass ?>" onclick="window.location.href='<?= $link ?>'"
                    data-notification-id="<?= $id ?>">
                    <div class="notification-icon">
                        <img src="/rentrover/assets/icons/notifications/verified.png" alt="">
                    </div>

                    <div class="notification-details">
                        <p class="note"> Your account has been verified. Now you can apply for any room you like. </p>
                        <p class="date"> <?= $date ?> </p>
                    </div>
                </div>
                <?php
            } elseif ($type == 'account-unverified') {
                // account unverified
                $tempUser->fetch($userId, "mandatory");
                $link = $tempUser->role == 'tenant' ? "/rentrover/tenant/profile" : "/rentrover/landlord/profile";
                ?>
                <div class="notification notification-card <?= $statusClass ?>" onclick="window.location.href='<?= $link ?>'"
                    data-notification-id="<?= $id ?>">
                    <div class="notification-icon">
                        <img src="/rentrover/assets/icons/notifications/unverified.png" alt="">
                    </div>

                    <div class="notification-details">
                        <p class="note"> Your account is unverified. Please update your profile detail. </p>
                        <p class="date"> <?= $date ?> </p>
                    </div>
                </div>
                <?php
            } elseif ($type == 'room-application-apply') {
                // room application apply
                $tempUser->fetch($tenantId, "mandatory");
                $applicantName = $tempUser->getFullName();
                $link = "/rentrover/landlord/room-applications";
                ?>
                <div class="notification notification-card <?= $statusClass ?>" onclick="window.location.href='<?= $link ?>'"
                    data-notification-id="<?= $id ?>">
                    <div class="notification-icon">
                        <img src="/rentrover/assets/icons/notifications/room-application-apply.png" alt="">
                    </div>
                    <div class="notification-details">
                        <p class="note"> <?= $applicantName ?> applied for your room. </p>
                        <p class="date"> <?= $date ?> </p>
                    </div>
                </div>
                <?php
            } elseif ($type == 'room-application-accept') {
                // room application accept
                $tempUser->fetch($tenantId, "mandatory");
                $applicantName = $tempUser->getFullName();

                $link = "/rentrover/tenant/room-detail/$roomId";

                $tempRoom->fetch($roomId);

                $tempHouse->fetch($tempRoom->houseId);

                $location = $tempHouse->getAddress();
                ?>
                <div class="notification notification-card <?= $statusClass ?>" onclick="window.location.href='<?= $link ?>'"
                    data-notification-id="<?= $id ?>">
                    <div class="notification-icon">
                        <img src="/rentrover/assets/icons/notifications/room-application-accept.png" alt="">
                    </div>

                    <div class="notification-details">
                        <p class="note"> Your application for
                            <span class="text-secondary">
                                <?= $location ?> has been accepted.
                            </span>
                        </p>
                        <p class="date"> <?= $date ?> </p>
                    </div>
                </div>
                <?php
            } elseif ($type == 'room-application-reject') {
                // application reject
    
                $link = "/rentrover/tenant/room-detail/$roomId";

                $tempRoom->fetch($roomId);

                $tempHouse->fetch($tempRoom->houseId);

                $location = $tempHouse->getAddress();
                ?>
                <div class="notification notification-card <?= $statusClass ?>" onclick="window.location.href='<?= $link ?>'"
                    data-notification-id="<?= $id ?>">
                    <div class="notification-icon">
                        <img src="/rentrover/assets/icons/notifications/room-application-reject.png" alt="">
                    </div>
                    <div class="notification-details">
                        <p class="note"> Your application for
                            <span class="text-secondary">
                                <?= $location ?> has been rejected.
                            </span>
                        </p>
                        <p class="date"> <?= $date ?> </p>
                    </div>
                </div>
                <?php
            } elseif ($type == 'accept-as-tenant') {
                // accept as tenant
    
                $link = "/rentrover/tenant/room-detail/$roomId";

                $tempRoom->fetch($roomId);

                $tempHouse->fetch($tempRoom->houseId);

                $location = $tempHouse->getAddress();
                ?>
                <div class="notification notification-card <?= $statusClass ?>" onclick="window.location.href='<?= $link ?>'"
                    data-notification-id="<?= $id ?>">
                    <div class="notification-icon">
                        <img src="/rentrover/assets/icons/notifications/accept-as-tenant.png" alt="">
                    </div>
                    <div class="notification-details">
                        <p class="note"> You have been added as a tenant for
                            <span class="text-secondary">
                                <?= $location ?> has been rejected.
                            </span>
                        </p>
                        <p class="date"> <?= $date ?> </p>
                    </div>
                </div>
                <?php
            } elseif ($type == 'remove-tenant') {
                // remove tenant
    
                $link = "/rentrover/tenant/room-detail/$roomId";

                $tempRoom->fetch($roomId);

                $tempHouse->fetch($tempRoom->houseId);

                $location = $tempHouse->getAddress();
                ?>
                <div class="notification notification-card <?= $statusClass ?>" onclick="window.location.href='<?= $link ?>'"
                    data-notification-id="<?= $id ?>">
                    <div class="notification-icon">
                        <img src="/rentrover/assets/icons/notifications/remove-tenant.png" alt="">
                    </div>
                    <div class="notification-details">
                        <p class="note"> You have been removed as a tenant from
                            <span class="text-secondary">
                                <?= $location ?> room.
                            </span>
                        </p>
                        <p class="date"> <?= $date ?> </p>
                    </div>
                </div>
                <?php
            } elseif ($type == 'issue-submit') {
                // submit issue
                $tempUser->fetch($tenantId, "mandatory");
                $tenantName = $tempUser->getFullName();

                $link = "/rentrover/landlord/issues/";

                $tempRoom->fetch($roomId);

                $location = $tempHouse->getAddress();
                ?>
                <div class="notification notification-card <?= $statusClass ?>" onclick="window.location.href='<?= $link ?>'"
                    data-notification-id="<?= $id ?>">
                    <div class="notification-icon">
                        <img src="/rentrover/assets/icons/notifications/issue-submit.png" alt="">
                    </div>
                    <div class="notification-details">
                        <p class="note"> <?= $tenantName ?> reported an issue in the room number <span class="text-danger">
                                <?= $tempRoom->number ?>
                            </span>
                        </p>
                        <p class="date"> <?= $date ?> </p>
                    </div>
                </div>
                <?php
            } elseif ($type == 'issue-solved') {
                // issue solved
                $link = "/rentrover/tenant/profile/issues";
                $tempRoom->fetch($roomId);
                ?>
                <div class="notification notification-card <?= $statusClass ?>" onclick="window.location.href='<?= $link ?>'"
                    data-notification-id="<?= $id ?>">
                    <div class="notification-icon">
                        <img src="/rentrover/assets/icons/notifications/issue-submit.png" alt="">
                    </div>
                    <div class="notification-details">
                        <p class="note"> Issue for the room number <span class="text-danger"> <?= $tempRoom->number ?> </span> has
                            been solved.
                        </p>
                        <p class="date"> <?= $date ?> </p>
                    </div>
                </div>
                <?php
            } elseif ($type == 'leave-application-submit') {
                // leave application submit
                $link = "/rentrover/landlord/leave-applications";
                $tempUser->fetch($tenantId, "mandatory");

                $tenantName = $tempUser->getFullName();

                $tempRoom->fetch($roomId);
                ?>
                <div class="notification notification-card <?= $statusClass ?>" onclick="window.location.href='<?= $link ?>'"
                    data-notification-id="<?= $id ?>">
                    <div class="notification-icon">
                        <img src="/rentrover/assets/icons/notifications/leave-application-submit.png" alt="">
                    </div>
                    <div class="notification-details">
                        <p class="note"> <span class="text-danger"> <?= $tenantName ?> </span> submitted the leave application for
                            the
                            room number <span class="text-danger"> <?= $tempRoom->number ?> </span>.
                        </p>
                        <p class="date"> <?= $date ?> </p>
                    </div>
                </div>
                <?php
            } elseif ($type == 'room-notice') {
                // room notice
                $link = "/rentrover/tenant/profile/room-notices";
                ?>
                <div class="notification notification-card <?= $statusClass ?>" onclick="window.location.href='<?= $link ?>'"
                    data-notification-id="<?= $id ?>">
                    <div class="notification-icon">
                        <img src="/rentrover/assets/icons/notifications/room-notice.png" alt="">
                    </div>
                    <div class="notification-details">
                        <p class="note"> Your landlord has a notice. </p>
                        <p class="date"> <?= $date ?> </p>
                    </div>
                </div>
                <?php
            }
            ?>

            <!-- backup notification -->
            <div class="d-none notification notification-card" data-notification-id="">
                <!-- icon -->
                <div class="notification-icon">
                    <img src="/rentrover/assets/icons/notifications/verified.png" alt="">
                </div>

                <!-- details -->
                <div class="notification-details">
                    <!-- detail -->
                    <p class="note"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus, numquam? </p>

                    <!-- date -->
                    <p class="date"> 0000-00-00 00:00:00 </p>
                </div>
            </div>
            <?php
    }
}
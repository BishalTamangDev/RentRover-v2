<?php

require_once __DIR__ . '/../classes/feedback.php';
require_once __DIR__ . '/../classes/user.php';

$tempFeedback = new Feedback();
$tempUser = new User();

$list = $tempFeedback->fetchLatest();

if (sizeof($list) == 0) {
    ?>
    <p class="feedback-user-name"> <?= "No feedback has been submitted yet." ?> </p>
    <?php
} else {
    foreach ($list as $feedback) {
        // fetch user detail
        $tempUser->fetch($feedback['user_id'], "mandatory");
        $username = $tempUser->getFullName();
        $role = ucfirst($tempUser->role);
        $photo = $tempUser->profilePhoto;
        $rating = $feedback['rating'];
        ?>
        <div class="shadow bg-white user-feedback">
            <div class="user-feedback-top">
                <div class="img-div">
                    <img src="/rentrover/uploads/users/<?= $photo ?>" alt="">
                </div>
                <div class="user-details">
                    <p class="feedback-user-name"> <?= $username ?> </p>
                    <p class="feedback-role"> <?= $role ?> </p>
                </div>
            </div>

            <div class="feedback">
                <div class="feedback-detail">
                    <p> "<?= ucfirst($feedback['feedback']) ?>"
                    </p>
                </div>

                <div class="rating-div">
                    <?php
                    for ($i = 0; $i < $rating; $i++) {
                        ?>
                        <img src="/rentrover/assets/icons/full-star.png" alt="">
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>

        <?php
    }
}
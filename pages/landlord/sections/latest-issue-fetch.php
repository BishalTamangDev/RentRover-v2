<?php
$landlordId = $_POST['landlordId'] ?? 0;

if ($landlordId == 0) {
    echo false;
    exit;
}

require_once __DIR__ . '/../../../classes/house.php';
require_once __DIR__ . '/../../../classes/room.php';
require_once __DIR__ . '/../../../classes/user.php';
require_once __DIR__ . '/../../../classes/issue.php';

$tempUser = new User();
$tempRoom = new Room();
$tempIssue = new Issue();
$tempHouse = new House();

$houseList = $tempHouse->fetchHouseIdByLandlordId($landlordId);
$roomList = $tempRoom->fetchAllRoomIdByLandlord($houseList);
$issueList = $tempIssue->fetchIssuesForLanlord($roomList);

// print_r($houseList);
// print_r($roomList);

if (sizeof($issueList) == 0) {
    ?>
    <p class="text-secondary"> No isses has been reported till now. </p>
    <?php
} else {
    foreach ($issueList as $issue) {
        // fetch tenant detail
        $tempUser->fetch($issue['tenant_id'], "mandatory");
        $name = $tempUser->getFullName();
        $roomId = $issue['room_id'];

        $tenantId = $issue['tenant_id'];

        $tempRoom->fetch($roomId);

        $houseId = $tempRoom->houseId;

        $tempHouse->fetch($houseId);

        $location = $tempHouse->getAddress();
        ?>
        <!-- issue -->
        <div class="shadow-sm border issue-div">
            <div class="img-div">
                <img src="/rentrover/uploads/users/<?= $tempUser->profilePhoto ?>" alt="">
            </div>
            <div class="detail-div">
                <p class="name"> <?= $name ?>  </p>
                <p class="house-room">
                        <?= $location." ," ?>
                        <?= $tempRoom->number ?>
                </p>
                <p class="date"> <?=$issue['issued_date']?> </p>

                <div class="feedback">
                    <div class="feedback-detail">
                        <p> "<?= $issue['issue'] ?>" </p>
                    </div>
                </div>

                <!-- action -->
                 <div class="action">
                    <a href="/rentrover/landlord/tenant-detail/<?= $tenantId ?>" class="btn btn-brand"> <i class="fa-solid fa-arrow-up-right-from-square"></i> Show tenant detail </a>
                    <a href="/rentrover/landlord/room-detail/<?= $roomId ?>" class="btn btn-outlined-brand"> <i class="fa-solid fa-arrow-up-right-from-square"></i> Show room detail </a>
                </div>
            </div>
        </div>
        <?php
    }
}
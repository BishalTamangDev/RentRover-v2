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

$totalIssue = sizeof($issueList);
$solvedIssue = 0;
$unsolvedIssue = 0;

foreach ($issueList as $issue) {
    if ($issue['flag'] == 'unsolved') {
        $unsolvedIssue++;
    } else {
        $solvedIssue++;
    }
}
?>

<!-- total issues -->
<div class="card-v2">
    <p class="title"> Number of issues </p>
    <p class="data"> <?= $totalIssue ?> </p>
</div>

<!-- solved issues -->
<div class="card-v2">
    <p class="title"> Solved issues </p>
    <p class="data"> <?= $unsolvedIssue ?> </p>
</div>

<!-- unsolved issues -->
<div class="card-v2">
    <p class="title"> Unsolved issues </p>
    <p class="data"> <?= $solvedIssue ?> </p>
</div>
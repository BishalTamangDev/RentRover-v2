<?php
$landlordId = $_POST['landlordId'] ?? 0;

if ($landlordId == 0) {
    echo "0";
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

$unsolvedIssue = 0;

foreach ($issueList as $issue)
    if ($issue['flag'] == 'unsolved')
        $unsolvedIssue++;

echo $unsolvedIssue;
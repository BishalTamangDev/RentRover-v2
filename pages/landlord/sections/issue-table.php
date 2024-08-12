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

if (sizeof($issueList) > 0) {
    $serial = 1;
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

        $roomNumber = $tempRoom->number;

        $solvedDate = $issue['solved_date'] == "0000-00-00 00:00:00" ? "-" : $issue['solved_date'];

        // filter class
        $stateClass = $issue['flag'] == "solved" ? "solved-row" : "unsolved-row";
        ?>
        <tr class="issue-row <?= $stateClass ?>">
            <th scope="row" class="serial"> <?= $serial++ ?> </th>
            <td>
                <a href="/rentrover/landlord/room-detail/<?= $roomId ?>" class="text-primary">
                    <?= $location . ', ' . $roomNumber ?> </a>
            </td>
            <td>
                <a href="/rentrover/landlord/tenant-detail/<?= $tenantId ?>" class="text-primary"> <?= $name ?> </a>
            </td>
            <td class="text-secondary"> <?= $issue['issued_date'] ?> </td>
            <td class="text-secondary"> <?= $solvedDate ?> </td>
            <td> <?= ucfirst($issue['flag']) ?> </td>
            <td class="action">
                <p class="text-primary pointer small issue-detail-trigger" data-issue-id="<?= $issue['issue_id'] ?>"
                    data-bs-toggle="modal" data-bs-target="#issueModal">
                    Show details </p>
            </td>
        </tr>
        <?php
    }
}
<?php
$landlordId = $_POST['landlordId'];

require_once __DIR__ . '/../../../classes/user.php';
require_once __DIR__ . '/../../../classes/house.php';
require_once __DIR__ . '/../../../classes/room.php';
require_once __DIR__ . '/../../../classes/application.php';

$tempHouse = new House();
$tempUser = new User();
$tempRoom = new Room();
$tempApplication = new Application();

// fetch house
$houseIdList = $tempHouse->fetchHouseIdByLandlordId($landlordId);

// fetch rooms
$roomIdList = $tempRoom->fetchAllRoomIdByLandlord($houseIdList);

// fetch applciation
$applicationList = $tempApplication->fetchApplicationByRoomList($roomIdList);

// set flag of the application as expired

$serial = 1;
foreach ($applicationList as $application) {
    $tempApplication->checkExpired($application['application_id']);

    $roomId = $application['room_id'];
    $tempUser->fetch($application['applicant_id'], "mandatory");
    $applicant = $tempUser->getFullName();
    $tempRoom->fetch($roomId);
    $tempHouse->fetch($tempRoom->houseId);
    $location = $tempHouse->getAddress();
    $rentType = $application['renting_type'];

    // rent type class
    $rentClass = $rentType == 'fixed' ? "rent-fixed" : "rent-not-fixed";
    $status = $application['flag'];

    switch ($status) {
        case 'accepted':
            $statusClass = 'accepted-row';
            break;
        case 'rejected':
            $statusClass = "rejected-row";
            break;
        case 'cancelled':
            $statusClass = "cancelled-row";
            break;
        case 'expired':
            $statusClass = "expired-row";
            break;
        default:
            $statusClass = "pending-row";
    }
    ?>
    <tr class="application-row <?= $rentClass ?> <?= $statusClass ?>">
        <th scope="row" class="serial"> <?= $serial++ ?> </th>
        <td> <?= $location ?> </td>
        <td>
            <a href="/rentrover/landlord/room-detail/<?= $roomId ?>" class="text-primary">
                <?= $tempRoom->number ?>
            </a>
        </td>
        <td> <?= $applicant ?> </td>
        <td> <?= ucwords($rentType) ?> </td>
        <td> <?= $application['move_in_date'] ?> </td>
        <td> <?= $application['move_out_date'] != '0000-00-00' ? $application['move_out_date'] : "-" ?> </td>
        <td> <?= ucfirst($status) ?> </td>
        <td class="small text-secondary"> <?= $application['application_date'] ?> </td>
        <td class="action">
            <p class="small text-primary pointer show-application-detail"
                data-app-id="<?= $application['application_id'] ?>" data-bs-toggle="modal"
                data-bs-target="#applicationModal">
                Show details
            </p>
        </td>
    </tr>
    <?php
}
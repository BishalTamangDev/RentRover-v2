<?php 
require_once __DIR__ . '/../../../classes/user.php';
$userObj = new User();

$userIdList = $userObj->fetchAllUserId();

if(sizeof($userIdList) > 0) {
    $serial = 1;
    foreach($userIdList as $userId) {
        $userObj->fetch($userId, "all");
        ?>
        <tr class='user-row <?="$userObj->role-row"?>'>
            <th scope="row" class="serial"> <?=$serial++;?> </th>
            <td> <?=$userObj->getFullName();?> </td>
            <td> <?=$userObj->getDistrictProvince();?> </td>
            <td> <?=ucfirst($userObj->role);?> </td>
            <td> <?=$userObj->getPhoneNumber();?> </td>
            <td class="small text-secondary"> <?=$userObj->registrationDate;?> </td>
            <td class="action">
                <a href="/rentrover/admin/user-detail/<?=$userId?>" class="text-primary small"> Show details
                </a>
            </td>
        </tr>
        <?php
    }
}
?>

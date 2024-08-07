<?php

if (!isset($_POST['content'])) {
    exit;
}

$content = trim($_POST['content']);
require_once __DIR__ . '/../../../classes/user.php';
$tempUser = new User();

if (!is_null($content)) {
    $searchedUsers = $tempUser->search($content);
    if (sizeof($searchedUsers) > 0) {
        $serial = 1;
        foreach ($searchedUsers as $user) {
            $tempUser->fetch($user['user_id'], "all");
            $role = $user['role'];
            $fullName = ucfirst($user['first_name']) . ' ' . ucfirst($user['last_name']);
            ?>
            <tr class='user-row <?= "$role-row" ?>'>
                <th scope="row" class="serial"> <?= $serial++ ?> </th>
                <td> <?= $fullName ?> </td>
                <td> <?= $user['district'] . ', ' . $user['province'] ?> </td>
                <td> <?= ucfirst($user['role']); ?> </td>
                <td> <?= $user['phone_number']; ?> </td>
                <td class="small text-secondary"> <?= $user['registration_date']; ?> </td>
                <td class="action">
                    <a href="/rentrover/admin/user-detail/<?= $user['user_id'] ?>" class="text-primary small"> Show details
                    </a>
                </td>
            </tr>
            <?php
        }
    }
} else {
    $userIdList = $tempUser->fetchAllUserId();
    $serial = 1;
    foreach ($userIdList as $userId) {
        $tempUser->fetch($userId, "all");
        ?>
        <tr class='user-row <?= "$tempUser->role-row" ?>'>
            <th scope="row" class="serial"> <?= $serial++; ?> </th>
            <td> <?= $tempUser->getFullName(); ?> </td>
            <td> <?= $tempUser->getDistrictProvince(); ?> </td>
            <td> <?= ucfirst($tempUser->role); ?> </td>
            <td> <?= $tempUser->getPhoneNumber(); ?> </td>
            <td class="small text-secondary"> <?= $tempUser->registrationDate; ?> </td>
            <td class="action">
                <a href="/rentrover/admin/user-detail/<?= $userId ?>" class="text-primary small"> Show details
                </a>
            </td>
        </tr>
        <?php
    }
}
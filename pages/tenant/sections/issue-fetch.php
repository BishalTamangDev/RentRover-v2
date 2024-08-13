<?php

$tenantId = $_POST['tenantId'];

if ($tenantId == 0) {
    echo false;
    exit;
}

require_once __DIR__ . '/../../../classes/issue.php';
$tempIssue = new Issue();

$list = $tempIssue->fetchIssueForTenant($tenantId);

if (sizeof($list) == 0) {
    echo false;
} else {
    $serial = 1;
    foreach ($list as $issue) {
        $roomId = $issue['room_id'];
        $solvedDate = $issue['solved_date'] != '0000-00-00 00:00:00' ? $issue['solved_date'] : '-';
        $flagClass = $issue['solved_date'] == '0000-00-00 00:00:00' ? "unsolved-row" : "solved-row"; 
        ?>
        <tr class="issue-row <?=$flagClass?>">
            <td scope="row"> <?=$serial++?> </td>
            <td>
                <a href="/rentrover/tenant/room-detail/<?=$roomId?>" class="text-primary">
                    <?=$issue['room_id']?>
                </a>
            </td>
            <td> <?=$issue['issue']?> </td>
            <td> <?=$issue['issued_date']?> </td>
            <td> <?=$solvedDate?> </td>
            <td> <?=ucfirst($issue['flag'])?> </td>
        </tr>
        <?php
    }
}
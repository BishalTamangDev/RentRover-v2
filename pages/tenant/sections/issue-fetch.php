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
        $solvedDate = $issue['solved_date'] != '0000-00-00 00:00:00' ? $issue['solved_date'] : '-';
        $flagClass = $issue['flag'] == "solved" ? "usolved-row" : "unsolved-row"; 
        ?>
        <tr class="issue-row <?=$flagClass?>">
            <td scope="row"> <?=$serial++?> </td>
            <td>
                <a href="" class="text-primary">
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
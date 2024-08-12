<?php
$issueId = $_POST['issueId'] ?? 0;

if ($issueId == 0) {
    echo false;
    exit;
}

require_once __DIR__ . '/../../../classes/issue.php';

$tempIssue = new Issue();

$status = $tempIssue->solve($issueId);

echo $status;
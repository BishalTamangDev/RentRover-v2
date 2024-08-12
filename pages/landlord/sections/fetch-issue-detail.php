<?php
$issueId = $_POST['issueId'] ?? 0;

if ($issueId == 0) {
    echo false;
    exit;
}

require_once __DIR__ . '/../../../classes/issue.php';

$tempIssue = new Issue();

$found = $tempIssue->fetch($issueId);
?>
<!-- issue -->
<div class="mb-2">
    <?php
    $flag = ucfirst($tempIssue->flag);
    if ($flag == "Solved") {
        ?>
        <p class="m-0 mb-2 fw-semibold text-success"> <?= "$flag Issue" ?> </p>
        <?php
    } else {
        ?>
        <p class="m-0 mb-2 fw-semibold text-danger" id="issue-flag-label"> <?= "$flag Issue" ?> </p>
        <?php
    }
    ?>
    <p class="m-0"> "<?= $tempIssue->issue ?>" </p>
</div>

<!-- issued date -->
<div class="d-flex flex-row gap-2">
    <p class="small text-secondary"> Issued date </p>
    <p class="small fw-semibold"> <?= $tempIssue->date['issued'] ?> </p>
</div>

<!-- solved date -->
<div class="d-flex flex-row gap-2">
    <p class="small text-secondary"> Solved date </p>
    <p class="small fw-semibold"> <?= $tempIssue->date['solved'] ?> </p>
</div>

<!-- action -->
<?php
if ($flag != "Solved") {
    ?>
    <div class="action">
        <button class="btn btn-success solve-issue-btn" data-issue-id="<?=$issueId?>" id="solve-issue-btn"> Mark as Solved </button>
    </div>
    <?php
}
?>
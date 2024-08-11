<?php
$applicationId = $_POST['applicationId'] ?? 0;

require_once __DIR__ . '/../../../classes/application.php';

$tempApplication = new Application();

$status = $tempApplication->reject($applicationId);

echo $status;
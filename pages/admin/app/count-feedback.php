<?php

require_once __DIR__ . '/../../../classes/feedback.php';

$tempFeedback = new Feedback();

$count = $tempFeedback->count();

echo $count;
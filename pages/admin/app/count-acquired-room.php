<?php

require_once __DIR__ . '/../../../classes/room.php';

$tempRoom = new Room();

$count = $tempRoom->countAcquiredRoom();

echo $count;
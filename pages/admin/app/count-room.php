<?php

require_once __DIR__ . '/../../../classes/room.php';

$tempRoom = new Room();

$count = $tempRoom->countAllRoom();

echo $count;
<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

if (!isset($_SESSION['csrf-token']))
    $_SESSION['csrf-token'] = bin2hex(random_bytes(32));

echo $_SESSION['csrf-token'];
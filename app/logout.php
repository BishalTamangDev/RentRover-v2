<?php
if(session_status() == PHP_SESSION_NONE)
    session_start();

unset($_SESSION['rentrover-id']);
unset($_SESSION['rentrover-role']);

header("Location: /rentrover/");
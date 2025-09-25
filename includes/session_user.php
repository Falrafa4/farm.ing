<?php

session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'User') {
    header("Location: " . NM_FOLDER . "/auth/login/");
    exit();
}
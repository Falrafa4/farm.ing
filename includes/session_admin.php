<?php

session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Admin') {
    header("Location: " . NM_FOLDER . "/auth/login/");
    exit();
}
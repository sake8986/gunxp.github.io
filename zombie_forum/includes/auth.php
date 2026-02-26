<?php
if (!isset($_SESSION)) session_start();

function isLoggedIn() {
    return isset($_SESSION['user']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: login.php");
        exit();
    }
}

function isAdmin() {
    return isLoggedIn() && $_SESSION['user']['role'] === 'admin';
}

function isVIP() {
    if (!isLoggedIn()) return false;
    return $_SESSION['user']['vip_until'] && strtotime($_SESSION['user']['vip_until']) > time();
}
?>
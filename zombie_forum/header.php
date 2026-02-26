<?php
require_once 'config.php';
require_once 'includes/auth.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Zombie Plague GunXP Forum</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="header">
    <h1>🧟 Zombie Plague GunXP 24/7</h1>
    <p>IP: 135.125.147.173:27017</p>
</div>

<div class="navbar">
    <a href="index.php">Home</a>
    <?php if(isLoggedIn()): ?>
        <a href="create_thread.php">Create Thread</a>
        <a href="vip.php">VIP</a>
        <a href="logout.php">Logout</a>
        <span class="user-info">
            Welcome, <?= htmlspecialchars($_SESSION['user']['username']); ?>
            <?php if(isVIP()): ?><span class="vip-badge">[VIP]</span><?php endif; ?>
            <?php if(isAdmin()): ?><span class="admin-badge">[ADMIN]</span><?php endif; ?>
        </span>
    <?php else: ?>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    <?php endif; ?>
</div>
<div class="content">
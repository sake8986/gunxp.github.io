<?php
require 'header.php';
requireLogin();
?>

<div class="form-box" style="text-align:center;">
    <h2>Buy VIP</h2>
    <p>Want VIP perks for your Zombie Plague GunXP experience?</p>

    <div style="background:#111; border:1px solid #8B0000; padding:15px; border-radius:10px; margin-top:20px;">
        <h3 style="color:#39FF14;">💰 PayPal</h3>
        <p>Send your VIP payment to:</p>
        <p style="color:#ff4c4c; font-weight:bold;">yourpaypal@example.com</p>
        <p>Include your <b>username</b> in the payment note!</p>
    </div>

    <div style="background:#111; border:1px solid #8B0000; padding:15px; border-radius:10px; margin-top:20px;">
        <h3 style="color:#39FF14;">💬 Discord</h3>
        <p>After payment, contact us on Discord to confirm VIP:</p>
        <p style="color:#ff4c4c; font-weight:bold;">YourDiscord#1234</p>
    </div>

    <p style="margin-top:20px; color:#ccc;">Once verified, your account will be upgraded to VIP.</p>
</div>

<?php require 'footer.php'; ?>
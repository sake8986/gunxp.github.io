<?php
require 'header.php';
require_once 'includes/auth.php';

if ($_POST) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("SELECT id FROM users WHERE username=?");
    $stmt->execute([$username]);
    if ($stmt->rowCount() > 0) {
        $error = "Username already taken!";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username,email,password) VALUES (?,?,?)");
        $stmt->execute([$username, $email, $password]);
        $success = "Account created! You can now <a href='login.php' style='color:#39FF14;'>login</a>.";
    }
}
?>
<div class="form-box">
    <h2>Register New Account</h2>

    <?php if(isset($error)) echo "<p style='color:#ff4c4c; font-weight:bold;'>$error</p>"; ?>
    <?php if(isset($success)) echo "<p style='color:gold; font-weight:bold;'>$success</p>"; ?>

    <form method="POST">
        <input name="username" placeholder="Username" required>
        <input name="email" type="email" placeholder="Email" required>
        <input name="password" type="password" placeholder="Password" required>
        <button>Register</button>
    </form>

    <p style="margin-top:10px; color:#ccc;">
        Already have an account? 
        <a href="login.php" style="color:#39FF14; font-weight:bold;">Login here</a>
    </p>
</div>
<?php require 'footer.php'; ?>
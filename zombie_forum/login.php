<?php
require 'header.php';
require_once 'includes/auth.php';

if ($_POST) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>
<div class="form-box">
    <h2>Login to Your Account</h2>

    <?php if(isset($error)) echo "<p style='color:#ff4c4c; font-weight:bold;'>$error</p>"; ?>

    <form method="POST">
        <input name="username" placeholder="Username" required>
        <input name="password" type="password" placeholder="Password" required>
        <button>Login</button>
    </form>

    <p style="margin-top:10px; color:#ccc;">
        Don't have an account? 
        <a href="register.php" style="color:#39FF14; font-weight:bold;">Register here</a>
    </p>
</div>
<?php require 'footer.php'; ?>
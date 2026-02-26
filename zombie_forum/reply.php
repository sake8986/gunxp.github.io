<?php
require 'header.php';
require_once 'includes/auth.php';
requireLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $thread_id = $_POST['thread_id'];
    $content = trim($_POST['content']);

    if (!empty($content)) {
        try {
            $stmt = $conn->prepare("INSERT INTO replies (thread_id, user_id, content) VALUES (?,?,?)");
            $stmt->execute([$thread_id, $_SESSION['user']['id'], $content]);
            header("Location: thread.php?id=" . $thread_id);
            exit();
        } catch(PDOException $e) {
            echo "<div class='form-box' style='color:#ff4c4c;'>Error posting reply: " . $e->getMessage() . "</div>";
        }
    } else {
        echo "<div class='form-box' style='color:#ff4c4c;'>Reply cannot be empty!</div>";
    }
} else {
    echo "<div class='form-box' style='color:#ff4c4c;'>Invalid request method!</div>";
}

require 'footer.php';
?>
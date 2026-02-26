<?php
require 'header.php';
requireLogin();

if ($_POST) {
    $stmt = $conn->prepare("INSERT INTO threads (user_id,title,content) VALUES (?,?,?)");
    $stmt->execute([$_SESSION['user']['id'], $_POST['title'], $_POST['content']]);
    header("Location: index.php");
    exit();
}
?>
<div class="form-box">
    <h2>Create a New Thread</h2>
    <form method="POST">
        <input name="title" placeholder="Thread Title" required>
        <textarea name="content" placeholder="Write your post here..." rows="6" required></textarea>
        <button>Create Thread</button>
    </form>
</div>
<?php require 'footer.php'; ?>
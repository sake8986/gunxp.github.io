<?php
require 'header.php';
require_once 'includes/auth.php';

requireLogin(); // Only logged-in users can view threads (optional, remove if guests allowed)

$id = $_GET['id'] ?? 0;

// Fetch thread
$stmt = $conn->prepare("
    SELECT threads.*, users.username 
    FROM threads 
    JOIN users ON threads.user_id = users.id 
    WHERE threads.id=?
");
$stmt->execute([$id]);
$thread = $stmt->fetch();

if (!$thread) {
    echo "<div class='form-box' style='color:#ff4c4c;'>Thread not found!</div>";
    require 'footer.php';
    exit();
}

// Increment views only once per user
if (isLoggedIn()) {
    $stmtCheck = $conn->prepare("SELECT id FROM thread_views WHERE thread_id=? AND user_id=?");
    $stmtCheck->execute([$id, $_SESSION['user']['id']]);
    if ($stmtCheck->rowCount() === 0) {
        $stmtInsert = $conn->prepare("INSERT INTO thread_views (thread_id, user_id) VALUES (?,?)");
        $stmtInsert->execute([$id, $_SESSION['user']['id']]);
        $conn->prepare("UPDATE threads SET views = views + 1 WHERE id=?")->execute([$id]);
    }
}

// Count replies
$stmtReplyCount = $conn->prepare("SELECT COUNT(*) FROM replies WHERE thread_id=?");
$stmtReplyCount->execute([$id]);
$reply_count = $stmtReplyCount->fetchColumn();
?>

<div class="thread-box">
    <h2><?= htmlspecialchars($thread['title']); ?></h2>
    <p><b><?= htmlspecialchars($thread['username']); ?></b> posted on <?= $thread['created_at']; ?></p>
    <p style="color:#39FF14; font-weight:bold;">
        🧟 Replies: <?= $reply_count; ?> | 👀 Views: <?= $thread['views']; ?>
    </p>
    <hr>
    <p><?= nl2br(htmlspecialchars($thread['content'])); ?></p>
</div>

<h3 style="color:#39FF14;">Replies</h3>

<?php
$stmtReplies = $conn->prepare("
    SELECT replies.*, users.username 
    FROM replies 
    JOIN users ON replies.user_id = users.id 
    WHERE thread_id=? 
    ORDER BY created_at ASC
");
$stmtReplies->execute([$id]);
$replies = $stmtReplies->fetchAll();

if ($replies):
    foreach ($replies as $reply):
?>
<div class="reply-box">
    <h4><?= htmlspecialchars($reply['username']); ?> says:</h4>
    <p><?= nl2br(htmlspecialchars($reply['content'])); ?></p>
    <small><?= $reply['created_at']; ?></small>
</div>
<?php
    endforeach;
else:
    echo "<p style='color:#ccc;'>No replies yet. Be the first to reply!</p>";
endif;
?>

<?php if(isLoggedIn()): ?>
<div class="form-box">
    <h3>Post a Reply</h3>
    <form method="POST" action="reply.php">
        <input type="hidden" name="thread_id" value="<?= $thread['id']; ?>">
        <textarea name="content" placeholder="Write your reply..." rows="4" required></textarea>
        <button>Reply</button>
    </form>
</div>
<?php else: ?>
<p style="color:#ccc;">Please <a href="login.php">login</a> to reply.</p>
<?php endif; ?>

<?php require 'footer.php'; ?>
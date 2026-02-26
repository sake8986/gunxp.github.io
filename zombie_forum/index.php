<?php
require 'header.php';

$stmt = $conn->query("
    SELECT t.*, u.username, 
        (SELECT COUNT(*) FROM replies r WHERE r.thread_id = t.id) AS reply_count
    FROM threads t
    JOIN users u ON t.user_id = u.id
    ORDER BY t.created_at DESC
");
?>

<h2>Latest Threads</h2>
<?php foreach ($stmt as $thread): ?>
<div class="thread-box">
    <h3><a href="thread.php?id=<?= $thread['id']; ?>"><?= htmlspecialchars($thread['title']); ?></a></h3>
    <p>Posted by <?= htmlspecialchars($thread['username']); ?> on <?= $thread['created_at']; ?></p>
    <p style="color:#39FF14; font-weight:bold;">
        🧟 Replies: <?= $thread['reply_count']; ?> | 👀 Views: <?= $thread['views']; ?>
    </p>
</div>
<?php endforeach; ?>

<?php require 'footer.php'; ?>
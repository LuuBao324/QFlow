
<h2><?= htmlspecialchars($question['title']) ?></h2>
<p>Posted by <?= htmlspecialchars($question['username']) ?> on <?= $question['created_at'] ?></p>
<p><?= nl2br(htmlspecialchars($question['content'])) ?></p>

<h3>Comments</h3>
<form action="" method="POST">
    <textarea name="content" placeholder="Add a comment..." required></textarea>
    <button type="submit">Post Comment</button>
</form>

<div class="comments">
    <?php foreach ($comments as $comment): ?>
        <div class="comment">
            <p><strong><?= htmlspecialchars($comment['username']) ?>:</strong> <?= nl2br(htmlspecialchars($comment['content'])) ?></p>
        </div>
    <?php endforeach; ?>
</div>
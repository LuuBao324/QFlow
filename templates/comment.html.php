
<div class="container">
<div class="question">
                <div class="question-header">
                    <div class="user-info">
                        <img src="assets/account.png" alt="" style="width:35px;" >
                        <div class="user-detail">
                            <span class="username"><?= htmlspecialchars($question['username']) ?></span>
                            <span class="timestamp"><?= $question['created_at'] ?></span>
                        </div>
                    </div>
                </div>
                
                <h3><?= htmlspecialchars($question['title']) ?></h3>
                
                <p class="question-content">
                    <?= htmlspecialchars(substr($question['content'], 0, 1500)) ?>
                </p>
                
                <?php if (!empty($question['image'])): ?>
                    <img 
                        src="<?= htmlspecialchars($question['image']) ?>" 
                        alt="Question Image" 
                        class="question-image"
                    >
                <?php endif; ?>
</div>

<div class="comments-section">
    <h3 class="comments-title">Comments</h3>
    
    <form class="comment-form" action="" method="POST">
        <textarea name="content" placeholder="Add a comment..." required></textarea>
        <button type="submit" class="submit-btn">Post Comment</button>
    </form>

    <div class="comments-list">
        <?php foreach ($comments as $comment): ?>
            <div class="comment">
                <div class="comment-header">
                    <img src="assets/account.png" alt="account image">
                    <span class="comment-username"><?= htmlspecialchars($comment['username']) ?>:</span>
                </div>
                <div class="comment-body">
                    <?= nl2br(htmlspecialchars($comment['content'])) ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</div>

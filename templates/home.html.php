


<!-- <h2>Recent Questions</h2> -->
<section id="questions">
    <?php foreach ($questions as $question): ?>
        <div class="question">
            <div class="question-header">
                <i class="fa-solid fa-user"></i>
                <span><?= htmlspecialchars($question['username']) ?> | <?= $question['created_at'] ?></span>
            </div>
            
            <h3>
                <a href="question.php?id=<?= $question['id'] ?>">
                    <?= htmlspecialchars($question['title']) ?>
                </a>
            </h3>
            
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
            
            <div class="question-actions">
                <form action="edit_question.php" method="GET">
                    <input type="hidden" name="id" value="<?= $question['id'] ?>">
                    <button type="submit" class="edit">Edit</button>
                </form>

                <form action="delete_question.php" method="POST">
                    <input type="hidden" name="id" value="<?= $question['id'] ?>">
                    <button type="submit" class="delete">Delete</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</section>
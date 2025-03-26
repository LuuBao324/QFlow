
<h2>Search Results for "<?= htmlspecialchars($query) ?>"</h2>
<section id="questions">
    <?php if (isset($questions) && count($questions) > 0): ?>
        <?php foreach ($questions as $question): ?>
            <div class="question">
                <h3><a href="question.php?id=<?= $question['id'] ?>"><?= htmlspecialchars($question['title']) ?></a></h3>
                <p>Posted by <?= htmlspecialchars($question['username']) ?> on <?= $question['created_at'] ?></p>
                <p><?= htmlspecialchars(substr($question['content'], 0, 100)) ?>...</p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No results found.</p>
    <?php endif; ?>
</section>
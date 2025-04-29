<div class="left-side-bar">
    <div class="filter-content">
        <h3>Modules</h3>
        <form action="filterModule.php" method="POST">
            <div class="module-filters">
            <?php if (isset($modules) && is_array($modules)): ?>
            <?php foreach($modules as $module): ?>
                <div class="module-filter-item">
                    <input 
                        type="checkbox" 
                        id="module_<?= $module['id'] ?>" 
                        name="modules[]" 
                        value="<?= $module['id'] ?>"
                        <?= (isset($_SESSION['selected_modules']) && in_array($module['id'], $_SESSION['selected_modules'])) ? 'checked' : '' ?>
                    >
                    <label for="module_<?= $module['id'] ?>">
                        <?= htmlspecialchars($module['moduleName']) ?>
                    </label>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No modules to display</p>
        <?php endif; ?>
            <button type="submit" class="filter-button">Apply Filter</button>
            </div>
        </form>
    </div>
</div>

<div class="content-container">        
<section id="questions">
    <?php if (!empty($questions)): ?>
        <?php foreach ($questions as $question): ?>
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
                
                <h3><?= htmlspecialchars($question['title'])?></h3>
                
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

                <button class="comment-btn"><a href="comment.php?id=<?= $question['id'] ?>">Comment</a></button>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="no-questions">
            <p>No questions found for the selected modules.</p>
        </div>
    <?php endif; ?>
</section>
</div>
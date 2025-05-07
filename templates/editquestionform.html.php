<div class="edit-question">
<div class="edit-box">

<h2>Edit Question</h2>
<form action="" method="POST" enctype="multipart/form-data">
    <input type="text" name="title" value="<?= htmlspecialchars($question['title']) ?>" required>
    <textarea name="content" required><?= htmlspecialchars($question['content']) ?></textarea>
    <select name="module_id" required>
        <option value="">Select a module</option>
        <?php foreach($modules as $module): ?>
            <option value="<?=htmlspecialchars($module['id'], ENT_QUOTES, 'UTF-8')?>" 
                <?= $module['id'] == $question['module_id'] ? 'selected' : '' ?>>
                <?=htmlspecialchars($module['moduleName'], ENT_QUOTES, 'UTF-8')?>
            </option>
        <?php endforeach; ?>
    </select>
    <label for="">Current image</label>
    <?php if (!empty($question['image'])): ?>
        <img src="<?= htmlspecialchars($question['image']) ?>" alt="Question Image" style="max-width: 50vh; height: auto;">
    <?php endif; ?>
    <label for="">Choose new image (Optional)</label>
    <input type="file" name="image">
    <button type="submit">Update Question</button>
</form>
</div>
</div>
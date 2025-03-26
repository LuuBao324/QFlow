<h2>Edit Question</h2>
<form action="" method="POST" enctype="multipart/form-data">
    <input type="text" name="title" value="<?= htmlspecialchars($question['title']) ?>" required>
    <textarea name="content" required><?= htmlspecialchars($question['content']) ?></textarea>
    <select name="module_id" required>
        <!-- <?php
        $categories = $pdo->query("SELECT * FROM module");
        while ($row = $categories->fetch()) {
            $selected = $row['id'] == $question['module'] ? 'selected' : '';
            echo "<option value='{$row['id']}' $selected>" . htmlspecialchars($row['name']) . "</option>";
        }
        ?> -->
        <option value="">Select a module</option>
        <?php foreach($modules as $module): ?>
            <option value="<?=htmlspecialchars($module['id'], ENT_QUOTES, 'UTF-8')?>"><?=htmlspecialchars($module['moduleName'], ENT_QUOTES, 'UTF-8')?></option>
        <?php endforeach; ?>
    </select>
    <!-- <?php if (!empty($question['image'])): ?>
        <img src="<?= htmlspecialchars($question['image']) ?>" alt="Question Image" style="max-width: 100%; height: auto;">
    <?php endif; ?> -->
    <input type="file" name="image">
    <button type="submit">Update Question</button>
</form>
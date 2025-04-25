<div class="post-question">
<div class="post-box">
<h2>Post a Question</h2>
<form action="" method="POST" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Question Title" required>
    <textarea name="content" placeholder="Question Content" required></textarea>
    <select name="module_id" required>
        <option value="">Select a module</option>
        <?php foreach($modules as $module): ?>
            <option value="<?=htmlspecialchars($module['id'], ENT_QUOTES, 'UTF-8')?>">
                <?=htmlspecialchars($module['moduleName'], ENT_QUOTES, 'UTF-8')?>
            </option>
        <?php endforeach; ?>
    </select>
    <input type="file" name="image">
    <button type="submit">Post Question</button>
</form>

</div>
</div>
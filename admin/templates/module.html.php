<div class="container" style="margin: 20px auto; ">
<div class="add-module" style="padding: 10px;">
    <form action="module.php" method="POST">
        <div class="input-group mb-3">
            <input type="text" name="moduleName" class="form-control" placeholder="Enter a module" aria-label="Recipient's username" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-success" type="submit">Add module</button>
            </div>
        </div>
    </form>
</div>

<div class="card" style="width: 100%">
<div class="module-table">
    <h2>Module Management</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Module name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($modules as $module): ?>
            <tr>
                <td><?=htmlspecialchars($module['moduleName'], ENT_QUOTES, 'UTF-8')?></td>
                <td><a href="deleteModule.php?id=<?=$module['id']?>" class="btn btn-warning">Delete</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>
</div>
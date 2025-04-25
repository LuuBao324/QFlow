<div class="UserManagement">
        <h2>User Management</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $user): ?>
                    <tr>
                        <td><?=htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8')?></td>
                        <td><?=htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8')?></td>
                        <td><?=htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8')?></td>
                        <td><?=htmlspecialchars($user['role'], ENT_QUOTES, 'UTF-8')?></td>
                        <td><?=htmlspecialchars($user['status'], ENT_QUOTES, 'UTF-8')?></td>
                        <td><a href="editUser.php?id=<?=$user['id']?>" class="btn btn-primary">Edit</a>
                            <?php if($user['status'] === 'active'): ?>
                                <a href="disableUser.php?id=<?=$user['id']?>" class="btn btn-warning">Disable</a>
                            <?php else: ?>
                                <a href="enableUser.php?id=<?=$user['id']?>" class="btn btn-success">Enable</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>    
            </tbody>
        </table>
        
    </div>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Area</title>
</head>
<body>
    
    <div class="UserManagement">
        <table>
            <thead>
                <tr>
                    <th>User_ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
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
                    </tr>
                <?php endforeach; ?>    
            </tbody>
        </table>
        
    </div>
</body>
</html>
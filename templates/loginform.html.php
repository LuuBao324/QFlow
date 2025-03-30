<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/login.css">
    <title>Login</title>
</head>
<body>
    <div class="glass-container">
        
        <div class="login-box">
            <h2>Login</h2>
            <form id="login" action="" method="POST">
                <!-- <label for="username"><b>Username</b></label> -->
                <input type="text" placeholder="Enter Username" name="username" required>

                <!-- <label for="password"><b>Password</b></label> -->
                <input type="password" placeholder="Enter Password" name="password" required>
                
                <?php if (!empty($login_error)): ?>
                    <div class="error"><?php echo htmlspecialchars($login_error); ?></div>
                <?php endif; ?>

                <button id="login" type="submit">Login</button>
                <p>Don't have an account? <a href="register.php" id="register">Register</a></p>
                <a href="../admin/admin_login.html.php">Admin login</a>
            </form>  
        </div>
    </div>
</body>
</html>

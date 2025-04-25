<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/login.css">
    <title>Admin Login</title>
</head>
<body>
    <div class="glass-container">
        
        <div class="login-box">
            <h2>Admin Login</h2>
            <form id="login" action="" method="POST">
                <!-- <label for="username"><b>Username</b></label> -->
                <input type="text" placeholder="Enter Username" name="username" required>

                <!-- <label for="password"><b>Password</b></label> -->
                <input type="password" placeholder="Enter Password" name="password" required>
                
                <?php if (!empty($login_error)): ?>
                    <div class="error"><?php echo htmlspecialchars($login_error); ?></div>
                <?php endif; ?>

                <button id="login" type="submit">Login</button>
                <!-- <p>Register an account? <a href="../auth/admin_register.php" id="register">Register</a></p> -->
                <a href="../../login.php">Back to user login</a>
            </form>  
        </div>
    </div>
</body>
</html>
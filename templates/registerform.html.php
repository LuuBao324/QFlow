<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="style/login.css">
</head>
<body>
    <div class="glass-container">
        <div class="login-box">
            <h2>Sign up</h2>
            <form action="" method="POST">
                
                    <input type="text" name="username" placeholder="Username" required>
                    <?php if (isset($errors['username'])): ?>
                        <div class="field-error"><?php echo htmlspecialchars($errors['username']); ?></div>
                    <?php endif; ?>
                
                
                
                    <input type="email" name="email" placeholder="Email" required>
                    <?php if (isset($errors['email'])): ?>
                        <div class="field-error"><?php echo htmlspecialchars($errors['email']); ?></div>
                    <?php endif; ?>
                
                
                
                    <input type="password" name="password" placeholder="Password" required>
                    <?php if (isset($errors['password'])): ?>
                        <div class="field-error"><?php echo htmlspecialchars($errors['password']); ?></div>
                    <?php endif; ?>
               
                
                
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                    <?php if (isset($errors['confirm_password'])): ?>
                        <div class="field-error"><?php echo htmlspecialchars($errors['confirm_password']); ?></div>
                    <?php endif; ?>
                
                
                <?php if (!empty($signup_error)): ?>
                    <div class="error"><?php echo htmlspecialchars($signup_error); ?></div>
                <?php endif; ?>
                
                <button type="submit">Sign up</button>
                <p>Already have an account? <a href="login.php" id="register">Login</a></p>
            </form>
        </div>
    </div>
</body>
</html>
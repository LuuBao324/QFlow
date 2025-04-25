
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <!-- <link rel="stylesheet" href="style/commentpage.css"> -->
    <title>QFlow</title>
</head>
<body>
    <header>
        <nav>
            <div class="nav-left">
                <div class="logo">
                    <a href="index.php"><img src="assets/logo.jpg" alt=""></a>
                </div>
                <div class="nav-search">
                    <div class="search-icon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <div>
                        <input type="text" placeholder="Search">
                    </div>
                </div>
            </div>
            <div class="nav-right">
            <?php if (isLoggedIn()): ?>
                <a href="index.php">Home</a>
                <a href="post_question.php">Post</a>
                <a href="contact.php">Contact Us</a>
                <a href="logout.php">Logout</a>
                <!-- <a href="admin/auth/admin_login.php">Admin</a> -->
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
                <a href="contact.php">Contact Us</a>
                <a href="admin/auth/admin_login.php">Admin</a>
            <?php endif; ?>
            </div>
        </nav>
    </header>
    <main>
        <?php echo $output; ?>
    </main>
    <footer>
        <p>&copy; 2025 Q&A Platform</p>
    </footer>
    
</body>
</html>
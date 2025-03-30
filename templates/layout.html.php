
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>QFlow</title>
</head>
<body>
    <header>
        <nav>
            <div class="nav-left">
                <div class="logo">
                    <img src="assets/logo.jpg" alt="">
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
                <a href="admin/users.php">Admin</a>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
                <a href="contact.php">Contact Us</a>
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
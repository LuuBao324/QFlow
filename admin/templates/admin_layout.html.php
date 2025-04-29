<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Admin Area</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color: #fff">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php"><img src="../assets/logo.jpg" alt="logo" width="100%" height="50px"></a>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <a class="nav-item nav-link px-3 active" aria-current="page" href="index.php">Home</a>
                    <a class="nav-item nav-link px-3" href="module.php">Module</a>
                    <a class="nav-item nav-link px-3" href="auth/admin_register.php">Register</a>
                    <a class="nav-item nav-link px-3" href="auth/logout.php" style="float: right">Log out</a>
                </div>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <?=$output?>
    </main>
</body>
</html>
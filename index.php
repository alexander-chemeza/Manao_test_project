<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manao test task</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <header>
        <div class="logo">
            <a class="btn" id="btn-homepage" href="/">Manao test task</a>
        </div>
        <?php if (!isset($_SESSION['user'])) : ?>
            <div class="control">
                <a class="btn" id="btn-registration" href="/pages/register.php">Register</a>
                <a class="btn" id="btn-authentification" href="/pages/login.php">Login</a>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['user'])) : ?>
            <div class="control">
                <a class="btn" href="/pages/account.php"><?php echo $_SESSION['user']; ?></a>
                <a class="btn" href="?logout">Log out</a>
            </div>
        <?php endif; ?>
    </header>
    <main class="container">
        <div class="box" id="homepage">
            <h1>Hello, Manao test project</h1>
        </div>
    </main>
</body>
</html>
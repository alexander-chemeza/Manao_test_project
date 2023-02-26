<?php
session_start();
if(!isset($_SESSION['user'])){
    header("location: /pages/login.php");	exit();
}

if(isset($_GET['logout'])){
    unset($_SESSION['user']);
    header("location: /index.php");	exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>User account</title>
</head>
<body>
    <header>
        <div class="logo">
            <a class="btn btn-transparent" href="/">Manao test project</a>
        </div>
        <div class="control">
            <a class="btn btn-green" href="/pages/account.php"><?php echo $_SESSION['user']; ?></a>
            <a class="btn btn-red" href="?logout">Log out</a>
        </div>
    </header>
    <main class="container">
        <div class="box" id="homepage">
            <h1>Hello, <?php echo $_SESSION['user']; ?></h1>
        </div>
    </main>
</body>
</html>
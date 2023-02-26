<?php require("../scripts/login.class.php") ?>
<?php
if(isset($_POST['submit'])){
    $user = new LoginUser($_POST['username'], $_POST['password']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manao test project</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <div class="logo">
            <a class="btn btn-transparent" href="/">Manao test project</a>
        </div>
        <div class="control">
            <a class="btn btn-green" href="/pages/register.php">Register</a>
            <a class="btn btn-green-white" href="/pages/login.php">Login</a>
        </div>
    </header>
    <main class="container">
        <div class="box" id="authentification">
            <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
                <h2>Log in</h2>

                <input type="text" name="username" placeholder="Login">

                <input type="password" name="password" placeholder="Password">

                <button type="submit" name="submit">Log in</button>

                <p class="error"><?php echo @$user->error ?></p>
                <p class="success"><?php echo @$user->success ?></p>
            </form>
        </div>
    </main>
</body>
</html>
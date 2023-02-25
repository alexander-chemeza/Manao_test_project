<?php require("../scripts/register.class.php") ?>
<?php
	if(isset($_POST['submit'])){
		$user = new RegisterUser($_POST['login'], $_POST['password'], $_POST['confirm_password'], $_POST['email'], $_POST['name']);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manao test task</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <div class="logo">
            <a class="btn" id="btn-homepage" href="/">Manao test project</a>
        </div>
        <div class="control">
            <a class="btn" id="btn-registration" href="/pages/register.php">Register</a>
            <a class="btn" id="btn-authentification" href="/pages/login.php">Login</a>
        </div>
    </header>
    <main class="container">
        <div class="box" id="registration">
            <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
                <h2>Registration</h2>

                <input type="text" name="login" placeholder="Login">

                <input type="password" name="password" placeholder="Password">

                <input type="password" name="confirm_password" placeholder="Confirm password">

                <input type="email" name="email" placeholder="Email">

                <input type="text" name="name" placeholder="Name">

                <button type="submit" name="submit">Register</button>

                <p class="error"><?php echo @$user->error ?></p>
                <p class="success"><?php echo @$user->success ?></p>
            </form>
        </div>
    </main>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Login User</title>
</head>
<body>

<h1>LOGIN USER</h1>

<form method="post" action="<?= base_url('proses-login-user') ?>">

    <input type="text" name="username" placeholder="Username">

    <br><br>

    <input type="password" name="password" placeholder="Password">

    <br><br>

    <button type="submit">
        Login
    </button>

</form>

</body>
</html>
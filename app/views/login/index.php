<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body {
            font: 14px sans-serif;
        }

        .wrapper {
            width: 350px;
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-4"  style="float: none; margin: 0 auto;">
    <h2>Login</h2>
    <p>Please fill in your credentials to login.</p>
    <form action="<?php Utility::sanitiseOutput(Utility::getNewPath('Login/process')); ?>" method="post">
        <div class="form-group <?php echo !empty($data['login']->userNameErr) ? 'has-error' : ''; ?>">
            <label>Username</label>
            <input type="text" name="username" class="form-control"
                   value="<?php isset($data['login']->userName) ? Utility::sanitiseOutput($data['login']->userName) : ''; ?>">
            <span class="help-block"><?php isset($data['login']->userNameErr) ? Utility::sanitiseOutput($data['login']->userNameErr) : ''; ?></span>
        </div>
        <div class="form-group <?php echo !empty($data['login']->passwordErr) ? 'has-error' : ''; ?>">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
            <span class="help-block"><?php isset($data['login']->passwordErr) ? Utility::sanitiseOutput($data['login']->passwordErr) : ''; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Login">
        </div>
        <p>Don't have an account? <a href="<?php echo Utility::getNewPath('SignUp/') ?>">Sign up now</a>.</p>
    </form>
        </div>
    </div>
</div>
</body>
</html>
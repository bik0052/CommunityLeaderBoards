<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
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
    <h2>Sign Up</h2>
    <p>Please fill this form to create an account.</p>
    <form action="<?php Utility::sanitiseOutput(Utility::getNewPath('SignUp/process')) ?>" method="post">
        <div class="form-group <?php echo !empty($data['signUp']->firstNameErr) ? 'has-error' : ''; ?>">
            <label>First Name</label>
            <input type="text" name="firstName" class="form-control" value="<?php isset($data['signUp']->firstName) ?
                Utility::sanitiseOutput($data['signUp']->firstName) : '' ?>">
            <span class="help-block">
                <?php !empty($data['signUp']->firstNameErr) ? Utility::sanitiseOutput($data['signUp']->firstNameErr) : ''; ?>
            </span>
        </div>
        <div class="form-group <?php echo !empty($data['signUp']->lastNameErr) ? 'has-error' : ''; ?>">
            <label>Last Name</label>
            <input type="text" name="lastName" class="form-control" value="<?php isset($data['signUp']->lastName) ?
                Utility::sanitiseOutput($data['signUp']->lastName) : '' ?>">
            <span class="help-block">
                <?php !empty($data['signUp']->lastNameErr) ? Utility::sanitiseOutput($data['signUp']->lastNameErr) : ''; ?>
            </span>
        </div>
        <div class="form-group <?php echo !empty($data['signUp']->emailErr) ? 'has-error' : ''; ?>">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?php isset($data['signUp']->email) ?
                Utility::sanitiseOutput($data['signUp']->email) : '' ?>">
            <span class="help-block">
                <?php !empty($data['signUp']->emailErr) ? Utility::sanitiseOutput($data['signUp']->emailErr) : ''; ?>
            </span>
        </div>
        <div class="form-group">
            <label>Gender</label>
            <select name="gender" class="form-control">
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>
        <div class="form-group <?php echo !empty($data['signUp']->countryErr) ? 'has-error' : ''; ?>">
            <label>Country</label>
            <input type="text" name="country" class="form-control" value="<?php isset($data['signUp']->country) ?
                Utility::sanitiseOutput($data['signUp']->country) : '' ?>">
            <span class="help-block">
                <?php !empty($data['signUp']->countryErr) ? Utility::sanitiseOutput($data['signUp']->countryErr) : ''; ?>
            </span>
        </div>
        <div class="form-group <?php echo !empty($data['signUp']->usernameErr) ? 'has-error' : ''; ?>">
            <label>Username</label>
            <input type="text" name="username" class="form-control" maxlength="18" value="<?php isset($data['signUp']->username) ?
                Utility::sanitiseOutput($data['signUp']->username) : '' ?>">
            <span class="help-block">
                <?php !empty($data['signUp']->usernameErr) ? Utility::sanitiseOutput($data['signUp']->usernameErr) : ''; ?>
            </span>
        </div>
        <div class="form-group <?php echo !empty($data['signUp']->passwordErr) ? 'has-error' : ''; ?>">
            <label>Password</label>
            <input type="password" name="password" class="form-control" value="<?php isset($data['signUp']->password) ?
                Utility::sanitiseOutput($data['signUp']->password) : '' ?>">
            <span class="help-block">
                <?php !empty($data['signUp']->passwordErr) ? Utility::sanitiseOutput($data['signUp']->passwordErr) : ''; ?>
            </span>
        </div>
        <div class="form-group <?php echo !empty($data['signUp']->confirmPasswordErr) ? 'has-error' : ''; ?>">
            <label>Confirm Password</label>
            <input type="password" name="confirmPassword" class="form-control"
                   value="<?php isset($data['signUp']->confirmPassword) ?
                       Utility::sanitiseOutput($data['signUp']->confirmPassword) : '' ?>">
            <span class="help-block">
                <?php !empty($data['signUp']->confirmPasswordErr) ? Utility::sanitiseOutput($data['signUp']->confirmPasswordErr) : ''; ?>
            </span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
            <input type="reset" class="btn btn-default" value="Reset">
        </div>
        <p>Already have an account? <a href="<?php echo Utility::getNewPath('Login/'); ?>">Login here</a>.</p>
    </form>
    </div>
</div>
</div>
</body>
</html>
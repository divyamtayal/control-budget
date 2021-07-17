<?php
    include './includes/common.php';
    if(isset($_SESSION['email']))
        header ('location:home.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        include './includes/bootstrap.php';
    ?>
    <!-- external css -->
    <link rel="stylesheet" href="css/style.css" />
    <title>Ct&#8377l Budgett</title>

</head>

<body>
    <?php
        include './includes/header.php';
    ?>
    <div class="container offset">
        <div class="col-xs-12  col-sm-6 col-sm-offset-3">
            <div class="panel">
                <div class="panel-heading panel-my-border">
                    <center>
                        <h4>Login</h4>
                    </center>
                </div>
                <div class="panel-body">
                    <form action="login_script.php" method="POST">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" placeholder="Email" id="email"
                                   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required name="email"/>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" placeholder="Password" id="password"
                                   minlength="6" required name="password"/>
                        </div>
                        <button class="btn btn-solid-my btn-block">Login</button>
                    </form>
                </div>
                <div class="panel-footer">
                    <div>Don't have an account?<a href="signup.php" class="btn btn-my-link">Click here to Sign Up</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        include './includes/footer.php';
    ?>
</body>

</html>
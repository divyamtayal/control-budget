<?php
    include './includes/common.php';
    if(isset($_SESSION['email'])){
            header('location:home.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        include './includes/bootstrap.php';
    ?>
    <!-- external css -->
    <link rel="stylesheet" href="css/style.css" />
    <title>Ct&#8377l Budget</title>

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
                        <h4>Sign Up</h4>
                    </center>
                </div>
                <div class="panel-body">
                    <form action="signup_script.php" method="POST">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" placeholder="Name" id="name" required name="name"/>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" placeholder="Enter Valid Email" id="email"
                                   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required name="email"/>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" placeholder="Password (min. 6 character)"
                                   id="password" minlength="6" required name="password"/>
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Phone Number:</label>
                            <input type="text" class="form-control"
                                   placeholder="Enter Valid Phone Number (Ex. 8448444853)" id="phone_number"
                                   required name="phone"/>
                        </div>
                        <button class="btn btn-solid-my btn-block">Sign Up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
        include './includes/footer.php';
    ?>
</body>

</html>
<?php
    include './includes/common.php';
    if(!isset($_SESSION['email']))
        {
        header ('location:index.php');
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
                        <h4>Change Password</h4>
                    </center>
                </div>
                <div class="panel-body">
                    <form action="change_password_script.php" method="POST">
                        <div class="form-group">
                            <label for="old_pwd">Old Password</label>
                            <input type="password" class="form-control" placeholder="Old Password" id="old_pwd" name="old_pwd" />
                        </div>
                        <div class="form-group">
                            <label for="new_pwd">New Password</label>
                            <input type="password" class="form-control" placeholder="New Password (Min. 6 character)"
                                   id="new_pwd" name="new_pwd"/>
                        </div>
                        <div class="form-group">
                            <label for="confirm_new_pwd">Confirm New Password</label>
                            <input type="password" class="form-control" placeholder="Re-type New Password"
                                   id="confirm_new_pwd" name="confirm_new_pwd"/>
                        </div>
                        <button class="btn btn-solid-my btn-block">Change</button>
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
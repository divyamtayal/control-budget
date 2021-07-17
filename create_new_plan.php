<?php   
    include './includes/common.php';
    if(!isset($_SESSION['email']))
        header ('location:index.php');
    
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
        <div class="col-xs-12  col-sm-6 col-sm-offset-3 ">
            <div class="panel">
                <div class="panel-heading panel-my-bgcolor">
                    <center>
                        <h4>Create New Plan</h4>
                    </center>
                </div>
                <div class="panel-body">
                    <form action="plan_detail.php" method="GET">
                        <div class="form-group">
                            <label for="initial_budget">Initial Budget</label>
                            <input type="number" class="form-control" placeholder="Initial Budget (Ex. 4000)" id="initial_budget" required min="50" name="initial_budget"/>
                        </div>
                        <div class="form-group">
                            <label for="people">How many peoples you want to add in your group?</label>
                            <input type="number" class="form-control" placeholder="No. of people" id="people" required min="1" name="people"/>
                        </div>
                        <button class="btn btn-my btn-block">Next</button>
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
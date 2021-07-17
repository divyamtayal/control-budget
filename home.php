<?php
    include './includes/common.php';
    if(!isset($_SESSION['email']))
        header ('location:index.php');
    $user_id = $_SESSION['user_id'];
    //    Getting all plans for particular user
    $plan_check_query = "SELECT * FROM plans where user_id='$user_id'";
    $plan_check_result = mysqli_query($con, $plan_check_query) or die (mysqli_error($con));
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
        if(mysqli_num_rows($plan_check_result)==0){
    ?>
    <div class="container offset">
        <div class="row">
            <h3 class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-0">You don't have any active plans</h3>
        </div>
        <br>
        <div class="row">
                <center>
                <a href="create_new_plan.php" role="button" class="btn btn-default create_new_plan">
                    <div class="glyphicon glyphicon-plus-sign"></div>
                    <span>Create a New Plan</span>
                </a>
                </center>
        </div>
    </div>
    <?php
        }else{
            
    ?>
    <div class="container offset offset_bottom">
        <h3 class="padding-left">Your Plans</h3>
        <br>
        <?php
            while($row = mysqli_fetch_array($plan_check_result)){
                ?>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <div class="panel">
                    <div class="panel-heading panel-my-bgcolor">
                        <div class="user">
                            <div class="title"><?php echo $row['title'];?></div>
                            <div class="icon">
                                <div class="glyphicon glyphicon-user"></div>
                                <span><?php echo $row['no_of_people'];?></span>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <p>Budget <span class="float-r">&#8377 <?php echo $row['initial_budget'];?></span></p>
                        <p>Date <span class="float-r"><?php echo $row['from_date']."-".$row['to_date'];?></span></p>
                        <a href=<?php echo "./view_plan.php?id=".$row['id'];?> class="btn btn-my btn-block">View Plan</a>
                    </div>
                </div>
            </div>
        <?php
            }
            ?>
    </div>
    <a href="./create_new_plan.php">
        <div class="glyphicon glyphicon-plus-sign add_icon"></div>
    </a>
    <?php
        }
        include './includes/footer.php';
    ?>
</body>

</html>

<?php   
    include './includes/common.php';
    if(!isset($_SESSION['email']))
        header ('location:index.php');
    $plan_id = $_GET['id'];
    $get_plan_query = "SELECT * FROM plans WHERE id='$plan_id'";
    $get_plan_result = mysqli_query($con, $get_plan_query);
    $row = mysqli_fetch_array($get_plan_result);
    $total_amount_spent = $row['initial_budget'] - $row['remaining_amount'];
    
    $get_person_query = "SELECT * FROM persons where plan_id = '$plan_id'";
    $get_persons_result_1 = mysqli_query($con, $get_person_query) or die(mysqli_error($con));
    $get_persons_result_2 = mysqli_query($con, $get_person_query) or die(mysqli_error($con));
    $individual_share = round($total_amount_spent/$row['no_of_people'], 2);
    
    $color="";$ra = $row['remaining_amount'];
    if($ra>0){
        $color = "green";
        $ra = "&#8377 ".$ra;
    }else if($ra<0){
        $color = "red";
        $ra = "Overspent by &#8377 ".(-1)*$ra;
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
        <div class="col-xs-12 col-sm-6 col-sm-offset-3">
            <div class="panel">
                <div class="panel-heading panel-my-bgcolor">
                    <div class="user">
                        <div class="title"><?php echo $row['title']?></div>
                        <div class="icon">
                            <div class="glyphicon glyphicon-user"></div>
                            <span><?php echo $row['no_of_people']?></span>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <p>Initial Budget<span class="float-r">&#8377 <?php echo $row['initial_budget']?></span></p>
                    <?php
                        while($person = mysqli_fetch_array($get_persons_result_1)){
                    ?>
                    <p><?php echo $person['name']?><span class="float-r">&#8377 <?php echo $person['amount_spent']?></span></p> 
                    <?php
                        }
                    ?>
                    <p>Total Amount Spent<span class="float-r">&#8377 <?php echo $total_amount_spent?></span></p>
                    <p>Remaining Amount<span class="float-r <?php echo $color ?>"><b><?php echo $ra;?></b></span></p>
                    <p>Individual Shares<span class="float-r">&#8377 <?php echo $individual_share ?></span></p>
                    
                    <?php
                        while($person = mysqli_fetch_array($get_persons_result_2)){
                                $color="";$calc=round($person['amount_spent'] - $individual_share, 2);
                                if($calc>0){
                                    $color = "green";
                                    $calc = "Gets back &#8377 ".$calc;
                                }else if($calc<0){
                                    $color = "red";
                                    $calc = "Owes  &#8377 ".(-1)*$calc;
                                }else{
                                    $calc = "All Settled up";
                                }
                    ?>
                    <p><?php echo $person['name']?><span class="float-r <?php echo $color ?>"><?php echo $calc;?></span></p> 
                    <?php
                        }
                    ?>
                    <center><a href=<?php echo "./view_plan.php?id=".$plan_id;?> class = "btn btn-my"><div class="glyphicon glyphicon-arrow-left"></div> Go back</a></center>
                </div>
            </div>
        </div>
    </div>
    <?php
        include './includes/footer.php';
    ?>
</body>

</html>
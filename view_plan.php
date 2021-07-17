<?php
    include './includes/common.php';
    if(!isset($_SESSION['email'])){
        header ('location:index.php');
    }
    $plan_id=$_GET['id'];
    $get_plan_query = "SELECT * FROM plans WHERE id='$plan_id'";
    $get_persons_query = "SELECT * FROM persons WHERE plan_id = '$plan_id'";
    
    $get_plan_result = mysqli_query($con, $get_plan_query);
    $get_persons_result = mysqli_query($con, $get_persons_query) or die(mysqli_error($con));
    
    $plan = mysqli_fetch_array($get_plan_result);
    
    $color="";$ra = $plan['remaining_amount'];
    if($ra>0){
        $color = "green";
        $ra = "&#8377 ".$ra;
    }else if($ra<0){
        $color = "red";
        $ra = "Overspent by &#8377 ".(-1)*$ra;
    }
    
    function after_date($d){
        if($d%10==1) return "st";
        elseif ($d==2 || $d==22) return "nd";
        elseif($d==3 || $d==23) return "rd";
        else return "th";
    }
    $date = date("d", strtotime($plan['from_date'])).after_date(date("d", strtotime($plan['from_date'])))." ".date("M", strtotime($plan['from_date']))." - ".date("d", strtotime($plan['to_date'])).after_date(date("d", strtotime($plan['to_date'])))." ".date("M", strtotime($plan['to_date']))." ".date("Y", strtotime($plan['to_date']));
    
    
    $get_expenses_query = "SELECT * FROM expenses WHERE plan_id='$plan_id'";
    $get_expenses_result = mysqli_query($con, $get_expenses_query) or die(mysqli_error($con));
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
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-0 ">
                <div class="panel">
                    <div class="panel-heading panel-my-bgcolor">
                        <div class="user">
                            <div class="title"><?php echo $plan['title'] ?></div>
                            <div class="icon">
                                <div class="glyphicon glyphicon-user"></div>
                                <span><?php echo $plan['no_of_people']?></span>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <p>Budget <span class="float-r">&#8377 <?php echo $plan['initial_budget']?></span></p>
                        <p>Remaining Amount <span class="float-r <?php echo $color ?>"><b><?php echo $ra;?></b></span></p>                                        
                        <p>Date <span class="float-r"><?php echo $date;?></span></p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-xs-offset-3 col-sm-3 col-sm-offset-2" style="margin-top: 6rem;margin-bottom: 6rem">
                <center><a href=<?php echo "./expense_distribution.php?id=".$plan_id;?> class="btn btn-my"> Expense Distribution</a></center>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1 col-sm-7 col-sm-offset-0">
                <?php
                    while($expense = mysqli_fetch_array($get_expenses_result)){
                        $e_date = date("d", strtotime($expense['date'])).after_date(date("d", strtotime($expense['date'])))." ".date("M", strtotime($expense['date']))."-".date("Y", strtotime($expense['date']));
                ?>
                <div class="col-xs-12 col-sm-6 col-lg-4">
                    <div class="panel">
                        <div class="panel-heading panel-my-bgcolor">
                            <center><?php echo $expense['expense_name']?></center>
                        </div>
                        <div class="panel-body">
                            <p>Amount <span class="float-r">&#8377 <?php echo $expense['amount_spent']?></span></p>
                            <p>Paid by<span class="float-r"><?php echo $expense['person_name']?></span></p>
                            <p>Paid on <span class="float-r"><?php echo $e_date;?></span></p>
                            <?php
                                if($expense['bill_path']){
                            ?>
                            <center><a href=<?php echo "./".$expense['bill_path']?> class="btn btn-my-link">Show Bill</a></center>
                            <?php
                                }else{
                                ?>
                            <center><a  disabled class="btn btn-my-link">You Don't have bill</a></center>
                            <?php
                                }
                                ?>
                        </div>
                    </div>
                </div>
                <?php
                    }
                    ?>
            </div>
            <div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-0">
                <div class="panel">
                    <div class="panel-heading panel-my-bgcolor">
                        <center>Add New Expense</center>
                    </div>
                    <div class="panel-body">
                        <form action=<?php echo "./create_new_expense.php?id=".$plan_id;?> method="POST"  enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">Expense Name</label>
                                <input type="text" class="form-control" placeholder="Expense Name" id="name" required name="name"/>
                            </div>
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" id="date" min=<?php echo $plan['from_date']?> max=<?php echo $plan['to_date']?> required name="paid_date"/>
                            </div>
                            <div class="form-group">
                                <label for="amount">Amount Spent</label>
                                <input type="number" class="form-control" placeholder="Amount Spent" id="amount"
                                       required name="amount" min="1"/>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="person" >
                                    <?php
                                        while($person = mysqli_fetch_array($get_persons_result)){
                                    ?>
                                    <option value=<?php echo $person['name']?>><?php echo $person['name']?></option>
                                    <?php
                                        }
                                        ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="file">Upload Bill</label>
                                <input type="file" class="form-control" placeholder="Amount Spent" id= "file" name= "uploadedimage"/>
                            </div>
                            <button class="btn btn-my btn-block">Add</button>
                        </form>
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
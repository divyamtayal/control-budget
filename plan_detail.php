<?php   
    include './includes/common.php';
    if(!isset($_SESSION['email']))
        header ('location:index.php');
    $initial_budget = $_GET['initial_budget'];
    $no_of_people = $_GET['people'];
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
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="plan_detail_script.php" method="POST">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" placeholder="Enter Title (Ex. Trip to Goa)" id="title" required name="title"/>
                        </div>
                        <div class="form-group col-xs-6 pad_l">
                            <label for="from">From</label>
                            <input type="date" class="form-control" placeholder="No. of people" id="from" required min="2020-10-01" max="2020-10-31" name="from"/>
                        </div>
                        <div class="form-group col-xs-6 pad_r">
                            <label for="to">To</label>
                            <input type="date" class="form-control" placeholder="No. of people" id="to" required min="2020-10-01" max="2020-10-31" name="to"/>
                        </div>
                        <div class="form-group col-xs-8 pad_l">
                            <label for="intial_budget">Intial Budget</label>
                            <input type="number" class="form-control defined_value" value=<?php echo $initial_budget ?> id="intial_budget" name="initial_budget"/>
                        </div>
                        <div class="form-group col-xs-4 pad_r">
                            <label for="people">No. of people</label>
                            <input type="number" class="form-control defined_value" value=<?php echo $no_of_people ?> id="people" name="people"/>
                        </div>
                        <?php
                            $i=1;
                            while($i<=$no_of_people){
                        ?>
                        <div class="form-group">
                            <label for=<?php echo "p".$i; ?>>Person <?php echo $i; ?></label>
                            <input type="text" class="form-control" placeholder="Person <?php echo $i; ?> Name" id=<?php echo "p".$i; ?> required name=<?php echo "p".$i; ?> />
                        </div>
                        <?php
                            $i++;
                            }
                        ?>
                        <button href="plan_detail.php" class="btn btn-my btn-block">Submit</button>
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
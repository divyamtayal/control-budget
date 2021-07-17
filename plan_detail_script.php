<?php
    include './includes/common.php';
    
    $user_id = $_SESSION['user_id'];
    $title = mysqli_escape_string($con, $_POST['title']);
    $from = mysqli_escape_string($con, $_POST['from']);
    $to = mysqli_escape_string($con, $_POST['to']);
    $initial_budget = mysqli_escape_string($con, $_POST['initial_budget']);
    $no_of_people =  mysqli_escape_string($con, $_POST['people']);
    
    $plan_insert_query = "INSERT INTO plans (user_id, title, from_date, to_date, initial_budget, remaining_amount, no_of_people) values ('$user_id', '$title', '$from','$to', '$initial_budget', '$initial_budget', '$no_of_people')";
    $plan_insert_result = mysqli_query($con, $plan_insert_query) or die(mysqli_error($con));
    $plan_id = mysqli_insert_id($con);
    
    $i=1;
    $persons="";
    while($i<=$no_of_people){
        $persons = $persons."(".$plan_id.",'".$_POST["p".$i]."',0)";
        if($i<$no_of_people)
            $persons=$persons.",";
        $i+=1;
    }
    
    $person_insert_query = "INSERT INTO persons (plan_id, name, amount_spent) values {$persons}";
//    die($person_insert_query);
    $persons_insert_result = mysqli_query($con, $person_insert_query) or die(mysqli_error($con));
    header('location:home.php');
    
    
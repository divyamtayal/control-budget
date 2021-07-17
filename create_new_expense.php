<?php
    include './includes/common.php';
    
    //    Getting plan id
    $plan_id = $_GET['id'];
    
    //    collecting data for new expense
    $expense_name = mysqli_escape_string($con, $_POST['name']);
    $paid_date = $_POST['paid_date'];
    $amount = $_POST['amount'];
    $person = mysqli_escape_string($con, $_POST['person']);
    
    //    person query    
    $get_person_query = "SELECT * FROM persons WHERE plan_id='$plan_id' AND name='$person'";
    $get_person_result = mysqli_query($con, $get_person_query) or die(mysqli_error($con));
    
    //    add expense amount to person amount spent    
    $person_detail = mysqli_fetch_array($get_person_result);
    $person_amount_spent = $person_detail['amount_spent'];
    $person_amount_spent += $amount;
    
    //    Setting up amount left after adding new expense
    $get_plan_query = "SELECT * FROM plans where id='$plan_id'";
    $get_plan_result = mysqli_query($con, $get_plan_query) or die(mysqli_error($con));
    $plan_details = mysqli_fetch_array($get_plan_result);
    $plan_remaining_amount = $plan_details['remaining_amount'];
    $plan_remaining_amount -= $amount;
    
    //    Getting Image and saving it
    function GetImageExtension($imagetype){
        
        if(empty($imagetype)) return false;
        
        switch($imagetype){
            case 'image/bmp': return '.bmp';
            case 'image/gif': return '.gif';
            case 'image/jpeg': return '.jpg';
            case 'image/png': return '.png';
            default: return false;
        }
    }

    //-------------------------------------------------------------------------------------------------------

    $update_plan_remaining_amount_query = "UPDATE plans SET remaining_amount = '$plan_remaining_amount' where id='$plan_id'";
    mysqli_query($con, $update_plan_remaining_amount_query) or die(mysqli_error($con));
    
    $update_person_amount_spent_query = "UPDATE persons SET amount_spent = '$person_amount_spent' where plan_id='$plan_id' AND name = '$person'";
    mysqli_query($con, $update_person_amount_spent_query) or die(mysqli_error($con));
    
    if (!empty($_FILES["uploadedimage"]["name"])) {
        
        $file_name=$_FILES["uploadedimage"]["name"];
        $temp_name=$_FILES["uploadedimage"]["tmp_name"];
        $imgtype=$_FILES["uploadedimage"]["type"];
        $ext= GetImageExtension($imgtype);
        $imagename=date("d-m-Y")."-".time().$ext;
        $target_path = "img/".$imagename;
        
        if(move_uploaded_file($temp_name, $target_path)){
        // Make a query to save data to your database.
             $add_expense_query = "INSERT INTO expenses (plan_id, expense_name, date, amount_spent, person_name , bill_path) values ('$plan_id', '$expense_name', '$paid_date', {$amount}, '$person', '$target_path')";
             mysqli_query($con, $add_expense_query) or die(mysqli_error($con));
        }
    }else{
         $add_expense_query = "INSERT INTO expenses (plan_id, expense_name, date, amount_spent, person_name ) values ('$plan_id', '$expense_name', '$paid_date', {$amount}, '$person')";
         mysqli_query($con, $add_expense_query) or die(mysqli_error($con));
    }
    
  
    header('location:view_plan.php?id='.$plan_id);
    


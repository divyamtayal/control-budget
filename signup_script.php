<?php
    include './includes/common.php';
    
    //    collecting signup details
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = md5(md5($_POST['password']));
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    
    $check_email_query = "SELECT * FROM users where email = '$email'";
    $check_email_result = mysqli_query($con, $check_email_query) or die(mysqli_error($con));
    
    //    checking if emails alredy exists
    if(mysqli_num_rows($check_email_result)>0){
        echo "<script>alert('Email address already registered')</script>";
        echo "<script>location.href='signup.php'</script>";

    }else{
        //        storing data into database
        $register_user_query = "INSERT INTO users (name, email, password, phone) values ('$name', '$email', '$password', '$phone')";
        $register_user_result = mysqli_query($con, $register_user_query) or die(mysqli_error($con));
        $_SESSION['email'] = $email;
        $_SESSION['user_id'] = mysqli_insert_id($con);
        header('location:home.php');
    }
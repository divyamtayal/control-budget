<?php
    include './includes/common.php';
    
    //    Getting login credentials
    $email = mysqli_escape_string($con, $_POST['email']);
    $password = md5(md5($_POST['password']));
    
    $authentication_query = "SELECT * FROM users WHERE email = '$email'";
    $authentication_result = mysqli_query($con, $authentication_query) or die(mysqli_error($con));
    
    //    checking if emails exists
    if(mysqli_num_rows($authentication_result)==0){
        echo "<script>alert('Email address not registered')</script>";
        echo "<script>location.href='login.php'</script>";
    }
    else{
        $result = mysqli_fetch_array($authentication_result);
        //        checking if password entered is correct
        if($password!=$result['password']){
            echo "<script>alert('Password entered is incorrect')</script>";
            echo "<script>location.href='login.php'</script>";
        }else{
            $_SESSION['email'] = $email;
            $_SESSION['user_id'] = $result['id'];
            header('location:home.php');
        }
    }
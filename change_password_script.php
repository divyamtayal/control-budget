<?php
        include './includes/common.php';
        if(!isset($_SESSION['email'])){
            header('loaction:index.php');
        }
        
        $old_pwd = md5(md5($_POST['old_pwd']));
        $new_pwd = md5(md5($_POST['new_pwd']));
        $new_pwd_rtype = md5(md5($_POST['confirm_new_pwd']));
        
        $user_id = $_SESSION['user_id'];
        
                //        if new password and newpasswordConfirm is same then check for current password
        if($new_pwd===$new_pwd_rtype){
            $pwd_query = "SELECT password FROM users WHERE id = '$user_id' ";
            $pwd_result = mysqli_query($con, $pwd_query) or die(mysqli_error($con));
            $pwd = mysqli_fetch_array($pwd_result);
                //            if current password is correct update new password
            if ($pwd['password']==$old_pwd){
                $update_pwd_query = "UPDATE users SET password = '$new_pwd' WHERE id = '$user_id'";
                $update_pwd_result = mysqli_query($con, $update_pwd_query);
                header('location:index.php');
            } else {
                //          Rendering Error message
                echo "<script>alert('You entered the wrong password')</script>";
                
                //          Rendering back to change password page                
                echo "<script>location.href='change_password.php'</script>";
            }
        }
                //          if new password and newpasswordConfirm is not same
        else{
                //          Rendering Error message
            echo "<script>alert('Password don\'t match')</script>";
            
                //          Rendering back to change password page                
            echo "<script>location.href='change_password.php'</script>";
        }
        
?>
<?php 
    require "_connection.php";

    $msg = "";
    $status = "";
    $alert = false;
    $clr = "";

    if(isset($_POST['signup'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        if(!empty($email)){
            if($password == $cpassword && !empty($password)){

            $existSql = "SELECT * FROM `users` WHERE user_email = '$email'";
            $result = mysqli_query($conn, $existSql);
            $num = mysqli_num_rows($result);
    
            if($num){
                $alert = true;
                $msg = "user already exists";
                $clr = "danger";
                $status = "Error";
                header("Location: ../index.php?msg=$msg&status=$status&alert=$alert&clr=$clr");
            }else {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `users` (`user_email`, `user_password`) VALUES ('$email', '$hash');";
                $result = mysqli_query($conn, $sql);

                if($result){
                    $alert = true;
                    $status = "Success";
                    $msg = "You have been successfully been signed up";
                    $clr = "success";
                    header("Location: ../index.php?msg=$msg&status=$status&alert=$alert&clr=$clr");
                }

            }
        }else if(empty($password)){
            $alert = true;
            $msg = "enter a password";
            $clr = "danger";
            $status = "Error";
            header("Location: ../index.php?msg=$msg&status=$status&alert=$alert&clr=$clr");
        }else {
            $alert = true;
            $msg = "passwords do not match";
            $clr = "danger";
            $status = "Error";
            header("Location: ../index.php?msg=$msg&status=$status&alert=$alert&clr=$clr");
        }
        }else {
            $alert = true;
            $msg = "enter an email first";
            $clr = "danger";
            $status = "Error";
            header("Location: ../index.php?msg=$msg&status=$status&alert=$alert&clr=$clr");
        }

    }
?>
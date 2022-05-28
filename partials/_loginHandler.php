<?php 
    require "_connection.php";

    $msg = "";
    $status = "";
    $alert = false;
    $clr = "";

    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM `users` WHERE user_email = '$email'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);

        if($num){
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password, $row['user_password'])){
                session_start();
                $_SESSION['loggedin'] = true;
                $username = $row['user_email'];
                echo $username;
                $_SESSION['username'] = $username;
                $_SESSION['user_id'] = $row['user_id'];
                $alert = true;
                $msg = "You have been successfully logged in";
                $clr = "success";
                $status = "Success";
                header("Location: ../index.php?msg=$msg&status=$status&alert=$alert&clr=$clr");
            }else {
                $alert = true;
                $msg = "enter a password";
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
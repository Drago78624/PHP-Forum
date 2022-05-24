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
                $username = substr($row['user_email'], 0, strpos($row['user_email'], "@"));
                echo $username;
                $_SESSION['username'] = $username;
                $alert = true;
                $msg = "You have been successfully logged in";
                $clr = "success";
                $status = "Success";
                header("Location: ../index.php?msg=$msg&status=$status&alert=$alert&clr=$clr");
            }
        }
    }
?>
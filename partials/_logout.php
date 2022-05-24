<?php
    session_start();

    $msg = "";
    $status = "";
    $alert = false;
    $clr = "";

    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        session_unset();
        session_destroy();
        $alert = true;
        $msg = "You have been successfully logged out";
        $clr = "success";
        $status = "Success";
        header("Location: ../index.php?msg=$msg&status=$status&alert=$alert&clr=$clr");
    }
?>
<?php
session_start();
include('db.php');

if(isset($_POST['login_now_btn']))
{
    if(!empty(trim($_POST['email'])) && !empty(trim($_POST['password'])))
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $login_query = "SELECT * FROM users WHERE email = ? AND password = ? LIMIT 1";
        $stmt = mysqli_prepare($con, $login_query);
        mysqli_stmt_bind_param($stmt, "ss", $email, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_array($result);
            echo $row['verify_status'];
        }
        else
        {
            $_SESSION['status'] = "Invalid email or Password";
            header("Location: login.php");
            exit(0);
        }    
    }
    else
    {
        $_SESSION['status'] = "All fields are Mandetory";
        header("Location: login.php");
        exit(0);
    }

}
?>
<?php
session_start();
include('db.php');

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function sendemail_verify($name, $email, $verify_token)
{
    $mail = new PHPMailer(true);

    //Server Settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = 'true';
    $mail->Username = 'nycelcainoy@gmail.com';
    $mail->Password = 'kzvh mwhw xira tjhj';

    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    //Recipients
    $mail->setFrom('nycelcainoy@gmail.com', 'Nycel');
    $mail->addAddress($email, 'Nycel');

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Here is the subject';

    $mail_template = "
    <h2>You have Registered with my name</h2>
    <h5>Verify your email address to login with below given link</h5>
    <br/><br/>
    <a href='http://localhost/NYCEL%20BANTILAN/LOGIN%20REGISTRATION/verify-email.php?token=$verify_token'>Click Me</a>
    ";

    $mail->Body = $mail_template;
    $mail->send();
    echo 'Message has been sent';
}

if (isset($_POST['register_btn'])) {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $verify_token = md5(rand());

    $check_email_query = "SELECT email FROM users WHERE email='$email' LIMIT 1";
    $check_email_query_run = mysqli_query($con, $check_email_query);

    if (mysqli_num_rows($check_email_query_run) > 0) {
        $_SESSION['status'] = "Email ID is already exists";
        header("Location: register.php");
    } else {
        // Insert user /Registered User
        $query = "INSERT INTO users(full_name, phone, email, password, verify_token) VALUES ('$full_name', '$phone', '$email', '$password', '$verify_token')";
        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            sendemail_verify("$full_name", "$email", "$verify_token");
            $_SESSION['status'] = "Registration Successfully!Please verify your Email Address.";
            header("Location: register.php");
        } else {
            $_SESSION['status'] = "Registration Failed";
            header("Location: register.php");
        }
    }
}
?>
<?php
session_start();
include('dbcon.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

function resend_email_verify($name, $email, $verify_token)
{
    $mail = new PHPMailer(true);
        
    // $mail->SMTPDebug = 2;
    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host       = 'smtp.gmail.com';                                              
    $mail->Username   = 'zhairajanemartinez@gmail.com';                    
    $mail->Password   = 'lnazffnwndemzeax';                               
   
    $mail->SMTPSecure =  "ssl" ;            
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS


    //Attachments
    $mail->setFrom('zhairajanemartinez@gmail.com',$name);         //Add attachments
    $mail->addAddress($email);    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "Resend - Email verification from Ms. Luna";

    $email_template = "
       <h2>You have Registered with Ms. Luna</h2>
       <h5>Verify your email address to login with the below given link</h5>
       <br/><br/>
       <a href='http://localhost/zhaira%20jane/Log%20in%20form%20with%20email%20verification/verify-email.php?token=$verify_token'> Click Me </a>
    ";
   

    $mail->Body = $email_template;
    $mail->send();
    // echo "Message has been sent";
}

if(isset($_POST['resend_email_verify_btn']))
{
    if(!empty(trim($_POST['email'])))
    {
       $email = mysqli_real_escape_string($con, $_POST['email']);

       $checkemail_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
       $checkemail_query_run = mysqli_query($con, $checkemail_query);

       if(mysqli_num_rows($checkemail_query_run) > 0)
       {
           $row = mysqli_fetch_array($checkemail_query_run);
           if($row['verify_status'] == "0")
           {
               $name = $row['name'];
               $email = $row['email'];
               $verify_token = $row['verify_token'];

               resend_email_verify($name,$email,$verify_token);

               $_SESSION['status'] = "Verification Email Link has been sent to your email address.!";
               header("Location: login.php");
               exit(0);
           }
           else
           {
               $_SESSION['status'] = "Email is not registered. Please Register now.!";
               header("Location: resend-email-verification.php");
               exit(0);
           }
       }
       else
       {
           $_SESSION['status'] = "Email is not registered. Please Register now.!";
           header("Location: register.php");
           exit(0);
       }
    }
    else
    {
        $_SESSION['status'] = "Please enter the email field";
        header("Location: resend-email-verification.php");
        exit(0);
    }
}

?>
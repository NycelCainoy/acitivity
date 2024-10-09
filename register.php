<?php
session_start();
$page_title = "Registration Form";
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="alert">
                    <?php 
                    if (isset($_SESSION['status'])) {
                        echo "<h4>".$_SESSION['status']. "</h4>";
                        unset($_SESSION['status']);
                    }
                    ?>
                </div>
                <div class="card shadow">
                    <div class="card header">
                        <h5>Registration Form with Email Verification</h5>
                    </div>
                    <div class="card-body">

                        <form action="code.php"method="POST">
                            <div class="form-group mb-3"> 
                                <label for="name">Full_Name</label>
                                <input type="text" id="full_name" name="full_name" class="form-control">
                            </div>
                            <div class="form-group mb-3"> 
                                <label for="phone">Phone_Number</label>
                                <input type="text" id="phone" name="phone" class="form-control">
                            </div>
                            <div class="form-group mb-3"> 
                                <label for="email">Email Address</label>
                                <input type="email" id="email" name="email" class="form-control">
                            </div>
                            <div class="form-group mb-3"> 
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control">
                            </div>
                            <div class="form-group mb-3"> 
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" id="confirm_password" name="confirm_password" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="register_btn" class="btn btn-primary">Register Now</button> 
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
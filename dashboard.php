
<?php
include('authentication.php');

$page_title = "Dashboard";
include('includes/header.php');
include('includes/navbar.php');


?>

<div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <?php 
                        if(isset($_SESSION['status'])){
                            ?>
                            <div class="alert alert-success">
                                <h5> <?= $_SESSION['status']; ?> </h5>
                            </div>
                            <?php unset($_SESSION['status']); 
                        }
                    ?> 

                    <div class="card shadow-lg">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">User Dashboard</h4>
                        </div>
                        <div class="card-body">
                            <h4 class="text-center">Access when you're Login</h4>
                            <hr>
                            <h5> <i class="bi bi-person-fill"></i> <strong>Username: </strong><?= $_SESSION['auth_user']['username']?></h5>
                            <hr>
                            <h5> <i class="bi bi-envelope-fill"></i> <strong>Email: </strong><?= $_SESSION['auth_user']['email']?></h5>
                            <hr>
                            <h5> <i class="bi bi-phone-fill"></i> <strong>Phone Number: </strong><?= $_SESSION['auth_user']['phone']?></h5>
                        </div>
                    </div>    
                    
                </div>
            </div>
        </div>
</div>

<?php include('includes/footer.php');?>
<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<?php 
// session_start();

if (isset($_SESSION['id']) && isset($_SESSION['fname'])) {

include "db_conn.php";
include 'php/User.php';
$user = getUserById($_SESSION['id'], $conn);

include "template/user_header.php"; }

else {include"template/header.php";}

 ?>

<div class="container-xxl py-5 bg-dark hero-header mb-5">
                <!-- <div class="container text-center my-5 pt-5 pb-4">
                    <h1 class="display-5 text-white mb-3 animated slideInDown">Login</h1>
                </div> -->
            </div>

    <div class="container justify-content-center align-items-center vh-80" >
        <div class="row" >
            
            <div class="shadow col-md-4 offset-md-4 form" style="position: relative; top: 40px; padding-bottom:40px;" >
                <form action="forgot-password.php" method="POST" autocomplete=""  >
                    <!-- <h2 class="text-center">Forgot Password</h2> -->
                    <h2 class="text-center">Enter your email address</>
                    <?php
                        if(count($errors) > 0){
                            ?>
                            <div class="alert alert-danger text-center">
                                <?php 
                                    foreach($errors as $error){
                                        echo $error;
                                    }
                                ?>
                            </div>
                            <?php
                        }
                    ?>
                    <div class="form-group">
                        <input style="position: relative; top: 10px;" class="form-control" type="email" name="email" placeholder="Enter email address" required value="<?php echo $email ?>">
                    </div>
                    <div class="form-group">
                        <input style="position: relative; top: 30px;" class="form-control button" type="submit" name="check-email" value="Continue">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
<?php include("template/footer.php"); ?>
</html>
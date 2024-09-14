<?php require_once "controllerUserData.php"; ?>
<?php
if($_SESSION['info'] == false){
    header('Location: login.php');  
}
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
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
            <?php 
            if(isset($_SESSION['info'])){
                ?>
                <div class="alert alert-success text-center">
                <?php echo $_SESSION['info']; ?>
                </div>
                <?php
            }
            ?>  
            <?php 
            if (isset($_SESSION['id']) && isset($_SESSION['fname'])) {
 ?>
                <form action="home.php" method="POST">
                    <div class="form-group">
                    <!-- <h3 style="font-size:25px; position:relative; top: 50px; left:70px; color:darkslategrey;"><a href="home.php" class="link" style="font-size:25px;">Dashboard</a></h3>         -->
                    <button type="submit" class="btn btn-primary" style="font-size:25px; width:230px; position:relative; top:10px; left:60px;">Dashboard</button>
                </div>
                </form> 
 <?php }else{?>
                <form action="login.php" method="POST">
                    <div class="form-group">
                        <input style="font-size:x-large; position: relative; top: 30px;; ;background-color:#f47c01; color:#efefef;" class="form-control button" type="submit" name="login-now" value="Login Now">
                    </div>
                </form> <?php }?>
            </div>
        </div>
    </div>
    
    

    <?php include("template/footer.php"); ?>
</html>
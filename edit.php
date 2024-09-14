<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['fname'])) {
include "db_conn.php";
include 'php/User.php';

$user = getUserById($_SESSION['id'], $conn);

include "template/user_header.php";


 ?>
 <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container text-center my-5 pt-5 pb-4">
                    <h1 class="display-5 text-white mb-3 animated slideInDown">Dashboard</h1>
                </div>
            </div>
    <?php if ($user) { ?>

    <div class="d-flex justify-content-center align-items-center vh-100">
        
        <form class="shadow w-450 p-3" 
              action="php/edit.php" 
              method="post"
              enctype="multipart/form-data">

            <h4 class="display-4  fs-1">Edit Profile</h4><br>
            <!-- error -->
            <?php if(isset($_GET['error'])){ ?>
            <div class="alert alert-danger" role="alert">
              <?php echo $_GET['error']; ?>
            </div>
            <?php } ?>
            
            <!-- success -->
            <?php if(isset($_GET['success'])){ ?>
            <div class="alert alert-success" role="alert">
              <?php echo $_GET['success']; ?>
            </div>
            <?php } ?>
            <img src="upload/<?=$user['pp']?>"
                 class="rounded-circle"
                 style="width: 150px">
          <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" 
                   class="form-control"
                   name="fname"
                   value="<?php echo htmlspecialchars($user['fname'])?>">
          </div>

          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="text" 
                   class="form-control"
                   name="email"
                   value="<?php echo htmlspecialchars($user['email'])?>">
          </div>

          <div class="mb-3">
            <label class="form-label">User name</label>
            <input type="text" 
                   class="form-control"
                   name="uname"
                   value="<?php echo htmlspecialchars($user['username'])?>">
          </div>

          <div class="mb-3">
            <label class="form-label">Profile Picture</label>
            <input type="file" 
                   class="form-control"
                   name="pp">
            <!-- <img src="upload/<?=$user['pp']?>"
                 class="rounded-circle"
                 style="width: 150px"> -->
            <input type="text"
                   hidden="hidden" 
                   name="old_pp"
                   value="<?=$user['pp']?>" >
          </div>
          
          <button type="submit" class="btn btn-primary">Update</button>
          <a href="forgot-password.php" class="link-secondary d-flex justify-content-end" style="position:relative; top:-30px;">Change Password</a>
        </form>
    </div>
    <?php }else{ 
        header("Location: home.php");
        exit;

    } 
    include"template/footer.php"
    ?>
</html>

<?php }else {
	header("Location: login.php");
	exit;
} ?>
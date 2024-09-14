<!DOCTYPE html>
<html>
<?php	include("template/header.php"); ?>

<div class="container-xxl py-5 bg-dark hero-header mb-5">
                <!-- <div class="container text-center my-5 pt-5 pb-4">
                    <h1 class="display-5 text-white mb-3 animated slideInDown">Login</h1>
                </div> -->
            </div>

			<!-- SignUP Form Start-->
    <div class="d-flex justify-content-center align-items-center vh-100">
    	
    	<form class="shadow w-450 p-3" 
    	      action="php/signup.php" 
    	      method="post"
    	      enctype="multipart/form-data"
			  style="width: 500px; height: 700px; max-height:900px; background-color:#efefef;">

    		<h4 class="display-4  fs-1 "style="color:#f47c01; position:relative; left:90px;">Create Account</h4><br>
    		<?php if(isset($_GET['error'])){ ?>
    		<div class="alert alert-danger" role="alert">
			  <?php echo $_GET['error']; ?>
			</div>
		    <?php } ?>

		    <?php if(isset($_GET['success'])){ ?>
    		<div class="alert alert-success" role="alert">
			  <?php echo $_GET['success']; ?>
			</div>
		    <?php } ?>
		  <div class="mb-3">
		    <label class="form-label" style="font-size:25px">Full Name</label>
		    <input type="text" 
		           class="form-control"
		           name="fname"
		           value="<?php echo htmlspecialchars((isset($_GET['fname']))?$_GET['fname']:"") ?>">
		  </div>

		  <div class="mb-3">
		    <label class="form-label" style="font-size:25px">Email</label>
		    <input type="text" 
		           class="form-control"
		           name="email"
		           value="<?php echo htmlspecialchars((isset($_GET['email']))?$_GET['email']:"") ?>">
		  </div>

		  <div class="mb-3">
		    <label class="form-label" style="font-size:25px">Username</label>
		    <input type="text" 
		           class="form-control"
		           name="uname"
		           value="<?php echo htmlspecialchars((isset($_GET['uname']))?$_GET['uname']:"") ?>">
		  </div>

		  <div class="mb-3">
		    <label class="form-label" style="font-size:25px">Password</label>
		    <input type="password" 
		           class="form-control"
		           name="pass">
		  </div>

		  <div class="mb-3">
		    <label class="form-label" style="font-size:25px">Profile Picture</label>
		    <input type="file" 
		           class="form-control"
		           name="pp">
		  </div>
		  
		  <button type="submit" class="btn btn-primary" style="font-size:25px; width:430px; position:relative; top:10px; left:15px;">Sign Up</button>
		  <!-- <a href="login.php" class="link-secondary" style="font-size:25px">Login</a> -->
		</form>
    </div>

	<!-- Signup Form END -->
	<?php include"template/footer.php"; ?>
</html>
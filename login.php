<!DOCTYPE html>
<html>

<?php	include("template/header.php"); ?>

<div class="container-xxl py-5 bg-dark hero-header mb-5">
                <!-- <div class="container text-center my-5 pt-5 pb-4">
                    <h1 class="display-5 text-white mb-3 animated slideInDown">Login</h1>
                </div> -->
            </div>


    <div class="d-flex justify-content-center align-items-center vh-100" >
    	
    	<form class="shadow w-450 p-3" 
    	      action="php/login.php" 
    	      method="post" style="width: 500px; height: 600px; max-height:600px; margin-top:-400px; background-color:#efefef;">

    		<h3 class="display-4" style="color:#f47c01;">LOGIN</h3><br>
    		<?php if(isset($_GET['error'])){ ?>
    		<div class="alert alert-danger" role="alert">
			  <?php echo $_GET['error']; ?>
			</div>
		    <?php } ?>

		  <div class="mb-3">
		    <label class="form-label" style="font-size:25px">User name</label>
		    <input type="text" 
		           class="form-control"
		           name="uname"
		           value="<?php echo (isset($_GET['uname']))?$_GET['uname']:"" ?>">
		  </div>

		  <div class="mb-3">
		    <label class="form-label" style="font-size:25px">Password</label>
		    <input type="password" 
		           class="form-control"
		           name="pass">
		  </div>
		  
		  <a href="forgot-password.php" class="link" style="font-size:20px;">Forgot Password?</a>
		  <br>
		  <button type="submit" class="btn btn-primary" style="font-size:25px; width:430px; position:relative; top:10px; left:15px;">Login</button>
		  <h3 style="font-size:25px; position:relative; top: 50px; left:70px; color:darkslategrey;">Not a member yet? <a href="signup.php" class="link" style="font-size:25px;">Sign Up</a></h3>
		  
		</form>
    </div>
	<?php include"template/footer.php"; ?>
</html>
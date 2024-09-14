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
<!-- <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body> -->
    <?php if ($user) { ?>
    <div class="shadow d-flex justify-content-center vh-100" style="background-color:#efefef;">
    	
    	<!-- <div class="shadow p-3 text-center" style="max-width:300px; max-height:350px;"> -->
    		<img src="upload/<?=$user['pp']?>"
    		     class="img-fluid rounded-circle" style="max-width:250px; max-height:250px;">
            <!-- <h4 class=""><?=$user['fname']?></h4> -->
            <!-- <a href="edit.php" class="btn btn-primary">
            	Edit Profile
            </a>
             <a href="logout.php" class="btn btn-warning">
                Logout
            </a> -->
		<!-- </div> -->
        <div class="shadow p-3 text-center" style="max-width:800px; max-height:250px; position:relative; left:30px;">
        <h4 class="display-5"><?=$user['fname']?></h4>
        <h5>Hi! I'm an undergrad CSE student and also a great foodie. I make many foods but also want to share them with others. Hope I will be helpful. CIAO! </h5>
        <h5 class="mt-5" >Email: <?=$user['email'] ?></h5>
    </div>
    </div>
    <?php }else { 
     header("Location: login.php");
     exit;
    } 
    include"template/footer.php"?>

</html>

<?php }else {
	header("Location: login.php");
	exit;
} ?>
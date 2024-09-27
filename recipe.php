<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['fname'])) {
    include "db_conn.php";
    include 'php/User.php';
    include 'php/recipe.php';
    $user = getUserById($_SESSION['id'], $conn);
    if(isset($_GET['recipe_id'])){
    $recipe_id = $_GET['recipe_id'];
    $recipe = getRecipesByRecipe_id($recipe_id, $conn);}
    $author = getUserById($recipe[0]['user_id'],$conn);
    // print_r($recipe);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "template/user_header.php";?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - <?=$user['fname']?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    
    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
	<style></style>
    <style>
        /* Dashboard specific styles */

.dashboard-container .hero-header {
    background: linear-gradient(rgba(15, 23, 43, .9), rgba(15, 23, 43, .9)), url('img/bg-hero.jpg');
    background-position: center center;
    background-repeat: no-repeat;
    background-size: cover;
}

.dashboard-container .recipe-card {
    position: relative;
    overflow: hidden;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}

.dashboard-container .recipe-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.dashboard-container .recipe-card .overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(0,0,0,0.7);
    overflow: hidden;
    width: 100%;
    height: 0;
    transition: .5s ease;
}

.dashboard-container .recipe-card:hover .overlay {
    height: 100%;
}

.dashboard-container .recipe-card .text {
    color: white;
    font-size: 20px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    width: 100%;
}

.dashboard-container .profile-section {
    background-color: #f8f9fa;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}
    </style>
</head>
<body>

<div class="container-fluid hero-header py-5 mb-5">
    <div class="container text-center my-5 pt-5 pb-4">
        <!-- <h1 class="display-3 text-white mb-3 animated slideInDown">Dashboard</h1> -->
    </div>
</div>

<?php if ($author) { 
    ?>
<div class="dashboard-container">
    <div class="row">
        <div class="col-lg-4 mb-5">
            <div class="dashboard-profile-section p-5">
                <img src="upload/<?=htmlspecialchars($author['pp'])?>" class="img-fluid rounded-circle mb-5" style="max-width:200px;">
                <h2 class="mb-3"><?=htmlspecialchars($author['fname'])?></h2>
                <p class="mb-4">Hi! I'm an undergrad CSE student and also a great foodie. I make many foods but also want to share them with others. Hope I will be helpful. CIAO!</p>
                <p class="mb-2"><strong>Email:</strong> <?=htmlspecialchars($author['email'])?></p>
                <!-- <a href="add_recipe.php" class="btn btn-primary mt-3 ">Add a Recipe</a> -->
            </div>
        </div>
        <div class="col-lg-8">
        <?php
                if ($recipe && is_array($recipe)) {
                        // $recipe = $recipes['id'];
                        ?>
            <div class="row">
                
                        <div class='col-md-6 mb-4'>
                            <!-- <div class='card'> -->
                                <img src='recipes/<?php echo htmlspecialchars($recipe[0]['picture'])?>' onerror="this.src='upload/default.jpg'" alt='<?php echo htmlspecialchars($recipe['recipe_name']); ?>' class='img-fluid'>
                                <!-- <div class='overlay'> -->
                                    <div class='text'>
                                        <h1 class='text'><?php echo htmlspecialchars($recipe[0]['recipe_name']); ?></h1>
                                        <h4>By <?php echo htmlspecialchars($author['fname']); ?></h4>
                                        <p><?php echo htmlspecialchars($recipe[0]['description']); ?></p>
                                    <!-- </div> -->
                                </div>
                            <!-- </div> -->
                        </div>
                        <?php
                    
                } else {
                    echo "<p>No recipes found.</p>";
                }
                ?>
            </div>
        </div>


<?php 
} else { 
    header("Location: login.php");
    exit;
} 

include "template/footer.php";
?>

</body>
</html>

<?php 
} else {
    header("Location: login.php");
    exit;
} 
?>
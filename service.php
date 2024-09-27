<?php

session_start();

if (isset($_SESSION['id']) && isset($_SESSION['fname'])) {

include "db_conn.php";
include 'php/User.php';
$user = getUserById($_SESSION['id'], $conn);

include "template/user_header.php"; }

else {include"template/header.php";}

include "db_conn.php";
include "connection.php";

include "php/fetch_service.php";
$services = getServices($conn) ;


?>

<div class="container-fluid hero-header py-5 mb-5">
    <div class="container text-center my-5 pt-5 pb-4">
        <!-- <h1 class="display-3 text-white mb-3 animated slideInDown">Dashboard</h1> -->
         
        <h1 class="section-title ff-secondary text-center text-primary fw-normal">Our Services</h1>
    </div>
</div>


        <!-- Service Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <!-- <h5 class="section-title ff-secondary text-center text-primary fw-normal">Our Services</h5> -->
                    <h1 class="mb-5">Explore Our Services</h1>
                </div>
                
                <div class="row g-4">
                <?php foreach ($services as $service) : ?>         
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <a href="<?php echo htmlspecialchars($service['service_name'])?>.php">
                        <div class="service-item rounded pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-user-tie text-primary mb-4"></i>
                                <h5><?php echo htmlspecialchars($service['service_name'])?></h5>
                                <p><?php echo htmlspecialchars($service['service_overview'])?></p>
                            </div>
                        </div>
                    </a>
                    </div>
                    <?php endforeach; ?>
                </div>
                
            </div>
        </div>
        <!-- Service End -->


        <?php include("template/footer.php")?>


</html>
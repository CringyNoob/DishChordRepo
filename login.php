<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles for the login form */
        .login-form-container {
            max-width: 500px;
            background-color: #efefef;
            padding: 70px;
            border-radius: 10px;
        }

        .form-title {
            color: #f47c01;
        }

        .btn-custom {
            font-size: 18px;
            width: 100%;
        }

        .forgot-link {
            font-size: 16px;
        }

        .signup-link {
            font-size: 18px;
            color: darkslategrey;
        }

        @media (max-width: 576px) {
            .login-form-container {
                padding: 20px;
            }

            .form-title {
                font-size: 24px;
            }

            .btn-custom {
                font-size: 16px;
            }

            .forgot-link,
            .signup-link {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>

    <?php include("template/header.php"); ?>

    <div class="container-xxl py-5 bg-dark hero-header mb-5"></div>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="login-form-container shadow">
            <h3 class="display-4 form-title text-center mb-4">LOGIN</h3>

            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_GET['error']; ?>
                </div>
            <?php } ?>

            <form action="php/login.php" method="post">

                <div class="mb-3">
                    <label for="username" class="form-label" style="font-size: 20px;">User Name</label>
					<input type="text" 
		           class="form-control"
		           name="uname"
		           value="<?php  (isset($_GET['uname']))?$_GET['uname']:"" ?>">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label" style="font-size: 20px;">Password</label>
                    <input type="password" class="form-control" id="password" name="pass" >
                </div>

                <div class="mb-3">
                    <a href="forgot-password.php" class="forgot-link">Forgot Password?</a>
                </div>

                <button type="submit" class="btn btn-primary btn-custom mb-3">Login</button>

                <div class="text-center mt-3 signup-link">
                    Not a member yet? <a href="signup.php" class="link">Sign Up</a>
                </div>
            </form>
        </div>
    </div>

    <?php include("template/footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

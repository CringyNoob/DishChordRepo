<?php 
session_start();
require "connection.php";
$email = "";
$name = "";
$errors = array();

//if users signup button
// if(isset($_POST['signup'])){
//     $name = mysqli_real_escape_string($con, $_POST['name']);
//     $email = mysqli_real_escape_string($con, $_POST['email']);
//     $password = mysqli_real_escape_string($con, $_POST['password']);
//     $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
//     if($password !== $cpassword){
//         $errors['password'] = "Confirm password not matched!";
//     }
//     $email_check = "SELECT * FROM users WHERE email = '$email'";
//     $res = mysqli_query($con, $email_check);
//     if(mysqli_num_rows($res) > 0){
//         $errors['email'] = "Email that you have entered is already exist!";
//     }
//     if(count($errors) === 0){
//         $encpass = password_hash($password, PASSWORD_BCRYPT);
//         $code = rand(999999, 111111);
//         $status = "notverified";
//         $insert_data = "INSERT INTO users (name, email, password, code, status)
//                         values('$name', '$email', '$encpass', '$code', '$status')";
//         $data_check = mysqli_query($con, $insert_data);
//         if($data_check){
//             $subject = "Email Verification Code";
//             $message = "Your verification code is $code";
//             $sender = "From: shahiprem7890@gmail.com";
//             if(mail($email, $subject, $message, $sender)){
//                 $info = "We've sent a verification code to your email - $email";
//                 $_SESSION['info'] = $info;
//                 $_SESSION['email'] = $email;
//                 $_SESSION['password'] = $password;
//                 header('location: users-otp.php');
//                 exit();
//             }else{
//                 $errors['otp-error'] = "Failed while sending code!";
//             }
//         }else{
//             $errors['db-error'] = "Failed while inserting data into database!";
//         }
//     }

// }
    //if users click verification code submit button
    if(isset($_POST['check'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM users WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['code'];
            $email = $fetch_data['email'];
            $code = 0;
            $status = 'verified';
            $update_otp = "UPDATE users SET code = $code, status = '$status' WHERE code = $fetch_code";
            $update_res = mysqli_query($con, $update_otp);
            if($update_res){
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                header('location: home.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while updating code!";
            }
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //if users click login button
    if(isset($_POST['login'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $check_email = "SELECT * FROM users WHERE email = '$email'";
        $res = mysqli_query($con, $check_email);
        if(mysqli_num_rows($res) > 0){
            $fetch = mysqli_fetch_assoc($res);
            $fetch_pass = $fetch['password'];
            if(password_verify($password, $fetch_pass)){
                $_SESSION['email'] = $email;
                $status = $fetch['status'];
                if($status == 'verified'){
                  $_SESSION['email'] = $email;
                  $_SESSION['password'] = $password;
                    header('location: home.php');
                }else{
                    $info = "It's look like you haven't still verify your email - $email";
                    $_SESSION['info'] = $info;
                    header('location: users-otp.php');
                }
            }else{
                $errors['email'] = "Incorrect email or password!";
            }
        }else{
            $errors['email'] = "It's look like you're not yet a member! Click on the bottom link to signup.";
        }
    }

    //if users click continue button in forgot password form
    include('smtp/PHPMailerAutoload.php');

    // echo smtp_mailer('waliullahkhan3012@gmail.com','test','worked');

    if(isset($_POST['check-email'])){
        
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $check_email = "SELECT * FROM users WHERE email='$email'";
        $run_sql = mysqli_query($con, $check_email);
        if(mysqli_num_rows($run_sql) > 0){

            $mail = new PHPMailer(); 
        	$mail->IsSMTP(); 
           	$mail->SMTPAuth = true; 
        	$mail->SMTPSecure = 'tls'; 
        	$mail->Host = "smtp.gmail.com";
        	$mail->Port = 587; 
        	$mail->IsHTML(true);
        	$mail->CharSet = 'UTF-8';
        	//$mail->SMTPDebug = 2; 
        	$mail->Username = "dishchord3@gmail.com";
        	$mail->Password = "ojek tact tmlm mere";
        	$mail->SetFrom("dishchord3@gmail.com");

            $mail->AddAddress("$email");

        $code = rand(999999, 111111);
        $insert_code = "UPDATE users SET code = $code WHERE email = '$email'";
        $run_query =  mysqli_query($con, $insert_code);
        
            if($run_query){
                $subject = "Password Reset Code";
        $mail->Subject = $subject;
        $message = "Your password reset code is $code";
        $mail->Body = $message;
        $mail->SMTPOptions=array('ssl'=>array(
            'verify_peer'=>false,
            'verify_peer_name'=>false,
            'allow_self_signed'=>false
        ));     if(!$mail->Send()){
            $errors['otp-error'] = "Failed while sending code!";
        }else{
            $info = "We've sent a passwrod reset otp to your email - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: reset-code.php');
                    exit();
        }
            }else{
                $errors['db-error'] = "Something went wrong!";
            }
        }else{
            $errors['email'] = "This email address does not exist!";
        }
    }

    //if users click check reset otp button
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM users WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: new-password.php');
            exit();
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //if users click change password button
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
        if(!preg_match('/^.{6,32}$/', $password)){
            $em = 'Password must be 6 to 32 characters long ';
            header("Location: ../signup.php?error=$em&$data");
              exit;
          }
        else if($password !== $cpassword){
            $errors['password'] = "Confirm password not matched!";
        }else{
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            // $status = "verified";
            $update_pass = "UPDATE users SET code = $code, password = '$encpass' WHERE email = '$email'";
            $run_query = mysqli_query($con, $update_pass);
            if($run_query){
                $info = "Your password changed. Now you can login with your new password.";
                $_SESSION['info'] = $info;
                header('Location: password-changed.php');
            }else{
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }
    
   //if login now button click
    if(isset($_POST['login-now'])){
        header('Location: login.php');
    }
?>
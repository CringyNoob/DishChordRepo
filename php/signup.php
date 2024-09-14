<?php

if (isset($_POST['fname']) && 
    isset($_POST['uname']) &&  
    isset($_POST['pass']) &&
    isset($_POST['email'])) {

    include "../db_conn.php";

    $fname = $_POST['fname'];
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];
    $email = $_POST['email'];

    $data = "fname=" . urlencode($fname) . "&email=" . urlencode($email) . "&uname=" . urlencode($uname);

    if (empty($fname)) {
        $em = "Full name is required";
        header("Location: ../signup.php?error=$em&$data");
        exit;
    } else if (empty($email)) {
        $em = "Email is required";
        header("Location: ../signup.php?error=$em&$data");
        exit;
    } else if (empty($uname)) {
        $em = "User name is required";
        header("Location: ../signup.php?error=$em&$data");
        exit;
    } else if (empty($pass)) {
        $em = "Password is required";
        header("Location: ../signup.php?error=$em&$data");
        exit;
    } else if (!preg_match('/^[a-zA-Z\s]+$/', $fname)) {
        $em = 'Full name must be letters and spaces only';   
        header("Location: ../signup.php?error=$em&$data");
        exit;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $em = 'Email must be a valid email address';
        header("Location: ../signup.php?error=$em&$data");
        exit;
    } else if (!preg_match('/^[0-9A-Za-z]{3,16}$/', $uname)) {
        $em = 'Username must be 3 to 16 characters long and 0-9/A-Z/a-z only';
        header("Location: ../signup.php?error=$em&$data");
        exit;
    } else if (!preg_match('/^.{6,32}$/', $pass)) {
        $em = 'Password must be 6 to 32 characters long';
        header("Location: ../signup.php?error=$em&$data");
        exit;
    }

    // Check if email or username already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
    $stmt->execute([$email, $uname]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if ($user['email'] === $email) {
            $em = 'Email already in use';
        } else {
            $em = 'Username already in use';
        }
        header("Location: ../signup.php?error=$em&$data");
        exit;
    }

    // Hashing the password
    $pass = password_hash($pass, PASSWORD_DEFAULT);

    if (isset($_FILES['pp']['name']) AND !empty($_FILES['pp']['name'])) {
        $img_name = $_FILES['pp']['name'];
        $tmp_name = $_FILES['pp']['tmp_name'];
        $error = $_FILES['pp']['error'];

        if ($error === 0) {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_to_lc = strtolower($img_ex);

            $allowed_exs = array('jpg', 'jpeg', 'png');
            if (in_array($img_ex_to_lc, $allowed_exs)) {
                $new_img_name = uniqid($uname, true) . '.' . $img_ex_to_lc;
                $img_upload_path = '../upload/' . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                // Insert into Database
                $sql = "INSERT INTO users(fname, email, username, password, pp) VALUES(?,?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$fname, $email, $uname, $pass, $new_img_name]);

                header("Location: ../signup.php?success=Your account has been created successfully");
                exit;
            } else {
                $em = "You can't upload files of this type";
                header("Location: ../signup.php?error=$em&$data");
                exit;
            }
        } else {
            $em = "Unknown error occurred!";
            header("Location: ../signup.php?error=$em&$data");
            exit;
        }
    } else {
        $sql = "INSERT INTO users(fname, email, username, password) VALUES(?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$fname, $email, $uname, $pass]);

        header("Location: ../signup.php?success=Your account has been created successfully");
        exit;
    }

} else {
    header("Location: ../signup.php?error=error");
    exit;
}


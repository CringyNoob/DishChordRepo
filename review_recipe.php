<?php
session_start();
include 'db_conn.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $recipe_id = $_POST['recipe_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    $stmt = $con->prepare("INSERT INTO reviews (recipe_id, user_id, rating, comment) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiis", $recipe_id, $user_id, $rating, $comment);

    if ($stmt->execute()) {
        echo "Review posted successfully!";
    } else {
        echo "Error posting review: " . $stmt->error;
    }
}
?>

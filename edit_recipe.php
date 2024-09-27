<?php
session_start();
include 'db_conn.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $recipe_id = $_POST['recipe_id'];
    $recipe_name = $_POST['recipe_name'];
    $ingredients = $_POST['ingredients'];
    $description = $_POST['description'];

    // Nutrition values
    $protein = $_POST['protein'];
    $calories = $_POST['calories'];
    $sugar = $_POST['sugar'];
    $carbs = $_POST['carbs'];
    $vitamins = $_POST['vitamins'];
    $minerals = $_POST['minerals'];
    $potassium = $_POST['potassium'];
    $sodium = $_POST['sodium'];
    $nitrogen = $_POST['nitrogen'];

    // Update the recipe
    $stmt = $con->prepare("UPDATE recipes SET recipe_name = ?, ingredients = ?, description = ?, protein = ?, calories = ?, sugar = ?, carbs = ?, vitamins = ?, minerals = ?, potassium = ?, sodium = ?, nitrogen = ? WHERE recipe_id = ?");
    $stmt->bind_param("sssddddddddddi", $recipe_name, $ingredients, $description, $protein, $calories, $sugar, $carbs, $vitamins, $minerals, $potassium, $sodium, $nitrogen, $recipe_id);

    if ($stmt->execute()) {
        echo "Recipe updated successfully!";
    } else {
        echo "Error updating recipe: " . $stmt->error;
    }
}
?>

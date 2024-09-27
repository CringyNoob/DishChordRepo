<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['fname'])) {
    include 'db_conn.php'; // Assuming this returns a PDO connection
    include 'php/User.php';

    $user = getUserById($_SESSION['id'], $conn); // Assuming getUserById works with PDO

    // Fetch categories from the database using PDO
    $stmtCategory = $conn->prepare("SELECT * FROM category"); // Assuming your category table is named 'category'
    $stmtCategory->execute();
    $categories = $stmtCategory->fetchAll(PDO::FETCH_ASSOC); // Fetch categories as an associative array

    // Fetch ingredients from the database using PDO
    $stmtIngredients = $conn->prepare("SELECT * FROM ingredients_nutrition ORDER BY ingredient_name"); // Assuming your ingredients table is named 'ingredients_nutrition'
    $stmtIngredients->execute();
    $ingredients = $stmtIngredients->fetchAll(PDO::FETCH_ASSOC); // Fetch ingredients as an associative array

    include "template/user_header.php";
?>

<!-- Include Select2 CSS and JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<style>
.upload-container {
    width: 60%;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

label {
    display: block;
    margin-top: 10px;
    font-weight: bold;
}

input[type="text"], input[type="number"], textarea {
    width: 100%;
    padding: 10px;
    margin: 5px 0 20px 0;
    border: 1px solid #ddd;
    border-radius: 4px;
}

select {
    width: 100%;
    padding: 10px;
    margin: 5px 0 20px 0;
    border: 1px solid #ddd;
    border-radius: 4px;
}

input[type="submit"] {
    width: 100%;
    background-color: #28a745;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #218838;
}

button.add-category, button.add-ingredient {
    margin-top: 10px;
    background-color: #007bff;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button.add-category:hover, button.add-ingredient:hover {
    background-color: #0056b3;
}

.select2-container {
    width: 100% !important;
}

.ingredient-row {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.ingredient-row select, .ingredient-row input[type="number"] {
    margin-right: 10px;
}

.ingredient-row input[type="number"] {
    width: 30%;
}
</style>

<script>
// Add more category dropdowns
function addCategoryDropdown() {
    var categoryContainer = document.getElementById('category-container');
    var newCategoryDiv = document.createElement('div');
    newCategoryDiv.innerHTML = `
        <select class="category-select" name="category_id[]" required>
            <option value="">Select a category</option>
            <?php foreach($categories as $row) {
                echo '<option value="'.$row['category_id'].'">'.$row['category_name'].'</option>';
            } ?>
        </select>`;
    categoryContainer.appendChild(newCategoryDiv);
    // Reinitialize Select2 for the new dropdown
    $('.category-select').select2();
}

// Add more ingredient dropdowns with quantity input
function addIngredientDropdown() {
    var ingredientContainer = document.getElementById('ingredient-container');
    var newIngredientDiv = document.createElement('div');
    newIngredientDiv.classList.add('ingredient-row');
    newIngredientDiv.innerHTML = `
        <select class="ingredient-select" name="ingredient_id[]" required>
            <option value="">Select an ingredient</option>
            <?php foreach($ingredients as $row) {
                echo '<option value="'.$row['ingredient_id'].'">'.$row['ingredient_name'].'</option>';
            } ?>
        </select>
        <input type="number" name="ingredient_quantity[]" placeholder="Quantity" min="1" step="any" required>`;
    ingredientContainer.appendChild(newIngredientDiv);
    // Reinitialize Select2 with the "tags" option for the new dropdown to make it typeable
    $('.ingredient-select').select2({
        tags: true,
        placeholder: 'Select or type ingredient'
    });
}

// Initialize Select2 for the first dropdowns on page load
$(document).ready(function() {
    $('.category-select').select2();
    $('.ingredient-select').select2({
        tags: true,
        placeholder: 'Select or type ingredient'
    });
});
</script>

<div class="container-xxl py-5 bg-dark hero-header mb-5">
    <div class="container text-center my-5 pt-5 pb-4">
        <h1 class="display-5 text-white mb-3 animated slideInDown">New Recipe</h1>
    </div>
</div>

<?php if ($user) { ?>
    <div class="upload-container">
        
        <form action="php/upload_recipe.php" method="POST">
            <label for="recipe_name">Recipe Name:</label>
            <input type="text" id="recipe_name" name="recipe_name" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>

            <!-- Category Dropdown Container -->
            <div id="category-container">
                <label for="category">Select Category:</label>
                <select class="category-select" name="category_id[]" required>
                    <option value="">Select a category</option>
                    <?php
                    foreach($categories as $row) {
                        echo '<option value="'.$row['category_id'].'">'.$row['category_name'].'</option>';
                    }
                    ?>
                </select>
            </div>
            <button type="button" class="add-category" onclick="addCategoryDropdown()">Add More Categories</button>

            <!-- Ingredient Dropdown Container -->
            <div id="ingredient-container">
                <label for="ingredient">Select Ingredient and Quantity:</label>
                <div class="ingredient-row">
                    <select class="ingredient-select" name="ingredient_id[]">
                        <option value="">Select an ingredient</option>
                        <?php
                        foreach($ingredients as $row) {
                            echo '<option value="'.$row['ingredient_id'].'">'.$row['ingredient_name'].'</option>';
                        }
                        ?>
                    </select>
                    <input type="number" name="ingredient_quantity[]" placeholder="Quantity(gram)" min="1" step="any" required>
                </div>
            </div>
            <button type="button" class="add-ingredient" onclick="addIngredientDropdown()">Add More Ingredients</button>
            
            <label for="servings">Servings:</label>
            <input type="text" id="servings" name="servings" required>

            <div class="mb-3">
		    <label class="form-label" style="font-size:25px">Recipe Picture</label>
		    <input type="file" 
		           class="form-control"
		           name="picture">
		    </div>

            <input type="submit" value="Upload Recipe">
        </form>
    </div>

<?php } else { 
    header("Location: home.php");
    exit;
} 
include "template/footer.php"; ?>

</html>

<?php } else {
    header("Location: home.php");
    exit;
} ?>
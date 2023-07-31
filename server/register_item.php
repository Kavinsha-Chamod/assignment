<?php
include "functions.php";

$categories = getCategories();
$subcategories = getSubcategories();

if (isset($_POST["add_item"])) {
    $itemCode = $_POST["item_code"];
    $itemName = $_POST["item_name"];
    $itemCategory = $_POST["item_category"];
    $itemSubCategory = $_POST["item_subcategory"];
    $quantity = $_POST["quantity"];
    $unitPrice = $_POST["unit_price"];

    insertItem($itemCode, $itemName, $itemCategory, $itemSubCategory, $quantity, $unitPrice);
    
    session_start();
    $_SESSION["success_message"] = "Item added successfully!";

    header("Location: register_item.php");
    exit;
}
$items = getItems();
?>

<!DOCTYPE html>
<html>
<head>
    <title>ERP SYSTEM</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        h2 {
            margin-bottom: 20px;
        }
        .form-control {
            border-radius: 8px;
        }
        .form-label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 8px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        th {
            text-align: center;
            background-color: #f8f9fa;
        }
        td {
            vertical-align: middle;
            text-align: center;
        }
        #updateForm {
            margin-top: 30px;
            display: none;
        }
    </style>
</head>
<body>
<div class="col-md-6 col-lg-4">
                <a href="dashboard.html" class="btn btn-dashboard">
                    <div class="btn-text">Home</div>
                </a>
             </div>
    <div class="container mt-5">
        <form method="post" action="register_item.php">
            <h2 class="text-center">Add New Item</h2>
            <div class="form-group">
                <label>Item Code:</label>
                <input type="text" class="form-control" name="item_code" required>
            </div>
            <div class="form-group">
                <label>Item Name:</label>
                <input type="text" class="form-control" name="item_name" required>
            </div>
            <div class="form-group">
                <label>Item Category:</label>
                <select class="form-control" name="item_category" required>
                    <option value="">Select Category</option>
                    <?php
                    foreach ($categories as $categoryId => $categoryName) {
                        echo "<option value='" . $categoryId . "'>" . $categoryName . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Item Sub Category:</label>
                <select class="form-control" name="item_subcategory" required>
                    <option value="">Select Sub Category</option>
                    <?php
                    foreach ($subcategories as $subcategoryId => $subcategoryName) {
                        echo "<option value='" . $subcategoryId . "'>" . $subcategoryName . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Quantity:</label>
                <input type="number" class="form-control" name="quantity" required>
            </div>
            <div class="form-group">
                <label>Unit Price:</label>
                <input type="number" step="0.01" class="form-control" name="unit_price" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary" name="add_item">Add Item</button>
            </div>
        </form>
    </div>
   <?php
    session_start();
    if (isset($_SESSION["success_message"])) {
        echo '<script>alert("' . $_SESSION["success_message"] . '");</script>';
        unset($_SESSION["success_message"]);
    }
    ?>
</body>
</html>
<?php
include "functions.php";

// Handle form submission for updating item
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update_item"])) {
    $itemId = $_POST["id"];
    $itemCode = $_POST["item_code"];
    $itemName = $_POST["item_name"];
    $itemCategory = $_POST["item_category"];
    $itemSubCategory = $_POST["item_subcategory"];
    $quantity = $_POST["quantity"];
    $unitPrice = $_POST["unit_price"];

    updateItem($itemId, $itemCode, $itemName, $itemCategory, $itemSubCategory, $quantity, $unitPrice);

    header("Location: update_item.php");
    exit;
}

// Handle item deletion
if (isset($_GET["delete_item"])) {
    $itemId = $_GET["delete_item"];
    deleteItem($itemId);
}

// Fetch all items from the database
$items = getItems();
?>

<!DOCTYPE html>
<html>
<head>
    <title>ERP SYSTEM</title>
    <!-- Include Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Custom CSS style -->
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
        th {
            text-align: center;
            background-color: #f8f9fa;
        }
        td {
            vertical-align: middle;
            text-align: center;
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
    </style>
</head>
<body>
    <div class="container mt-5">
        <!-- Table to display list of items -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Item Code</th>
                    <th>Item Name</th>
                    <th>Item Category</th>
                    <th>Item Sub Category</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($items as $item) {
                    echo "<tr>";
                    echo "<td>" . $item["item_code"] . "</td>";
                    echo "<td>" . $item["item_name"] . "</td>";
                    echo "<td>" . $item["item_category"] . "</td>";
                    echo "<td>" . $item["item_subcategory"] . "</td>";
                    echo "<td>" . $item["quantity"] . "</td>";
                    echo "<td>" . $item["unit_price"] . "</td>";
                    echo "<td>";
                    // Display the "Update" button with the onclick event
                    echo "<button onclick='showUpdateForm(\"" . $item["id"] . "\",\"" . $item["item_code"] . "\", \"" . $item["item_name"] . "\", \"" . $item["item_category"] . "\", \"" . $item["item_subcategory"] . "\", \"" . $item["quantity"] . "\", \"" . $item["unit_price"] . "\")' class='btn btn-primary'>Update</button>";
                    // Display the "Delete" button
                    echo '<a href="update_item.php?delete_item=' . $item["id"] . '" class="btn btn-danger">Delete</a>';
                    echo "</td>";
                    echo "</tr>";   
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Hidden form for updating item data -->
    <div id="updateForm" style="display:none;">
        <h2>Update Item</h2>
        <form method="post" action="update_item.php">
            <input type="hidden" name="id" id="item_id">
            <div class="form-group">
                <label>Item Code:</label>
                <input type="text" name="item_code" id="item_code" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Item Name:</label>
                <input type="text" name="item_name" id="item_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Item Category:</label>
                <input type="text" name="item_category" id="item_category" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Item Sub Category:</label>
                <input type="text" name="item_subcategory" id="item_subcategory" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Quantity:</label>
                <input type="number" name="quantity" id="quantity" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Unit Price:</label>
                <input type="number" name="unit_price" id="unit_price" class="form-control" required>
            </div>
            <button type="submit" name="update_item" class="btn btn-primary">Update Item</button>
        </form>
    </div>

    <!-- Include Bootstrap JS and jQuery links here -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Function to show the update form with pre-filled data
        function showUpdateForm(itemId, itemCode, itemName, itemCategory, itemSubCategory, quantity, unitPrice) {
            $("#item_id").val(itemId);
            $("#item_code").val(itemCode);
            $("#item_name").val(itemName);
            $("#item_category").val(itemCategory);
            $("#item_subcategory").val(itemSubCategory);
            $("#quantity").val(quantity);
            $("#unit_price").val(unitPrice);
            $("#updateForm").show();
        }
    </script>
</body>
</html>

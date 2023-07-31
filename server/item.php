<?php
include "functions.php";

// Handle form submission for adding new item
if (isset($_POST["add_item"])) {
    $itemCode = $_POST["item_code"];
    $itemName = $_POST["item_name"];
    $itemCategory = $_POST["item_category"];
    $itemSubCategory = $_POST["item_subcategory"];
    $quantity = $_POST["quantity"];
    $unitPrice = $_POST["unit_price"];

    insertItem($itemCode, $itemName, $itemCategory, $itemSubCategory, $quantity, $unitPrice);
}

// Handle form submission for updating item
if (isset($_POST["update_item"])) {
    $itemId = $_POST["id"];
    $itemCode = $_POST["item_code"];
    $itemName = $_POST["item_name"];
    $itemCategory = $_POST["item_category"];
    $itemSubCategory = $_POST["item_subcategory"];
    $quantity = $_POST["quantity"];
    $unitPrice = $_POST["unit_price"];

    updateItem($itemId, $itemCode, $itemName, $itemCategory, $itemSubCategory, $quantity, $unitPrice);
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
    <!-- Include Bootstrap and CSS links here -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Item Management</h2>

        <!-- Add new item form -->
        <form method="post" action="item.php">
            <h3>Add New Item</h3>
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
                <input type="text" class="form-control" name="item_category" required>
            </div>
            <div class="form-group">
                <label>Item Sub Category:</label>
                <input type="text" class="form-control" name="item_subcategory">
            </div>
            <div class="form-group">
                <label>Quantity:</label>
                <input type="number" class="form-control" name="quantity" required>
            </div>
            <div class="form-group">
                <label>Unit Price:</label>
                <input type="number" step="0.01" class="form-control" name="unit_price" required>
            </div>
            <button type="submit" class="btn btn-primary" name="add_item">Add Item</button>
        </form>

        <!-- Table to display list of items -->
        <table class="table mt-3">
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
                    echo "<td>
                            <a href=\"item.php?update_item=" . $item["id"] . "\">Update</a>
                            <a href=\"item.php?delete_item=" . $item["id"] . "\">Delete</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Include Bootstrap JS and jQuery links -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
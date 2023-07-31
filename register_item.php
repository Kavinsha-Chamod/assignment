<?php
include "functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemCode = $_POST["item_code"];
    $itemName = $_POST["item_name"];
    $itemCategory = $_POST["item_category"];
    $itemSubCategory = $_POST["item_subcategory"];
    $quantity = $_POST["quantity"];
    $unitPrice = $_POST["unit_price"];

    // Perform server-side validation here if needed

    // Insert the item into the database
    insertItem($itemCode, $itemName, $itemCategory, $itemSubCategory, $quantity, $unitPrice);
}

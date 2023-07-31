<?php
include "connection.php";

function insertCustomer($title, $firstName, $middleName, $lastName, $contactNumber, $district) {
    global $conn;
    $sql = "INSERT INTO customer (title, first_name, middle_name, last_name, contact_no, district)
            VALUES ('$title', '$firstName', '$middleName', '$lastName', '$contactNumber', '$district')";
    return $conn->query($sql);
}

function insertItem($itemCode, $itemName, $itemCategory, $itemSubCategory, $quantity, $unitPrice) {
    global $conn;
    $sql = "INSERT INTO item (item_code, item_name, item_category, item_subcategory, quantity, unit_price)
            VALUES ('$itemCode', '$itemName', '$itemCategory', '$itemSubCategory', $quantity, $unitPrice)";

    return $conn->query($sql);
}

// Similar functions for updating and deleting customers and items

function updateCustomer($customerId, $title, $firstName, $middleName, $lastName, $contactNumber, $district) {
  global $conn;
  $sql = "UPDATE customer
          SET title = '$title', 
              first_name = '$firstName', 
              middle_name = '$middleName',
              last_name = '$lastName', 
              contact_no = '$contactNumber', 
              district = '$district'
          WHERE id = $customerId";

  return $conn->query($sql);
}

function deleteCustomer($customerId) {
  global $conn;
  $sql = "DELETE FROM customer WHERE id = $customerId";

  return $conn->query($sql);
}

// Functions for Task 2 (Item)

function updateItem($itemId, $itemCode, $itemName, $itemCategory, $itemSubCategory, $quantity, $unitPrice) {
  global $conn;
  $sql = "UPDATE item
          SET item_code = '$itemCode', 
              item_name = '$itemName', 
              item_category = '$itemCategory', 
              item_subcategory = '$itemSubCategory', 
              quantity = $quantity, 
              unit_price = $unitPrice
          WHERE id = $itemId";

  return $conn->query($sql);
}

function deleteItem($itemId) {
  global $conn;
  $sql = "DELETE FROM item WHERE id = $itemId";

  return $conn->query($sql);
}


function getCustomers() {
    global $conn;
    $sql = "SELECT * FROM customer";
    $result = $conn->query($sql);

    $customer = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $customer[] = $row;
        }
    }

    return $customer;
}

function getItems() {
    global $conn;
    $sql = "SELECT * FROM item";
    $result = $conn->query($sql);

    $item = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $item[] = $row;
        }
    }

    return $item;
}

// Function to get invoice report
function getInvoiceReport($startDate, $endDate) {
  global $conn;
  $sql = "SELECT i.invoice_number, i.invoice_date, c.first_name, c.last_name, c.district,
                 COUNT(ii.item_id) AS item_count, SUM(ii.quantity * ii.unit_price) AS invoice_amount
          FROM invoice i
          INNER JOIN customer c ON i.id = c.id
          INNER JOIN invoice_items ii ON i.id = ii.id
          WHERE i.invoice_date BETWEEN '$startDate' AND '$endDate'
          GROUP BY i.invoice_id";

  $result = $conn->query($sql);
  $invoiceReport = array();
  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          $invoiceReport[] = $row;
      }
  }

  return $invoiceReport;
}

// Function to get invoice item report
function getInvoiceItemReport($startDate, $endDate) {
  global $conn;
  $sql = "SELECT i.invoice_number, i.invoice_date, c.first_name, c.last_name,
                 ii.item_name, ii.item_code, ii.item_category, ii.unit_price
          FROM invoice i
          INNER JOIN customer c ON i.id = c.id
          INNER JOIN invoice_master     ii ON i.id = ii.id
          WHERE i.invoice_date BETWEEN '$startDate' AND '$endDate'";

  $result = $conn->query($sql);
  $invoiceItemReport = array();
  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          $invoiceItemReport[] = $row;
      }
  }

  return $invoiceItemReport;
}

// Function to get item report
function getItemReport() {
  global $conn;
  $sql = "SELECT DISTINCT item_name, item_category, item_subcategory, SUM(quantity) AS item_quantity
          FROM item
          GROUP BY item_name, item_category, item_subcategory";

  $result = $conn->query($sql);
  $itemReport = array();
  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          $itemReport[] = $row;
      }
  }

  return $itemReport;
}
function getCustomerById($customerId)
{
    // Replace the following lines with your actual database query to fetch the customer by ID
    // Make sure to use prepared statements to prevent SQL injection
    $pdo = new PDO("mysql:host=localhost;dbname=assignmnet", "root", "root");
    $sql = "SELECT * FROM customer WHERE id = customer_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam("customer_id", $customerId, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the customer data as an associative array
    $customer = $stmt->fetch(PDO::FETCH_ASSOC);

    // Return the customer data or null if not found
    return $customer ? $customer : null;
}




?>

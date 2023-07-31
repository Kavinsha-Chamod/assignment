<?php
include "connection.php";

function insertCustomer($title, $firstName,  $lastName, $contactNumber, $district) {
    global $conn;
    $sql = "INSERT INTO customer (title, first_name, last_name, contact_no, district)
            VALUES ('$title', '$firstName',  '$lastName', '$contactNumber', '$district')";
    return $conn->query($sql);
}
//===========================================================================================================
function insertItem($itemCode, $itemName, $itemCategory, $itemSubCategory, $quantity, $unitPrice) {
    global $conn;
    $sql = "INSERT INTO item (item_code, item_name, item_category, item_subcategory, quantity, unit_price)
            VALUES ('$itemCode', '$itemName', '$itemCategory', '$itemSubCategory', $quantity, $unitPrice)";

    return $conn->query($sql);
}

// Similar functions for updating and deleting customers and items
function updateCustomer($customerId, $title, $firstName, $middleName, $lastName, $contactNumber, $district)
{
    // Assuming you have already established a database connection using PDO or MySQLi
    $pdo = new PDO("mysql:host=localhost;dbname=assignment", "root", "root");

    // Prepare the SQL statement with placeholders to avoid SQL injection
    $sql = "UPDATE customer SET title = :title, first_name = :first_name, last_name = :last_name, middle_name = :middle_name, 
    contact_no = :contact_no, district = :district WHERE id = :customer_id";
    $stmt = $pdo->prepare($sql);

    // Bind the parameters to the prepared statement
    $stmt->bindParam(":title", $title, PDO::PARAM_STR);
    $stmt->bindParam(":first_name", $firstName, PDO::PARAM_STR);
    $stmt->bindParam(":middle_name", $middleName, PDO::PARAM_STR);
    $stmt->bindParam(":last_name", $lastName, PDO::PARAM_STR);
    $stmt->bindParam(":contact_no", $contactNumber, PDO::PARAM_STR);
    $stmt->bindParam(":district", $district, PDO::PARAM_STR);
    $stmt->bindParam(":customer_id", $customerId, PDO::PARAM_INT);

    // Execute the prepared statement
    try {
        $stmt->execute();
        return true; // Return true if the update is successful
    } catch (PDOException $e) {
        // Handle any errors that occur during the query execution
        error_log("Error updating customer: " . $e->getMessage());
        return false; // Return false if the update fails
    }
    
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
function getCategories()
{
    global $conn;
    $sql = "SELECT id,category FROM item_category";
    $result = $conn->query($sql);

    $categories = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categories[$row['id']] = $row['id'];
        }
    }

    return $categories;
}

function getSubcategories()
{
    global $conn; 

    $sql = "SELECT id,sub_category FROM item_subcategory";
    $result = $conn->query($sql);

    $subcategories = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $subcategories[$row['id']] = $row['id'];
        }
    }
    return $subcategories;
}
//===========================================================================================================
// Function to get invoice report
function getInvoiceReport($startDate, $endDate) {
  global $conn;
  $sql = "SELECT i.invoice_no, i.date, c.first_name, c.last_name, c.district,
                 COUNT(im.id) AS item_count, SUM(im.quantity * im.unit_price) AS invoice_amount
          FROM invoice i
          INNER JOIN customer c ON i.id = c.id
          INNER JOIN invoice_master im ON i.id = im.id
          WHERE i.date BETWEEN '$startDate' AND '$endDate'
          GROUP BY i.id";

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
  $sql = "SELECT i.invoice_no, i.date, c.first_name, c.last_name,
                 ii.item_name, ii.item_code, ii.item_category, ii.unit_price
          FROM invoice i
          INNER JOIN customer c ON i.id = c.id
          INNER JOIN item     ii ON i.id = ii.id
          WHERE i.date BETWEEN '$startDate' AND '$endDate'";

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
?>

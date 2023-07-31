<?php
// Include functions.php to access database functions
include "functions.php";

// Handle customer update
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update_customer"])) {
    $customerId = $_POST["id"];
    $title = $_POST["title"];
    $firstName = $_POST["first_name"];
    $middleName = $_POST["middle_name"];
    $lastName = $_POST["last_name"];
    $contactNumber = $_POST["contact_no"];
    $district = $_POST["district"];

    updateCustomer($customerId, $title, $firstName, $middleName, $lastName, $contactNumber, $district);

    header("Location: update_customer.php");
    exit;

}


// Handle customer deletion
if (isset($_GET["delete_customer"])) {
    $customerId = $_GET["delete_customer"];
    deleteCustomer($customerId);
    header("Location: update_customer.php");
    exit;
}

// Fetch all customers from the database
$customers = getCustomers();
?>


<!DOCTYPE html>
<html>
<head>
    <title>ERP SYSTEM</title>
    <!-- Include Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="col-md-6 col-lg-4">
                <a href="dashboard.html" class="btn btn-dashboard">
                    <div class="btn-text">Home</div>
                </a>
             </div>
        <!-- Display list of registered customers -->
        <h2>Registered Customers</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Contact Number</th>
                    <th>District</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($customers as $customer) {
                    echo "<tr>";
                    echo "<td>" . $customer["title"] . "</td>";
                    echo "<td>" . $customer["first_name"] . "</td>";
                    echo "<td>" . $customer["middle_name"] . "</td>";
                    echo "<td>" . $customer["last_name"] . "</td>";
                    echo "<td>" . $customer["contact_no"] . "</td>";
                    echo "<td>" . $customer["district"] . "</td>";
                    echo "<td>";
                    // Display the "Update" button with the onclick event
                    echo "<button onclick='showUpdateForm(\"" . $customer["id"] . "\",\"" . $customer["title"] . "\",\"" . $customer["first_name"] . "\", \"" . $customer["middle_name"] . "\", \"" . $customer["last_name"] . "\",\"" . $customer["contact_no"] . "\", \"" . $customer["district"] . "\")' class='btn btn-sm btn-info'>Update</button>";
                    // Display the "Delete" button
                    echo '<a href="update_customer.php?delete_customer=' . $customer["id"] . '" class="btn btn-sm btn-danger">Delete</a>';
                    echo "</td>";
                    echo "</tr>";   
                }
                ?>
            </tbody>
        </table>

        <!-- Hidden form for updating customer data -->
        <div id="updateForm" style="display:none;">
            <h2>Update Customer</h2>
            <form method="post" action="update_customer.php">
                <input type="hidden" name="id" id="customer_id">
                <label>Title:</label>
                <select name="title" id="title" class="form-control">
                    <option value="Mr">Mr</option>
                    <option value="Mrs">Mrs</option>
                    <option value="Miss">Miss</option>
                    <option value="Dr">Dr</option>
                </select><br>
                <label>First Name:</label>
                <input type="text" name="first_name" id="first_name" class="form-control" required><br>
                <label>Middle Name:</label>
                <input type="text" name="middle_name" id="middle_name" class="form-control" required><br>
                <label>Last Name:</label>
                <input type="text" name="last_name" id="last_name" class="form-control" required><br>
                <label>Contact Number:</label>
                <input type="text" name="contact_no" id="contact_no" class="form-control"><br>
                <label>District:</label>
                <input type="text" name="district" id="district" class="form-control"><br>
                <button type="submit" class="btn btn-success" name="update_customer">Update Customer</button>
            </form>
        </div>
    </div>

    <!-- Include Bootstrap JS and jQuery links here -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
        // Function to show the update form with pre-filled data
        function showUpdateForm(customerId,title, firstName, middleName, lastName, contactNumber, district) {
            $("#customer_id").val(customerId);
            $("#title").val($("#title option:contains('" + title + "')").val());
            $("#first_name").val(firstName);
            $("#middle_name").val(middleName);
            $("#last_name").val(lastName);
            $("#contact_no").val(contactNumber);
            $("#district").val(district);
            $("#updateForm").show();
        }
        
    </script>
    
</body>
</html>


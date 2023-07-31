<?php
// Include functions.php to access database functions
include "functions.php";

// Handle customer update
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update_customer"])) {
    $customerId = $_POST["customer_id"];
    $title = $_POST["title"];
    $firstName = $_POST["first_name"];
    $middleName = $_POST["middle_name"];
    $lastName = $_POST["last_name"];
    $contactNumber = $_POST["contact_no"];
    $district = $_POST["district"];

    // Call the function to update the customer data
    updateCustomer($customerId, $title, $firstName, $middleName, $lastName, $contactNumber, $district);

    // Redirect to the same page after the update to prevent form resubmission
    header("Location: customer.php");
    exit;
}

// Handle customer deletion
if (isset($_GET["delete_customer"])) {
    $customerId = $_GET["delete_customer"];
    deleteCustomer($customerId);
    header("Location: customer.php");
    exit;
}

// Fetch all customers from the database
$customers = getCustomers();
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Include Bootstrap and CSS links here -->
</head>
<body>
    <!-- Customer registration form -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <!-- Form fields for customer data -->
        <label>Title:</label>
        <select name="title">
            <option value="Mr">Mr</option>
            <option value="Mrs">Mrs</option>
            <option value="Miss">Miss</option>
            <option value="Dr">Dr</option>
        </select><br>

        <label>First Name:</label>
        <input type="text" name="first_name" required><br>

        <label>Middle Name:</label>
        <input type="text" name="middle_name" required><br>

        <label>Last Name:</label>
        <input type="text" name="last_name" required><br>

        <label>Contact Number:</label>
        <input type="text" name="contact_no"><br>

        <label>District:</label>
        <input type="text" name="district"><br>

        <input type="submit" value="Register Customer">
    </form>

    <!-- Display list of registered customers -->
    <h2>List of Customers</h2>
    <table>
        <tr>
            <th>Title</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Last Name</th>
            <th>Contact Number</th>
            <th>District</th>
            <th>Actions</th>
        </tr>
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
            echo "<button onclick='showUpdateForm(" . $customer["id"] . ")'>Update</button>";
            // Display the "Delete" button
            echo '<a href="index.php?delete_customer=' . $customer["id"] . '">Delete</a>';
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <!-- Hidden form for updating customer data -->
    <div id="updateForm" style="display:none;">
        <h2>Update Customer</h2>
        <form method="post" action="customer.php">
            <input type="hidden" name="customer_id" id="id">
            <label>Title:</label>
            <select name="title" id="title">
                <option value="Mr">Mr</option>
                <option value="Mrs">Mrs</option>
                <option value="Miss">Miss</option>
                <option value="Dr">Dr</option>
            </select><br>
            <label>First Name:</label>
            <input type="text" name="first_name" id="first_name" required><br>
            <label>Middle Name:</label>
            <input type="text" name="middle_name" id="middle_name" required><br>
            <label>Last Name:</label>
            <input type="text" name="last_name" id="last_name" required><br>
            <label>Contact Number:</label>
            <input type="text" name="contact_no" id="contact_no"><br>
            <label>District:</label>
            <input type="text" name="district" id="district"><br>
            <input type="submit" value="Update Customer" name="update_customer">
        </form>
    </div>

    <!-- Include Bootstrap and CSS links here -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Function to show the update form with pre-filled data
        function showUpdateForm(customerId) {
            var customer = findCustomerById(customerId);
            if (customer) {
                $("#customer_id").val(customer.id);
                $("#title").val(customer.title);
                $("#first_name").val(customer.first_name);
                $("#middle_name").val(customer.middle_name);
                $("#last_name").val(customer.last_name);
                $("#contact_no").val(customer.contact_no);
                $("#district").val(customer.district);
                $("#updateForm").show();
            }
        }

        // Function to find a customer by ID from the PHP array
        function findCustomerById(customerId) {
            var customers = <?php echo json_encode($customers); ?>;
            return customers.find(function (customer) {
                return customer.id === customerId;
            });
        }
    </script>
</body>
</html>

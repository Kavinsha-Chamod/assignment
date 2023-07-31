<?php
include "functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $title = $_POST["title"];
    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];
    $contactNumber = $_POST["contact_no"];
    $district = $_POST["district"];

    insertCustomer($title, $firstName, $lastName, $contactNumber, $district);
    
    session_start();
    $_SESSION["success_message"] = "Customer registered successfully!";

    header("Location: register_customer.php");
    exit;
}
$customers = getCustomers();
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
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="mb-4">
            <h2 class="text-center">Customer Registration</h2>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label form-label">Title:</label>
                <div class="col-sm-2">
                    <select name="title" class="form-control">
                        <option value="Mr">Mr</option>
                        <option value="Mrs">Mrs</option>
                        <option value="Miss">Miss</option>
                        <option value="Dr">Dr</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label form-label">First Name:</label>
                <div class="col-sm-4">
                    <input type="text" name="first_name" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label form-label">Last Name:</label>
                <div class="col-sm-4">
                    <input type="text" name="last_name" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label form-label">Contact Number:</label>
                <div class="col-sm-4">
                    <input type="text" name="contact_no" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label form-label">District:</label>
                <div class="col-sm-4">
                    <input type="text" name="district" class="form-control" required>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Register Customer</button>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <?php
    session_start();
    if (isset($_SESSION["success_message"])) {
        echo '<script>alert("' . $_SESSION["success_message"] . '");</script>';
        unset($_SESSION["success_message"]);
    }
    ?>
</body>
</html>


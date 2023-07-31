<?php
include "functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $firstName = $_POST["first_name"];
    $middleName = $_POST["middle_name"];
    $lastName = $_POST["last_name"];
    $contactNumber = $_POST["contact_number"];
    $district = $_POST["district"];

    // Perform server-side validation here if needed

    // Insert the customer into the database
    insertCustomer($title, $firstName, $middleName, $lastName, $contactNumber, $district);
}

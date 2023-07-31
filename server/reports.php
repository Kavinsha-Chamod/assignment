<?php
include "functions.php";

// Handle form submission for invoice report
if (isset($_POST["invoice_search"])) {
    $startDate = $_POST["start_date"];
    $endDate = $_POST["end_date"];
    $invoiceReport = getInvoiceReport($startDate, $endDate);
}

// Handle form submission for invoice item report
if (isset($_POST["item_invoice_search"])) {
    $startDate = $_POST["start_date"];
    $endDate = $_POST["end_date"];
    $invoiceItemReport = getInvoiceItemReport($startDate, $endDate);
}

// Fetch item report data
$itemReport = getItemReport();
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Include Bootstrap and CSS links here -->
</head>
<body>
    <!-- Invoice report -->
    <h2>Invoice Report</h2>
    <form method="post" action="reports.php">
        <!-- Form fields for date range -->
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date">
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date">
        <input type="submit" name="invoice_search" value="Generate Report">
    </form>

    <table>
        <!-- Table headers for invoice report -->
        <tr>
            <th>Invoice Number</th>
            <th>Date</th>
            <th>Customer</th>
            <th>Customer District</th>
            <th>Item Count</th>
            <th>Invoice Amount</th>
        </tr>
        <?php
        if (isset($invoiceReport)) {
            foreach ($invoiceReport as $invoice) {
                echo "<tr>";
                echo "<td>" . $invoice["invoice_number"] . "</td>";
                echo "<td>" . $invoice["invoice_date"] . "</td>";
                echo "<td>" . $invoice["first_name"] . " " . $invoice["last_name"] . "</td>";
                echo "<td>" . $invoice["district"] . "</td>";
                echo "<td>" . $invoice["item_count"] . "</td>";
                echo "<td>" . $invoice["invoice_amount"] . "</td>";
                echo "</tr>";
            }
        }
        ?>
    </table>

    <!-- Invoice item report -->
    <h2>Invoice Item Report</h2>
    <form method="post" action="reports.php">
        <!-- Form fields for date range -->
        <label for="item_start_date">Start Date:</label>
        <input type="date" id="item_start_date" name="start_date">
        <label for="item_end_date">End Date:</label>
        <input type="date" id="item_end_date" name="end_date">
        <input type="submit" name="item_invoice_search" value="Generate Report">
    </form>

    <table>
        <!-- Table headers for invoice item report -->
        <tr>
            <th>Invoice Number</th>
            <th>Invoiced Date</th>
            <th>Customer Name</th>
            <th>Item Name</th>
            <th>Item Code</th>
            <th>Item Category</th>
            <th>Item Unit Price</th>
        </tr>
        <?php
        if (isset($invoiceItemReport)) {
            foreach ($invoiceItemReport as $item) {
                echo "<tr>";
                echo "<td>" . $item["invoice_number"] . "</td>";
                echo "<td>" . $item["invoice_date"] . "</td>";
                echo "<td>" . $item["first_name"] . " " . $item["last_name"] . "</td>";
                echo "<td>" . $item["item_name"] . "</td>";
                echo "<td>" . $item["item_code"] . "</td>";
                echo "<td>" . $item["item_category"] . "</td>";
                echo "<td>" . $item["unit_price"] . "</td>";
                echo "</tr>";
            }
        }
        ?>
    </table>

    <!-- Item report -->
    <h2>Item Report</h2>
    <table>
        <!-- Table headers for item report -->
        <tr>
            <th>Item Name</th>
            <th>Item Category</th>
            <th>Item Sub Category</th>
            <th>Item Quantity</th>
        </tr>
        <?php
        foreach ($itemReport as $item) {
            echo "<tr>";
            echo "<td>" . $item["item_name"] . "</td>";
            echo "<td>" . $item["item_category"] . "</td>";
            echo "<td>" . $item["item_subcategory"] . "</td>";
            echo "<td>" . $item["item_quantity"] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>

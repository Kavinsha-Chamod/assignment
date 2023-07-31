<?php
include "functions.php";

if (isset($_POST["item_invoice_search"])) {
  $startDate = $_POST["start_date"];
  $endDate = $_POST["end_date"];
  $invoiceItemReport = getInvoiceItemReport($startDate, $endDate);
}

$itemReport = getItemReport();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Invoice Item Report</title>
    <!-- Include Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <!-- Invoice item report -->
        <h2>Invoice Item Report</h2>
        <form method="post" action="invoice_item_report.php" class="mb-4">
            <!-- Form fields for date range -->
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="item_start_date">Start Date:</label>
                    <input type="date" id="item_start_date" name="start_date" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label for="item_end_date">End Date:</label>
                    <input type="date" id="item_end_date" name="end_date" class="form-control">
                </div>
            </div>
            <button type="submit" name="item_invoice_search" class="btn btn-primary">Generate Report</button>
        </form>

        <table class="table table-striped">
            <!-- Table headers for invoice item report -->
            <thead>
                <tr>
                    <th>Invoice Number</th>
                    <th>Invoiced Date</th>
                    <th>Customer Name</th>
                    <th>Item Name</th>
                    <th>Item Code</th>
                    <th>Item Category</th>
                    <th>Item Unit Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($invoiceItemReport)) {
                    foreach ($invoiceItemReport as $item) {
                        echo "<tr>";
                        echo "<td>" . $item["invoice_no"] . "</td>";
                        echo "<td>" . $item["date"] . "</td>";
                        echo "<td>" . $item["first_name"] . " " . $item["last_name"] . "</td>";
                        echo "<td>" . $item["item_name"] . "</td>";
                        echo "<td>" . $item["item_code"] . "</td>";
                        echo "<td>" . $item["item_category"] . "</td>";
                        echo "<td>" . $item["unit_price"] . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Include Bootstrap and JavaScript links -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
include "functions.php";

if (isset($_POST["invoice_search"])) {
  $startDate = $_POST["start_date"];
  $endDate = $_POST["end_date"];
  $invoiceReport = getInvoiceReport($startDate, $endDate);
}
$itemReport = getItemReport();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Invoice Report</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Invoice Report</h2>
        <form method="post" action="invoice_report.php" class="mb-4">
            <!-- Form fields for date range -->
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="start_date">Start Date:</label>
                    <input type="date" id="start_date" name="start_date" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label for="end_date">End Date:</label>
                    <input type="date" id="end_date" name="end_date" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <input type="submit" name="invoice_search" value="Generate Report" class="btn btn-primary mt-4">
                </div>
            </div>
        </form>

        <table class="table table-striped">
            <!-- Table headers for invoice report -->
            <thead>
                <tr>
                    <th>Invoice Number</th>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Customer District</th>
                    <th>Item Count</th>
                    <th>Invoice Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($invoiceReport)) {
                    foreach ($invoiceReport as $invoice) {
                        echo "<tr>";
                        echo "<td>" . $invoice["invoice_no"] . "</td>";
                        echo "<td>" . $invoice["date"] . "</td>";
                        echo "<td>" . $invoice["first_name"] . " " . $invoice["last_name"] . "</td>";
                        echo "<td>" . $invoice["district"] . "</td>";
                        echo "<td>" . $invoice["item_count"] . "</td>";
                        echo "<td>" . $invoice["invoice_amount"] . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

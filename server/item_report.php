<?php
include "functions.php";

$itemReport = getItemReport();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Item Report</title>
    <!-- Include Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <!-- Item report -->
        <h2>Item Report</h2>
        <table class="table table-striped">
            <!-- Table headers for item report -->
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Item Category</th>
                    <th>Item Sub Category</th>
                    <th>Item Quantity</th>
                </tr>
            </thead>
            <tbody>
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
            </tbody>
        </table>
    </div>

    <!-- Include Bootstrap and JavaScript links -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

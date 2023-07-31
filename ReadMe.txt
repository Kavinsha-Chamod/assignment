ERP System using PHP and MySQL

Description

This is a simple ERP system built using PHP and MySQL to manage customer and item data. The system allows users to insert, update, delete, 
and search for customer and item records. Additionally, it provides three types of reports that are Invoice Report, Invoice Item Report, and Item Report.

Assumptions

1.PHP and MySQL are already installed on the local environment.
2.The database configuration is set correctly in the config.php file.
3.The required database tables (customer, district, invoice, invoice_master, item, item_category and item_subcategory) are created and populated with sample data.
	
How to Set Up the Project

1.Download the project files and place them in your local server's web directory (e.g., htdocs for XAMPP or www for WAMP).
2.Create a new MySQL database and import the provided SQL file (assignment(1).sql) to create the required tables and insert sample data.
3.Open the config.php file in the includes folder and update the database configuration with your MySQL credentials.
4.Start your local server (Apache and MySQL) and access the project in your web browser using the URL like http://localhost/assignment/server. 

Usage

1.Customer Task: 
                Access http://localhost/assignment/server/register_customer.php to register a new customer.
                Access http://localhost/assignment/server/update_customer.php to manage existing customers.

2.Item Task:
            Access http://localhost/assignment/server/register_item.php to register a new item.
            Access http://localhost/assignment/server/update_item.php to manage existing items.
			
3.Reports Task:
               Access http://localhost/assignment/server/invoice_report.php to generate the Invoice Report.
               Access http://localhost/assignment/server/invoice_item_report.php to generate the Invoice Item Report.
               Access http://localhost/assignment/server/item_report.php to generate the Item Report.
			   
Thankyou !
Happy Coding !!!
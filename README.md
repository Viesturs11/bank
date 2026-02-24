Setup Instructions

Install MAMP (Mac) or XAMPP (Windows)
Start Apache and MySQL
Create a database named bank
Import database/bank.sql into the database
Place project folder inside your web server htdocs folder:
MAMP (Mac): /Applications/MAMP/htdocs/
XAMPP (Windows): C:\xampp\htdocs\
Open in browser:
MAMP: http://localhost:8888/bank

XAMPP: http://localhost/bank

Database Configuration (Important) Depending on your local server:

🟢 XAMPP (Windows) DB Host: localhost DB Name: bank DB User: root DB Password: (empty) Port: 3306 (default) In db.php: $host = "localhost"; $dbname = "bank"; $username = "root"; $password = "";

🟢 MAMP (Mac) DB Host: localhost DB Name: bank DB User: root DB Password: root Port: 8888 In db.php: $host = "localhost"; $dbname = "bank"; $username = "root"; $password = "root";ok, es
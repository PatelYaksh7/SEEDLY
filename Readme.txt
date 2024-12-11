Seedly Project

Installation Instructions

Clone the repository into your local development environment:

git clone <repository_url>

Install and configure XAMPP to set up your local server.

Copy the project files into the htdocs folder of XAMPP.

Create a MySQL database and import the provided SQL file:

mysql -u root -p < shop_db.sql

Configure the database connection in the config.php file:

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'shop_db');

Start the Apache and MySQL services from the XAMPP control panel.

Access the project in your browser:

http://localhost/SEEDLY

API Integration

Seedly integrates Flask-based APIs for running machine learning models. Ensure that the Flask server is running before accessing soil quality prediction features:

Navigate to the crop_rotation_model.py file in the xampp/htdocs/ML/Scripts/ALL/ folder.

Start the Flask server:

python app.py

Project Modules

Farmer: Enables trading, personalized advice, and soil quality checks.

Admin: Provides administrative functionalities to manage the platform.

Researcher: Focuses on analytics and machine learning advancements.

Key URLs

Login Page: http://localhost/SEEDLY

Contribution Guidelines

Fork the repository and clone it to your local machine.

Create a new branch for your feature or bug fix.

Commit your changes with clear descriptions.

Push the branch and create a pull request.

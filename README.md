# Curriculum Vitae Application

This is a PHP-based CV application for Nena Fernanda with a MySQL database and Bootstrap design.

## Database Setup

1. Make sure you have XAMPP installed with Apache and MySQL running
2. The application expects a database named `dbcv_nena`
3. Run the SQL file `database.sql` to create the database and table structure:
   - Open phpMyAdmin in your browser (usually at http://localhost/phpmyadmin)
   - Create a new database named `dbcv_nena`
   - Import the `database.sql` file or run its contents as a query

## Alternative Setup

Instead of manually importing the SQL file, you can run the setup script:
1. Place all files in your XAMPP htdocs folder (in a subdirectory like cv_nena)
2. Start Apache and MySQL in XAMPP Control Panel
3. Navigate to http://localhost/cv_nena/setup.php in your browser
4. This will create the database table and insert sample data automatically

## Configuration

The database connection is configured in `config.php`:
- DB_HOST: 'localhost' (default)
- DB_USER: 'root' (default)
- DB_PASS: '' (empty by default in XAMPP)
- DB_NAME: 'dbcv_nena'

Change these values if your MySQL configuration is different.

## Usage

1. Access the CV application at http://localhost/cv_nena/index.php
2. The application has separate pages for each section:
   - Home: Main page with overview
   - Data Pribadi: Personal information
   - Riwayat Pendidikan: Education history
   - Keahlian: Skills and abilities
   - Pengalaman Proyek: Project experience
   - Kontak: Contact information and form

## Files Included

- index.php: Main home page
- personal.php: Personal information page
- education.php: Education history page
- skills.php: Skills page
- projects.php: Projects/experience page
- contact.php: Contact page
- config.php: Database configuration
- setup.php: Database setup script
- setup_corrected.php: Database setup with corrected structure
- create_db.php: Complete database and table creation script
- test_connection.php: Database connection test
- verify_structure.php: Database structure verification
- database.sql: SQL structure file
- style.css: Custom styles
- effects.js: Visual effects
- README.md: This file
- img/: Directory containing profile images

## Troubleshooting

If you get database connection errors:
1. Verify MySQL is running in XAMPP
2. Check your database credentials in config.php
3. Ensure the database 'dbcv_nena' exists
4. Make sure the 'cv_data' table exists with proper structure
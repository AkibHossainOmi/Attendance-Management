Go to the project directory `Attendance_Management/` 
In `config.js` update your database credentials like the following,

```
$servername = "localhost";
$username = "root";
$password = "your_password";
$dbname = "your_database_name";
```

Open terminal.
<br>
Enter the following command,
```
php init_db.php      
php -S localhost:8000
```
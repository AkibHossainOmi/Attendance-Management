<?php
include 'config.php';

$sql_script_path = 'attendance.sql';
$sql_contents = file_get_contents($sql_script_path);

if ($conn->multi_query($sql_contents)) {
    echo "SQL script executed successfully";
} else {
    echo "Error executing SQL script: " . $conn->error;
}

$conn->close();
?>

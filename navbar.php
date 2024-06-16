<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-500 p-4 text-white">
        <div class="container mx-auto flex justify-between">
            <div class="text-lg font-bold">Attendance System</div>
            <div>
                <a href="index.php" class="px-4">Home</a>
                <a href="view_attendance.php" class="px-4">View Attendance</a>
                <?php if (isset($_SESSION['teacher_id'])): ?>
                    <a href="take_attendance.php" class="px-4">Take Attendance</a>
                    <a href="logout.php" class="px-4">Logout</a>
                <?php elseif (isset($_SESSION['student_id'])): ?>
                    <a href="logout.php" class="px-4">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="px-4">Login</a>
                    <a href="register.php" class="px-4">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</body>
</html>

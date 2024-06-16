<?php
include 'config.php';
include 'navbar.php';

$attendance_records = [];

$sql = "SELECT attendance.id AS attendance_id, students.id AS student_id, students.name AS student_name, attendance.subject, attendance.date, attendance.status, teachers.name AS teacher_name
        FROM attendance
        INNER JOIN students ON attendance.student_id = students.id
        INNER JOIN teachers ON attendance.teacher_id = teachers.id
        ORDER BY attendance.date DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $attendance_records[] = $row;
    }
} else {
    $message = "No attendance records found.";
}

$conn->close(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Attendance</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-4">

    <?php if (!empty($attendance_records)): ?>
        <div class="overflow-x-auto flex items-center justify-center">
            <table class="mt-20 min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-100 border-b border-gray-300">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teacher</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php foreach ($attendance_records as $record): ?>
                        <tr class="border-b border-gray-300">
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo $record['student_id']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo $record['student_name']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo $record['subject']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo $record['date']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo $record['status']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo $record['teacher_name']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="mt-4 text-lg text-gray-600"><?php echo isset($message) ? $message : "No attendance records found."; ?></p>
    <?php endif; ?>
</div>

</body>
</html>

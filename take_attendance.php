<?php
session_start();
if (!isset($_SESSION['teacher_id'])) {
    header("Location: login.php");
    exit();
}
include 'navbar.php';


include 'config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $subject = $_POST['subject'];
    $date = date("Y-m-d");
    $teacher_id = $_SESSION['teacher_id']; 

    
    foreach ($_POST['status'] as $student_id => $status) {
        
        $sql = "INSERT INTO attendance (student_id, subject, date, status, teacher_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssi", $student_id, $subject, $date, $status, $teacher_id);

        if (!$stmt->execute()) {
            echo "Error: " . $sql . "<br>" . $conn->error;
            exit(); 
        }
    }

    
    $stmt->close();
    $conn->close();

    
    header("Location: view_attendance.php");
    exit();
}


$sql_students = "SELECT * FROM students";
$result_students = $conn->query($sql_students);

if ($result_students->num_rows === 0) {
    die("No students found.");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Attendance</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<div class="flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-4">
                <label for="subject" class="block text-lg font-medium">Enter Subject:</label>
                <input type="text" id="subject" name="subject" class="mt-1 block w-full px-3 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500" required>
            </div>
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border">Student Name</th>
                        <th class="py-2 px-4 border">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result_students->fetch_assoc()): ?>
                        <tr>
                            <td class="py-2 px-4 border"><?php echo $row['name']; ?></td>
                            <td class="py-2 px-4 border">
                                <input type="radio" name="status[<?php echo $row['id']; ?>]" value="present" required> Present
                                <input type="radio" name="status[<?php echo $row['id']; ?>]" value="absent" required> Absent
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <div class="mt-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2">Submit Attendance</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>

<?php
include 'config.php';

$message = ''; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST['type']; 

    if ($type === 'teacher') {
        
        $name = $_POST['name'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        
        $sql_check = "SELECT * FROM teachers WHERE name='$name'";
        $result_check = $conn->query($sql_check);

        if ($result_check->num_rows > 0) {
            $message = "Teacher name already exists";
        } else {
            $sql = "INSERT INTO teachers (name, password) 
                    VALUES ('$name', '$password')";
            if ($conn->query($sql) === TRUE) {
                $message = "Teacher registration successful!";
            } else {
                $message = "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } else {
        
        $student_id = $_POST['student_id'];
        $name = $_POST['name'];

        
        $sql_check = "SELECT * FROM students WHERE id='$student_id'";
        $result_check = $conn->query($sql_check);

        if ($result_check->num_rows > 0) {
            $message = "Student ID already exists";
        } else {
            $sql = "INSERT INTO students (id, name) 
                    VALUES ('$student_id', '$name')";
            if ($conn->query($sql) === TRUE) {
                $message = "Student registration successful!";
            } else {
                $message = "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    $conn->close();
}

include 'navbar.php';
?>

<div class="flex items-center justify-center min-h-screen bg-gray-200">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-4 text-center">Registration</h1>
        <?php if (!empty($message)): ?>
            <p class="text-center mb-4"><?php echo $message; ?></p>
        <?php endif; ?>
        <form action="register.php" method="post" id="registrationForm">
            <div class="mb-4">
                <label for="type" class="block text-lg font-medium mb-1">Register As:</label>
                <select id="type" name="type" class="mt-1 block w-full px-3 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500" required onchange="toggleFields()">
                    <option value="teacher" selected>Teacher</option>
                    <option value="student">Student</option>
                </select>
            </div>
            <div class="mb-4" id="name-field">
                <label for="name" class="block text-lg font-medium mb-1">Name:</label>
                <input type="text" id="name" name="name" class="mt-1 block w-full px-3 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500" required>
            </div>
            <div class="mb-4" id="password-field">
                <label for="password" class="block text-lg font-medium mb-1">Password:</label>
                <input type="password" id="password" name="password" class="mt-1 block w-full px-3 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500" required>
            </div>
            <div class="mb-4" id="student-id-field" style="display: none;">
                <label for="student_id" class="block text-lg font-medium mb-1">Student ID:</label>
                <input type="text" id="student_id" name="student_id" class="mt-1 block w-full px-3 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500">
            </div>
            <div class="mt-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none">Register</button>
            </div>
        </form>
        <p class="mt-4 text-center">Already registered? <a href="login.php" class="text-blue-500">Login here</a></p>
    </div>
</div>

<script>
    function toggleFields() {
        var type = document.getElementById('type').value;
        var nameField = document.getElementById('name-field');
        var passwordField = document.getElementById('password-field');
        var studentIdField = document.getElementById('student-id-field');

        if (type === 'teacher') {
            nameField.innerHTML = '<label for="name" class="block text-lg font-medium mb-1">Name:</label>' +
                '<input type="text" id="name" name="name" class="mt-1 block w-full px-3 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500" required>';
            passwordField.style.display = 'block';
            studentIdField.style.display = 'none';
        } else {
            nameField.innerHTML = '<label for="name" class="block text-lg font-medium mb-1">Student Name:</label>' +
                '<input type="text" id="name" name="name" class="mt-1 block w-full px-3 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500" required>';
            passwordField.style.display = 'none';
            studentIdField.style.display = 'block';
        }
    }

    
    toggleFields();
</script>

</body>
</html>

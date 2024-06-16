<?php
include 'config.php';
session_start();

$message = ''; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM teachers WHERE name='$name'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['teacher_id'] = $row['id'];
            header("Location: index.php");
            exit();
        } else {
            $message = "Invalid password!";
        }
    } else {
        $message = "No user found with that name!";
    }
    $conn->close();
}

include 'navbar.php';
?>

<div class="flex items-center justify-center min-h-screen bg-gray-200">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-4 text-center">Teacher Login</h1>
        <?php if (!empty($message)): ?>
            <p class="text-red-500 text-sm mb-4"><?php echo $message; ?></p>
        <?php endif; ?>
        <form action="login.php" method="post">
            <div class="mb-4">
                <label for="name" class="block text-lg font-medium mb-1">Name:</label>
                <input type="text" id="name" name="name" class="mt-1 block w-full px-3 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-lg font-medium mb-1">Password:</label>
                <input type="password" id="password" name="password" class="mt-1 block w-full px-3 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500" required>
            </div>
            <div class="mt-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none">Login</button>
            </div>
        </form>
        <p class="mt-4 text-center">Not registered yet? <a href="register.php" class="text-blue-500">Register here</a></p>
    </div>
</div>
</body>
</html>

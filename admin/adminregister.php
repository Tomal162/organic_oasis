<?php
// Database connection settings
$servername = "localhost";  // or your database server address
$username = "root";         // database username
$password = "";             // database password (for local development, leave empty)
$dbname = "admin_panel";  // the name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_username = $_POST['username'];
    $user_email = $_POST['email'];
    $user_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($user_password === $confirm_password) {
        // Hash the password
        $hashedPassword = password_hash($user_password, PASSWORD_DEFAULT);

        // Prepare SQL statement to insert the data
        $sql = "INSERT INTO users (username, email, password) VALUES ('$user_username', '$user_email', '$hashedPassword')";

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            header("Location: adminlogin.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Passwords do not match!";
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
        <h1 class="font-bold text-3xl text-center text-lime-700 mb-6">OrganicOasis &#8482 </h1>
        <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Admin Register</h2>
        <form id="registerForm" action="adminregister.php" method="POST" onsubmit="return validateForm()">
            <div class="mb-4">
                <label for="username" class="block text-gray-600 mb-2">Username</label>
                <input type="text" name="username" placeholder="Username"
                    class="w-full p-3 border rounded-md focus:ring focus:ring-lime-300 focus:outline-none" 
                    required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-600 mb-2">Email</label>
                <input type="email" name="email" placeholder="Email"
                    class="w-full p-3 border rounded-md focus:ring focus:ring-lime-300 focus:outline-none" 
                    required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-600 mb-2">Password</label>
                <input type="password" name="password" placeholder="Password"
                    class="w-full p-3 border rounded-md focus:ring focus:ring-lime-300 focus:outline-none" 
                    required>
            </div>
            <div class="mb-6">
                <label for="confirm_password" class="block text-gray-600 mb-2">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" 
                    class="w-full p-3 border rounded-md focus:ring focus:ring-lime-300 focus:outline-none" 
                    required>
                <p id="error-message" class="text-red-500 text-sm mt-2 hidden">Passwords do not match</p>
            </div>
            <button type="submit" name="register" 
                class="w-full bg-lime-700 text-white py-2 px-4 rounded-md hover:bg-lime-600 transition">
                Register
            </button>
        </form>
        <p class="text-sm text-gray-600 mt-4 text-center">
            Already have an account? <a href="adminlogin.php" class="text-lime-700 font-bold hover:underline">Login</a>
        </p>
    </div>

    <script>
        function validateForm() {
            const password = document.querySelector('input[name="password"]').value;
            const confirmPassword = document.querySelector('input[name="confirm_password"]').value;
            const errorMessage = document.getElementById('error-message');

            if (password !== confirmPassword) {
                errorMessage.classList.remove('hidden');  // Show error message
                return false;  // Prevent form submission
            }

            errorMessage.classList.add('hidden');  // Hide error message
            return true;  // Allow form submission
        }
    </script>
</body>
</html>


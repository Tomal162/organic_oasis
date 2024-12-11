<?php
// Start the session
session_start();

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

// Process login when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_username = $_POST['username'];  // Username or email
    $user_password = $_POST['password'];  // Password

    // Check if user exists
    $sql = "SELECT id, username, email, password FROM users WHERE username='$user_username' OR email='$user_username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User exists, fetch user data
        $row = $result->fetch_assoc();

        // Verify the password
        if (password_verify($user_password, $row['password'])) {
            // Password is correct, start the session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];  // Store username in session for later use

            // Redirect to the admin panel
            header("Location: index.php");
            exit();
        } else {
            // Incorrect password
            $error_message = "Invalid username or password!";
        }
    } else {
        // User not found
        $error_message = "No user found with that username/email!";
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
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
        <h1 class="font-bold text-3xl text-center text-lime-700 mb-6">OrganicOasis &#8482</h1>
        <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Admin Login</h2>

        <?php if (isset($error_message)): ?>
            <div class="text-red-500 text-center mb-4"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <form action="adminlogin.php" method="POST">
            <div class="mb-4">
                <label for="username" class="block text-gray-600 mb-2">Username or Email</label>
                <input type="text" name="username" placeholder="Username or Email"
                    class="w-full p-3 border rounded-md focus:ring focus:ring-lime-300 focus:outline-none" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-600 mb-2">Password</label>
                <input type="password" name="password" placeholder="Password"
                    class="w-full p-3 border rounded-md focus:ring focus:ring-lime-300 focus:outline-none" required>
            </div>
            <button type="submit" class="w-full bg-lime-700 text-white py-2 px-4 rounded-md hover:bg-lime-600 transition">
                Login
            </button>
        </form>

        <p class="text-sm text-gray-600 mt-4 text-center">
            Don't have an account? <a href="adminregister.php" class="text-lime-700 font-bold hover:underline">Register</a>
        </p>
    </div>
</body>
</html>

<?php
session_start(); // Start session management
$conn = new mysqli("localhost", "root", "", "organic_oasis"); // Connect to the database

// Check for form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $conn->real_escape_string($_POST['email']); // Escape special characters
    $password = $_POST['password'];

    // Query to find user by email
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc(); // Fetch user data
        if (password_verify($password, $user['password'])) { // Verify password
            $_SESSION['user_id'] = $user['id']; // Set session variable
            header("Location: index.php"); // Redirect to products page
            exit();
        } else {
            $error_message = "Invalid password!";
        }
    } else {
        $error_message = "No user found with this email!";
    }
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
    <h1 class="font-bold text-3xl text-center text-lime-700 mb-6">OrganicOasis &#8482 </h1>
        <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Login</h2>
        <?php if (!empty($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <div class="mb-4">
                <label for="email" class="block text-gray-600 mb-2">Email</label>
                <input type="email" name="email" placeholder="Email" 
                    class="w-full p-3 border rounded-md focus:ring focus:ring-lime-300 focus:outline-none" 
                    required>
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-600 mb-2">Password</label>
                <input type="password" name="password" placeholder="Password" 
                    class="w-full p-3 border rounded-md focus:ring focus:ring-lime-300 focus:outline-none" 
                    required>
            </div>
            <button type="submit" name="login" 
                class="w-full bg-lime-700 text-white py-2 px-4 rounded-md hover:bg-lime-600 transition">
                Login
            </button>
        </form>
        <p class="text-sm text-gray-600 mt-4 text-center">
            Don't have an account? <a href="register.php" class="text-lime-700 font-bold hover:underline">Register</a>
        </p>
    </div>
    
</body>
</html>

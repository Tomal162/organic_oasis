<?php
$conn = new mysqli("localhost", "root", "", "organic_oasis");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    if ($conn->query($sql)) {
        echo "<script>alert('Registration successful'); window.location.href='login.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
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
        <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Register</h2>
        <form action="register.php" method="POST">
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
            </div>
            <button type="submit" name="register" 
                class="w-full bg-lime-700 text-white py-2 px-4 rounded-md hover:bg-lime-600 transition">
                Register
            </button>
        </form>
        <p class="text-sm text-gray-600 mt-4 text-center">
            Already have an account? <a href="login.php" class="text-lime-700 font-bold hover:underline">Login</a>
        </p>
    </div>
</body>
</html>

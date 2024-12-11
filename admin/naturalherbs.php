<?php

// Start the session
session_start();

// Check if the user is logged in and has the correct role
if (!isset($_SESSION['user_id'])) {
    // If not logged in or not an admin, redirect to the login page
    header("Location: adminlogin.php");
    exit();
}
// Database connection
$host = "localhost";
$username = "root";
$password = "";
$dbname = "admin_panel";

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $productName = $_POST["productName"];
    $productPrice = $_POST["productPrice"];
    $targetDir = "uploads/"; // Folder to store uploaded images
    $productPhoto = $_FILES["productPhoto"]["name"];
    $targetFile = $targetDir . basename($productPhoto);

    // Validate inputs
    if (empty($productName) || empty($productPrice) || empty($productPhoto)) {
        echo "Please fill in all fields.";
        exit();
    }

    // Move uploaded file to the target directory
    if (move_uploaded_file($_FILES["productPhoto"]["tmp_name"], $targetFile)) {
        // Insert product data into the database
        $sql = "INSERT INTO naturalherbs (product_name, product_price, product_photo) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sds", $productName, $productPrice, $productPhoto);

        if ($stmt->execute()) {
             // Redirect to the same page to avoid resubmission
        header("Location: " . $_SERVER['PHP_SELF']);
            echo "Product uploaded successfully!";
            exit(); // Prevent further script execution
            
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Failed to upload the photo.";
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="dist/css/style.css">
    <title>OrganicOasis Admin</title>
</head>
<body class="text-gray-800 font-inter">
    
    <!-- start: Sidebar -->
    <div class="fixed left-0 top-0 w-64 h-full bg-white p-4 z-50 sidebar-menu transition-transform">
        <a href="#" class="pb-4">
            <img src="assets/logo.png">
        </a>
        <ul class="mt-4">
            <li class="mb-1 group active">
                <a href="index.php" class="flex items-center py-2 px-4 text-lime-700 hover:bg-zinc-200">
                    <i class="ri-home-2-line mr-3 text-lg"></i>
                    <span class="text-sm">Dashboard</span>
                </a>
            </li>
            <li class="mb-1 group">
                <a href="#" class="flex items-center py-2 px-4 text-lime-700 hover:bg-zinc-200 sidebar-dropdown-toggle" onclick="toggleDropdown(event)">
                    <i class="ri-instance-line mr-3 text-lg"></i>
                    <span class="text-sm">Products</span>
                    <i class="ri-arrow-right-s-line ml-auto transform transition-transform"></i>
                </a>
                <ul class="pl-7 mt-2 hidden">
                    <li class="mb-4">
                        <a href="latest.php" class="text-lime-700 text-sm flex items-center hover:bg-zinc-200 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Latest</a>
                    </li>
                    <li class="mb-4">
                        <a href="bestsell.php" class="text-lime-700 text-sm flex items-center hover:bg-zinc-200 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Best Selling</a>
                    </li>
                    <!-- Additional list items here -->
                </ul>
            </li>
            <li class="mb-1 group">
                <a href="#" class="flex items-center py-2 px-4 text-lime-700 hover:bg-zinc-200 sidebar-dropdown-toggle" onclick="toggleDropdown(event)">
                    <i class="ri-archive-drawer-line mr-3 text-lg"></i>
                    <span class="text-sm">Categories</span>
                    <i class="ri-arrow-right-s-line ml-auto transform transition-transform"></i>
                </a>
                <ul class="pl-7 mt-2 hidden">
                    <li class="mb-4">
                        <a href="fruits&veges.php" class="text-lime-700 text-sm flex items-center hover:bg-zinc-200 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Fruits & Veges</a>
                    </li>
                    <li class="mb-4">
                        <a href="breads&sweets.php" class="text-lime-700 text-sm flex items-center hover:bg-zinc-200 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Breads & Sweets</a>
                    </li>
                    <li class="mb-4">
                        <a href="oil&ghee.php" class="text-lime-700 text-sm flex items-center hover:bg-zinc-200 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Oil & Ghee</a>
                    </li>
                    <li class="mb-4">
                        <a href="milk&drinks.php" class="text-lime-700 text-sm flex items-center hover:bg-zinc-200 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Milk & Drinks</a>
                    </li>
                    <li class="mb-4">
                        <a href="naturalherbs.php" class="text-lime-700 text-sm flex items-center hover:bg-zinc-200 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Natural Herbs</a>
                    </li>
                    <li class="mb-4">
                        <a href="cosmetics.php" class="text-lime-700 text-sm flex items-center hover:bg-zinc-200 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Cosmetics</a>
                    </li>
                    <!-- Additional list items here -->
                </ul>
            </li>
            <li class="mb-1 group">
                <a href="#" class="flex items-center py-2 px-4 text-lime-700 hover:bg-zinc-200 sidebar-dropdown-toggle" onclick="toggleDropdown(event)">
                    <i class="ri-door-lock-box-line mr-3 text-lg"></i>
                    <span class="text-sm">Inventory</span>
                    <i class="ri-arrow-right-s-line ml-auto transform transition-transform"></i>
                </a>
                <ul class="pl-7 mt-2 hidden">
                    <li class="mb-4">
                        <a href="warehouse.php" class="text-lime-700 text-sm flex items-center hover:bg-zinc-200 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Warehouse</a>
                    </li>
                    <li class="mb-4">
                        <a href="orders.php" class="text-lime-700 text-sm flex items-center hover:bg-zinc-200 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Orders</a>
                    </li>
                    <!-- Additional list items here -->
                </ul>
            </li>
            
            <li class="mb-1 group">
                <a href="adminlogout.php" class="flex items-center py-2 px-4 text-lime-700 hover:bg-zinc-200">
                    <i class="ri-logout-circle-line mr-3 text-lg"></i>
                    <span class="text-sm">Logout</span>
                </a>
            </li>
            
            
        </ul>
    </div>
    <div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay"></div>
    <!-- end: Sidebar -->

    <!-- start: Main -->
    <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-50 min-h-screen transition-all main">
        <div class="py-2 px-6 bg-lime-600 flex items-center shadow-md shadow-black/5 sticky top-0 left-0 z-30">
            <button type="button" class="text-lg text-white sidebar-toggle">
                <i class="ri-menu-line"></i>
            </button>
            <ul class="flex items-center text-sm ml-4">
                <li class="mr-2">
                    <a href="#" class="text-white hover:text-gray-600 font-medium">Categories <i class="ri-arrow-right-line"></i> Natural Herbs</a>
                </li>
            </ul>
            <ul class="ml-auto flex items-center">
                
                <li class="dropdown ml-3">
                    
                    <ul class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">
                        <li>
                            <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Profile</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Settings</a>
                        </li>
                        <li>
                            <a href="adminlogin.php" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Product Upload Form -->
        <form action="" method="POST" enctype="multipart/form-data">
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Update Product</h2>

        <div class="bg-white shadow-md rounded-lg p-6">
            <!-- Product Photo -->
            <div class="mb-6">
                <label for="productPhoto" class="block text-sm font-medium text-gray-700 mb-2">Product Photo</label>
                <div class="flex items-center">
                    <img id="previewProductImage" src="https://via.placeholder.com/100" alt="Product Photo" class="w-24 h-24 rounded-md mr-4">
                    <input
                        type="file"
                        id="productPhoto"
                        name="productPhoto"
                        accept="image/*"
                        class="hidden"
                        onchange="previewProductPhoto(event)"
                    >
                    <label
                        for="productPhoto"
                        class="cursor-pointer bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600"
                    >
                        Upload Photo
                    </label>
                </div>
            </div>

            <!-- Product Name -->
            <div class="mb-4">
                <label for="productName" class="block text-sm font-medium text-gray-700">Product Name</label>
                <input
                    type="text"
                    id="productName"
                    name="productName"
                    placeholder="Enter product name"
                    class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>

            <!-- Product Price -->
            <div class="mb-4">
                <label for="productPrice" class="block text-sm font-medium text-gray-700">Product Price (&#2547)</label>
                <input
                    type="text"
                    id="productPrice"
                    name="productPrice"
                    placeholder="Enter product price"
                    class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>

            <!-- Upload Button -->
            <div class="flex justify-end">
                <button
                    type="submit"
                    class="bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-600"
                >
                    Upload Product
                </button>
            </div>
        </div>
    </div>
</form>
        
        <!-- Success Message -->
        <div id="uploadSuccessMessage" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <p class="text-lg font-semibold text-gray-800">Product uploaded successfully!</p>
                <button
                    onclick="closeUploadSuccessMessage()"
                    class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600"
                >
                    OK
                </button>
            </div>
        </div>


        <script>
            function toggleDropdown(event) {
                event.preventDefault();
                const parentLi = event.target.closest('.group');
                const submenu = parentLi.querySelector('ul');
                const arrowIcon = parentLi.querySelector('.ri-arrow-right-s-line');
                
                submenu.classList.toggle('hidden');
                arrowIcon.classList.toggle('rotate-90');
            }
            </script>
        
        <script>
            // Function to preview the selected product photo
            function previewProductPhoto(event) {
                const preview = document.getElementById("previewProductImage");
                const file = event.target.files[0];
                if (file) {
                    preview.src = URL.createObjectURL(file);
                }
            }
        
            // Function to upload product (simulated)
            function uploadProduct() {
                const productName = document.getElementById("productName").value;
                const productPrice = document.getElementById("productPrice").value;
        
                if (!productName || !productPrice) {
                    alert("Please fill in all fields.");
                    return;
                }
        
                // Simulate product upload (replace with AJAX request or backend logic)
                alert(`Product "${productName}" with price $${productPrice} uploaded!`);
        
                // Show success message
                document.getElementById("uploadSuccessMessage").classList.remove("hidden");
            }
        
            // Function to close success message
            function closeUploadSuccessMessage() {
                document.getElementById("uploadSuccessMessage").classList.add("hidden");
            }
        </script>
</body>
</html>
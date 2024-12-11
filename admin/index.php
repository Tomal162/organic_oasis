<?php
// Start the session
session_start();

// Check if the user is logged in and has the correct role
if (!isset($_SESSION['user_id'])) {
    // If not logged in or not an admin, redirect to the login page
    header("Location: adminlogin.php");
    exit();
}

$api_key = "1a2f05bad40c18d8612b323f219e47e4"; // Replace with your actual API key
$city = "Chittagong"; // Specify the city for which you want to fetch weather
$unit = "metric"; // Use "metric" for Celsius, "imperial" for Fahrenheit

// OpenWeatherMap API endpoint
$api_url = "https://api.openweathermap.org/data/2.5/weather?q=$city&units=$unit&appid=$api_key";

// Fetch the data from OpenWeatherMap API
$response = file_get_contents($api_url);
$weather_data = json_decode($response, true);

// Check if the request was successful
if ($weather_data['cod'] == 200) {
    // Extract the necessary weather data
    $temperature = $weather_data['main']['temp'];
    $weather_description = $weather_data['weather'][0]['description'];
    $city_name = $weather_data['name'];
} else {
    // Handle error in case the weather data could not be fetched
    $temperature = "N/A";
    $weather_description = "Error fetching weather data";
    $city_name = $city;
}

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
                    <a href="#" class="text-white hover:text-gray-600 font-medium">Dashboard</a>
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
        <div class="mt-44 flex flex-col justify-between text-center items-center bg-white p-6 rounded-lg shadow-lg space-y-24">
    <div class="text-xl font-semibold text-lime-700">
        Welcome, Admin...<br><span class="text-gray-500"><?php echo date('M d, Y H:i'); ?></span>
    </div>
    
    <div class="text-gray-600">
        <p class="text-lg">Weather in <?php echo $city_name; ?>:</p>
        <p class="text-xl font-bold"><?php echo $temperature; ?>&deg;C</p>
        <p class="text-sm"><?php echo ucfirst($weather_description); ?></p>
    </div>
</div>
    </main>
    <!-- end: Main -->


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

    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="dist/js/script.js"></script>
</body>
</html>
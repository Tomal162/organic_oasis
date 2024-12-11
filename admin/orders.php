<?php

// Start the session
session_start();

// Check if the user is logged in and has the correct role
if (!isset($_SESSION['user_id'])) {
    // If not logged in or not an admin, redirect to the login page
    header("Location: adminlogin.php");
    exit();
}
$servername = "localhost"; // Replace with your database server
$username = "root";        // Replace with your database username
$password = "";            // Replace with your database password
$database = "organic_oasis"; // Replace with your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT user_id, total_price, created_at FROM orders ORDER BY created_at DESC";
$result = $conn->query($query);
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
                <a href="adminlogin.php" class="flex items-center py-2 px-4 text-lime-700 hover:bg-zinc-200">
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
                    <a href="#" class="text-white hover:text-gray-600 font-medium">Inventory <i class="ri-arrow-right-line"></i> Orders</a>
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
                            <a href="adminlogout.php" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
      

    <!-- Orders List Table -->
<div class="overflow-x-auto bg-white rounded-lg shadow p-4">
    <h2 class="text-xl font-semibold mb-4">All Order List</h2>
    <table class="min-w-full text-center text-gray-700" id="ordersTable">
        <thead>
            <tr class="border-b">
                <th class="px-4 py-2">User ID</th>
                <th class="px-4 py-2">Created At</th>
                <th class="px-4 py-2">Total Price</th>
                <th class="px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr class='border-b' id='order_" . $row['user_id'] . "' data-user-id='" . $row['user_id'] . "'>";
                    echo "<td class='px-4 py-2'>" . htmlspecialchars($row['user_id']) . "</td>";
                    echo "<td class='px-4 py-2'>" . htmlspecialchars(date("M d, Y", strtotime($row['created_at']))) . "</td>";
                    echo "<td class='px-4 py-2'>৳" . htmlspecialchars(number_format($row['total_price'], 2)) . "</td>";
                    echo "<td class='px-4 py-2 flex justify-center space-x-2'>
                            <button onclick=\"markAsShipped(this)\" class=\"text-gray-500 text-2xl hover:text-green-500\">
                                <i class=\"ri-truck-line\"></i>
                            </button>
                            <button onclick=\"markAsCancelled(this)\" class=\"text-gray-500 text-2xl hover:text-red-500\">
                                <i class=\"ri-close-circle-line\"></i>
                            </button>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4' class='px-4 py-2'>No orders found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>


    <!-- Font Awesome Icons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    </main>
    <!-- end: Main -->


    <script>
    // Handle order shipped action
function markAsShipped(button) {
    const row = button.closest('tr');
    const userId = row.dataset.userId;  // Get the user_id from the row
    const actionCell = row.querySelector('td:last-child'); // Action cell
    const truckIcon = button.querySelector('i'); // Truck icon
    const cancelButton = row.querySelector('button:nth-child(2)'); // Cancel button

    // Only change the status if it is not already delivered
    if (!localStorage.getItem('order_' + userId)) {
        // Update the status to shipped and store it in localStorage
        localStorage.setItem('order_' + userId, 'shipped');
        
        // Create the "Order has been Delivered" message
        const message = document.createElement('span');
        message.textContent = "Order has been Delivered";
        message.classList.add('text-green-500', 'font-semibold');

        // Remove the truck icon and show the message
        truckIcon.style.display = 'none';
        actionCell.appendChild(message);
    }
}

// Handle order cancel action
function markAsCancelled(button) {
    const row = button.closest('tr');
    const userId = row.dataset.userId;  // Get the user_id from the row

    // Remove the row from the table (simulate delete)
    row.remove();

    // Optionally, you can remove it from localStorage or a similar persistent storage.
    localStorage.removeItem('order_' + userId);  // Remove order status from localStorage.
}

// Save the order statuses (shipped) to localStorage on page load
document.addEventListener('DOMContentLoaded', function () {
    const rows = document.querySelectorAll('#ordersTable tbody tr');
    rows.forEach(function(row) {
        const userId = row.dataset.userId;  // Get the user_id from the row

        // If the order status is saved in localStorage as 'shipped', update the UI
        if (localStorage.getItem('order_' + userId) === 'shipped') {
            const truckIcon = row.querySelector('button:nth-child(1) i');
            truckIcon.style.display = 'none';  // Hide the truck icon
            const actionCell = row.querySelector('td:last-child');
            
            // Check if the message already exists, if not, add it
            if (!actionCell.querySelector('span')) {
                const message = document.createElement('span');
                message.textContent = "Order has been delivered";
                message.classList.add('text-green-500', 'font-semibold');
                actionCell.appendChild(message);  // Show the delivered message
            }
        }
    });
});

</script>

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
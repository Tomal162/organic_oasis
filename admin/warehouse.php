<?php

// Start the session
session_start();

// Check if the user is logged in and has the correct role
if (!isset($_SESSION['user_id'])) {
    // If not logged in or not an admin, redirect to the login page
    header("Location: adminlogin.php");
    exit();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                    <a href="#" class="text-white hover:text-gray-600 font-medium">Inventory <i class="ri-arrow-right-line"></i> Warehouse</a>
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
        <!-- Header Section -->
  

  <!-- Cards Section -->
  <div class="flex flex-wrap justify-center gap-4 mt-12 mb-8">
    <!-- Total Product Items Card -->
    <div class="w-full md:w-1/2 lg:w-1/4 bg-white shadow-md rounded-lg p-6">
      <div class="flex gap-x-4"><h2 class="text-lg font-bold text-lime-700">Total Product Items</h2>
        <img src="assets/box_8513751 (1).png"></div>
      <p id="total-items" class="text-3xl font-bold text-gray-800 mt-4">0</p>
    </div>
    <!-- Total Product Value Card -->
    <div class="w-full md:w-1/2 lg:w-1/4 bg-white shadow-md rounded-lg p-6">
        <div class="flex gap-x-4"><h2 class="text-lg font-bold text-lime-700">Total Product Value</h2>
            <img src="assets/income_17749772.png"></div>
            <p id="total-value" class="text-3xl font-bold text-gray-800 mt-4">৳0.00</p>
    </div>
    
  </div>

  <!-- Warehouse List Table Section -->
  <div class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-bold text-lime-700 mb-4 text-center">All Warehouse List</h2>
    <table class="table-auto w-full border-collapse border border-gray-200">
      <thead>
        <tr class="bg-gray-100">
          <th class="border border-gray-300 px-4 py-2 text-left">Product Category</th>
          <th class="border border-gray-300 px-4 py-2 text-center">Stock Availability</th>
          <th class="border border-gray-300 px-4 py-2 text-center">Total Stock Price</th>
          <th class="border border-gray-300 px-4 py-2 text-center">Action</th>
        </tr>
      </thead>
      <tbody id="warehouse-list">
        <!-- Rows will be dynamically generated -->
      </tbody>
    </table>
    <!-- Add New Row Button -->
    <div class="mt-4 flex justify-center">
      <button id="add-row-btn" class="bg-lime-700 text-white px-6 py-2 rounded-md hover:bg-lime-900">
        <i class="fa-solid fa-plus"></i>
      </button>
    </div>
  </div>

    
    <!-- Font Awesome Icons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    </main>
    <!-- end: Main -->


    <script>
        const totalItemsElement = document.getElementById("total-items");
        const totalValueElement = document.getElementById("total-value");
        const warehouseListElement = document.getElementById("warehouse-list");
        const addRowButton = document.getElementById("add-row-btn");
    
        // Load rows from localStorage
        const loadRows = () => {
          const rows = JSON.parse(localStorage.getItem("warehouseRows")) || [];
          rows.forEach(row => addRow(row.productCategory, row.stockAvailability, row.totalStockPrice, false));
          updateTotals();
        };
    
        // Save rows to localStorage
        const saveRows = () => {
          const rows = Array.from(warehouseListElement.children).map(row => ({
            productCategory: row.querySelector(".category").innerText,
            stockAvailability: parseInt(row.querySelector(".availability").innerText),
            totalStockPrice: parseFloat(row.querySelector(".price").innerText.slice(1)) // Remove $
          }));
          localStorage.setItem("warehouseRows", JSON.stringify(rows));
        };
    
        // Update totals in cards
        const updateTotals = () => {
  let totalItems = 0;
  let totalValue = 0;
  Array.from(warehouseListElement.children).forEach(row => {
    totalItems += parseInt(row.querySelector(".availability").innerText);
    totalValue += parseFloat(row.querySelector(".price").innerText.slice(1)); // Remove ৳
  });
  totalItemsElement.innerText = totalItems;
  totalValueElement.innerText = `৳${totalValue.toFixed(2)}`;
};
    
        // Add a new row
        const addRow = (category = "New Category", availability = 0, price = 0.0, save = true) => {
  const row = document.createElement("tr");

  row.innerHTML = `
    <td class="border border-gray-300 px-4 py-2 category">${category}</td>
    <td class="border border-gray-300 px-4 py-2 text-center availability">${availability}</td>
    <td class="border border-gray-300 px-4 py-2 text-center price">৳${price.toFixed(2)}</td>
    <td class="border border-gray-300 px-4 py-2 text-center">
      <button class="edit-btn bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600"><i class="fa-solid fa-pen-to-square"></i></button>
      <button class="delete-btn bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600"><i class="fa-solid fa-trash"></i></button>
    </td>
  `;
    
          // Edit button functionality
          row.querySelector(".edit-btn").addEventListener("click", () => {
            const newCategory = prompt("Enter new category:", category);
            const newAvailability = parseInt(prompt("Enter new stock availability:", availability)) || 0;
            const newPrice = parseFloat(prompt("Enter new total stock price:", price)) || 0.0;
    
            row.querySelector(".category").innerText = newCategory;
            row.querySelector(".availability").innerText = newAvailability;
            row.querySelector(".price").innerText = `৳${newPrice.toFixed(2)}`;
    
            updateTotals();
            saveRows();
          });
    
          // Delete button functionality
          row.querySelector(".delete-btn").addEventListener("click", () => {
            row.remove();
            updateTotals();
            saveRows();
          });
    
          warehouseListElement.appendChild(row);
    
          if (save) {
            updateTotals();
            saveRows();
          }
        };
    
        // Add new row on button click
        addRowButton.addEventListener("click", () => addRow());
    
        // Initial load
        loadRows();
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
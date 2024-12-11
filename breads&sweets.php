<?php

session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit;
}

$user_id = $_SESSION['user_id']; // Access user_id from session



//Product Fetch
$host = "localhost";
$username = "root";
$password = "";
$dbname = "admin_panel";

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products from the database
$sql_latest = "SELECT product_name, product_price, product_photo FROM breadssweets";
$result_latest = $conn->query($sql_latest);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Organic Oasis</title>
    <meta name="description" content="Free open source Tailwind CSS Store template">
    <meta name="keywords" content="tailwind,tailwindcss,tailwind css,css,starter template,free template,store template, shop layout, minimal, monochrome, minimalistic, theme, nordic">

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:200,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .border-customGreen{
          border-color: #708a30; 
        }
        .text-customGreen{
          color: #708a30;
        }
        .text-customGreen2{
          color: #8ea158;
        }
        .bg-customGreen{
          background-color: #708a30;
        }
        .ring-customGreen{
          color: #708a30;
        }


        .cart-button .fa-shopping-cart {
  z-index: 2;
}

.cart-button .fa-box {
  z-index: 3;
}

.cart-button span.add-to-cart {
  opacity: 1;
  transition: opacity 0.5s ease-in-out;
}

.cart-button span.added {
  opacity: 0;
  transition: opacity 0.5s ease-in-out;
}

.cart-button.clicked .fa-shopping-cart {
  animation: cart 1.5s ease-in-out forwards;
}

.cart-button.clicked .fa-box {
  animation: box 1.5s ease-in-out forwards;
}

.cart-button.clicked span.add-to-cart {
  animation: txt1 1.5s ease-in-out forwards;
}

.cart-button.clicked span.added {
  animation: txt2 1.5s ease-in-out forwards;
}

@keyframes cart {
  0% {
    left: -10%;
  }
  40%, 60% {
    left: 50%;
  }
  100% {
    left: 110%;
  }
}

@keyframes box {
  0%, 40% {
    top: -20%;
  }
  60% {
    top: 40%;
    left: 52%;
  }
  100% {
    top: 40%;
    left: 112%;
  }
}

@keyframes txt1 {
  0% {
    opacity: 1;
  }
  20%, 100% {
    opacity: 0;
  }
}

@keyframes txt2 {
  0%, 80% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}

    </style>

</head>

<body class="">

    <!-- elements -->
<nav class="flex items-center justify-between px-6 py-4 bg-white shadow object-top">
    <!-- Logo -->
    <div class="flex items-center">
      <img src="assets/logo.png" alt="Logo" class="h-20">
    </div>
  
    <!-- Dropdown and Search Bar -->
    <div class="flex items-center space-x-4">
      <!-- All Categories Dropdown -->
      <div class="relative inline-block text-left">
        <button onclick="toggleDropdown()" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-customGreen bg-white border border-customGreen rounded-md shadow-sm hover:bg-gray-50">
          All Categories
          <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
          </svg>
        </button>
  
        <div id="dropdownMenu" class="hidden absolute right-0 z-20 mt-2 w-56 origin-top-right rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
        <div class="py-1">
            <a href="fruits&veges.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Fruits & Veges</a>
            <a href="breads&sweets.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Breads & Sweets</a>
            <a href="oil&ghee.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Oil & Ghee</a>
            <a href="milk&drinks.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Milk & Drinks</a>
            <a href="naturalherbs.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Natural Herbs</a>
            <a href="cosmetics.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Cosmetics</a>
            
          </div>
        </div>
      </div>
  
      <!-- Search Bar -->
      <div class="relative w-full max-w-xs text-customGreen2 ">
        <input type="text" placeholder="Search for more than 20,000 products" class="w-full pl-4 pr-10 py-2 border border-customGreen rounded-md focus:outline-none"/>
        <button class="absolute inset-y-0 right-3 flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5 text-customGreen">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19a8 8 0 100-16 8 8 0 000 16zm6.93 6.93a1 1 0 001.41-1.41l-4.24-4.24" />
          </svg>
        </button>
      </div>
    </div>
  
    <!-- Support Section -->
    <div class="flex items-center space-x-8">
      <div class="support text-right text-customGreen">
        <p class="text-sm">For 24/7 support</p>
        <h2 class="text-lg font-bold">+996 675 588</h2>
      </div>
  
      <!-- Profile, Notification, Cart Icons -->
      <div class="flex space-x-4">
        <!-- Profile Icon -->
        <a href="logout.php">
          <div class="bg-gray-200 p-2 rounded-full">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 text-customGreen">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A10.005 10.005 0 0112 15c2.762 0 5.26 1.126 7.121 2.804m-7.121-8.316a4 4 0 100-8 4 4 0 000 8zm0 0c1.657 0 3-1.343 3-3m-6 0a3 3 0 106 0" />
          </svg>
        </div>
      </a>
  
        <!-- Notification Icon -->
        <a href="#">
        <div class="bg-gray-200 p-2 rounded-full">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 text-customGreen">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-2.808A2 2 0 0016.658 13H7.342a2 2 0 00-1.937 1.192L4 17h5m6-7V5a4 4 0 00-8 0v5m5 7v2a1 1 0 01-2 0v-2m2 0a1 1 0 01-2 0" />
          </svg>
        </div>
      </a>
  
        <!-- Cart Icon -->
        <a href="cart.php">
        <div class="bg-gray-200 p-2 rounded-full">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 text-customGreen">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.401 2.401L7 13h10l1.599-7.599L21 3H3zm5 13a2 2 0 100 4 2 2 0 000-4zm8 0a2 2 0 100 4 2 2 0 000-4z" />
          </svg>
        </div>
      </div>
    </a>
  
      <!-- Cart Price -->
      <div class="cart-price text-right text-customGreen">
        <p class="text-sm">Your Cart</p>
        <h2 class="text-lg font-bold"><i class="fa-solid fa-bangladeshi-taka-sign"></i> <span id="total-price">0.00</span></h2>
      </div>
    </div>
  </nav>

<!-- Navigations -->
  <div class="flex justify-center gap-x-8 mt-12">
    <a href="index.php" class="relative inline-block text-lg group">
      <span class="relative z-10 block px-5 py-3 overflow-hidden font-medium leading-tight text-customGreen transition-colors duration-300 ease-out border-2 border-customGreen rounded-lg group-hover:text-white">
      <span class="absolute inset-0 w-full h-full px-5 py-3 rounded-lg bg-gray-50"></span>
      <span class="absolute left-0 w-48 h-48 -ml-2 transition-all duration-300 origin-top-right -rotate-90 -translate-x-full translate-y-12 bg-customGreen group-hover:-rotate-180 ease"></span>
      <span class="relative">Home</span>
      </span>
      <span class="absolute bottom-0 right-0 w-full h-12 -mb-1 -mr-1 transition-all duration-200 ease-linear bg-customGreen rounded-lg group-hover:mb-0 group-hover:mr-0" data-rounded="rounded-lg"></span>
      </a>
      <a href="#_" class="relative inline-block text-lg group">
        <span class="relative z-10 block px-5 py-3 overflow-hidden font-medium leading-tight text-customGreen transition-colors duration-300 ease-out border-2 border-customGreen rounded-lg group-hover:text-white">
        <span class="absolute inset-0 w-full h-full px-5 py-3 rounded-lg bg-gray-50"></span>
        <span class="absolute left-0 w-48 h-48 -ml-2 transition-all duration-300 origin-top-right -rotate-90 -translate-x-full translate-y-12 bg-customGreen group-hover:-rotate-180 ease"></span>
        <span class="relative">Shop</span>
        </span>
        <span class="absolute bottom-0 right-0 w-full h-12 -mb-1 -mr-1 transition-all duration-200 ease-linear bg-customGreen rounded-lg group-hover:mb-0 group-hover:mr-0" data-rounded="rounded-lg"></span>
        </a>
        <a href="#_" class="relative inline-block text-lg group">
          <span class="relative z-10 block px-5 py-3 overflow-hidden font-medium leading-tight text-customGreen transition-colors duration-300 ease-out border-2 border-customGreen rounded-lg group-hover:text-white">
          <span class="absolute inset-0 w-full h-full px-5 py-3 rounded-lg bg-gray-50"></span>
          <span class="absolute left-0 w-48 h-48 -ml-2 transition-all duration-300 origin-top-right -rotate-90 -translate-x-full translate-y-12 bg-customGreen group-hover:-rotate-180 ease"></span>
          <span class="relative">Services</span>
          </span>
          <span class="absolute bottom-0 right-0 w-full h-12 -mb-1 -mr-1 transition-all duration-200 ease-linear bg-customGreen rounded-lg group-hover:mb-0 group-hover:mr-0" data-rounded="rounded-lg"></span>
          </a>
          <a href="#_" class="relative inline-block text-lg group">
            <span class="relative z-10 block px-5 py-3 overflow-hidden font-medium leading-tight text-customGreen transition-colors duration-300 ease-out border-2 border-customGreen rounded-lg group-hover:text-white">
            <span class="absolute inset-0 w-full h-full px-5 py-3 rounded-lg bg-gray-50"></span>
            <span class="absolute left-0 w-48 h-48 -ml-2 transition-all duration-300 origin-top-right -rotate-90 -translate-x-full translate-y-12 bg-customGreen group-hover:-rotate-180 ease"></span>
            <span class="relative">Contact</span>
            </span>
            <span class="absolute bottom-0 right-0 w-full h-12 -mb-1 -mr-1 transition-all duration-200 ease-linear bg-customGreen rounded-lg group-hover:mb-0 group-hover:mr-0" data-rounded="rounded-lg"></span>
            </a>
            <a href="#_" class="relative inline-block text-lg group">
              <span class="relative z-10 block px-5 py-3 overflow-hidden font-medium leading-tight text-customGreen transition-colors duration-300 ease-out border-2 border-customGreen rounded-lg group-hover:text-white">
              <span class="absolute inset-0 w-full h-full px-5 py-3 rounded-lg bg-gray-50"></span>
              <span class="absolute left-0 w-48 h-48 -ml-2 transition-all duration-300 origin-top-right -rotate-90 -translate-x-full translate-y-12 bg-customGreen group-hover:-rotate-180 ease"></span>
              <span class="relative">Offers</span>
              </span>
              <span class="absolute bottom-0 right-0 w-full h-12 -mb-1 -mr-1 transition-all duration-200 ease-linear bg-customGreen rounded-lg group-hover:mb-0 group-hover:mr-0" data-rounded="rounded-lg"></span>
              </a>
  </div>
     <!-- Product Cards -->
<main class="container mx-auto py-8">
    <div id="product-list" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php
        // Fetch products from the database
        $query = "SELECT id, product_name, product_price, product_photo FROM breadssweets"; // Adjust table and column names as needed
        $result = $conn->query($query);

        if ($result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
        ?>
        <div class="bg-white shadow-md rounded-lg p-6 text-center">
        <img 
    class="w-full h-40 object-cover rounded-md mb-4" 
    src="admin/uploads/<?= htmlspecialchars($row['product_photo']) ?>" 
    alt="<?= htmlspecialchars($row['product_name']) ?>">
            <h3 class="text-lg font-bold text-gray-800"><?= htmlspecialchars($row['product_name']) ?></h3>
            <p class="text-gray-600 text-sm mb-2">Price: &#2547 <?= htmlspecialchars(number_format($row['product_price'], 2)) ?></p>
            <div class="flex items-center justify-center mb-4">
                <label for="quantity-<?= $row['id'] ?>" class="text-gray-600 text-sm mr-2">Quantity:</label>
                <input type="number" id="quantity-<?= $row['id'] ?>" class="w-16 px-2 py-1 border rounded-md text-center" min="1" max="10" value="1">
            </div>
            <button onclick="addToCart(<?= $row['id'] ?>, '<?= htmlspecialchars($row['product_name']) ?>', <?= $row['product_price'] ?>)" 
                class="w-full bg-customGreen hover:bg-green-700 text-white py-2 rounded-md transition">
                Add to Cart
            </button>
        </div>
        <?php
            endwhile;
        else:
        ?>
        <p class="col-span-full text-center text-gray-600">No products available.</p>
        <?php
        endif;

        // Close the database connection
        $conn->close();
        ?>
    </div>
</main>


    
  
      
      <!-- Footer Bottom -->
      <div class="text-center py-6 border-t mt-10">
        <p class="text-gray-600">&copy; 2024 OrganicOasis. All rights reserved.</p>
      </div>
    </footer>




    <script>
        function toggleDropdown() {
          var menu = document.getElementById('dropdownMenu');
          menu.classList.toggle('hidden');
        }
      </script>

<script>
        const cart = JSON.parse(localStorage.getItem('cart')) || []; // Retrieve cart from localStorage

        // Function to add product to cart with quantity
        function addToCart(productId, productName, productPrice) {
            // Get the quantity from the input field
            const quantity = parseInt(document.getElementById(`quantity-${productId}`).value);
            
            if (quantity <= 0) {
                alert("Quantity must be at least 1!");
                return;
            }

            // Add product to the cart
            cart.push({ id: productId, name: productName, price: productPrice, quantity: quantity });
            localStorage.setItem('cart', JSON.stringify(cart)); // Save cart to localStorage
            alert(`${quantity} x ${productName} has been added to your cart!`);
        }
    </script>

<script>
    let totalPrice = 0;

    // Function to add product to the cart
    function addToCart(productId, productName, productPrice) {
        // Get the quantity from the input field
        const quantityInput = document.getElementById(`quantity-${productId}`);
        const quantity = parseInt(quantityInput.value);

        // Validate quantity
        if (quantity <= 0 || isNaN(quantity)) {
            alert("Please enter a valid quantity!");
            return;
        }

        // Get the current cart from localStorage or initialize it
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        
        // Add the product to the cart with quantity
        cart.push({ id: productId, name: productName, price: productPrice, quantity: quantity });
        
        // Save the updated cart to localStorage
        localStorage.setItem('cart', JSON.stringify(cart));

        // Update total price based on quantity
        totalPrice += productPrice * quantity;
        document.getElementById('total-price').innerText = totalPrice.toFixed(2);

       
    }
</script>




</body>

</html>
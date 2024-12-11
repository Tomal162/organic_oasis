<?php
session_start();

include 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}



// Latest Product
$host = "localhost";
$username = "root";
$password = "";
$dbname = "admin_panel";

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch latest products from the database
$sql_latest = "SELECT product_name, product_price, product_photo FROM latest";
$result_latest = $conn->query($sql_latest);

// Fetch best-selling products from the database
$sql_bestsell = "SELECT product_name, product_price, product_photo FROM bestsell";
$result_bestsell = $conn->query($sql_bestsell);
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

<body class="scroll-smooth">

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
        <a href="#">
        <div class="bg-gray-200 p-2 rounded-full">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 text-customGreen">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.401 2.401L7 13h10l1.599-7.599L21 3H3zm5 13a2 2 0 100 4 2 2 0 000-4zm8 0a2 2 0 100 4 2 2 0 000-4z" />
          </svg>
        </div>
      </div>
    </a>
  
    
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
      <a href="#shop" class="relative inline-block text-lg group">
        <span class="relative z-10 block px-5 py-3 overflow-hidden font-medium leading-tight text-customGreen transition-colors duration-300 ease-out border-2 border-customGreen rounded-lg group-hover:text-white">
        <span class="absolute inset-0 w-full h-full px-5 py-3 rounded-lg bg-gray-50"></span>
        <span class="absolute left-0 w-48 h-48 -ml-2 transition-all duration-300 origin-top-right -rotate-90 -translate-x-full translate-y-12 bg-customGreen group-hover:-rotate-180 ease"></span>
        <span class="relative">Shop</span>
        </span>
        <span class="absolute bottom-0 right-0 w-full h-12 -mb-1 -mr-1 transition-all duration-200 ease-linear bg-customGreen rounded-lg group-hover:mb-0 group-hover:mr-0" data-rounded="rounded-lg"></span>
        </a>
        <a href="#service" class="relative inline-block text-lg group">
          <span class="relative z-10 block px-5 py-3 overflow-hidden font-medium leading-tight text-customGreen transition-colors duration-300 ease-out border-2 border-customGreen rounded-lg group-hover:text-white">
          <span class="absolute inset-0 w-full h-full px-5 py-3 rounded-lg bg-gray-50"></span>
          <span class="absolute left-0 w-48 h-48 -ml-2 transition-all duration-300 origin-top-right -rotate-90 -translate-x-full translate-y-12 bg-customGreen group-hover:-rotate-180 ease"></span>
          <span class="relative">Services</span>
          </span>
          <span class="absolute bottom-0 right-0 w-full h-12 -mb-1 -mr-1 transition-all duration-200 ease-linear bg-customGreen rounded-lg group-hover:mb-0 group-hover:mr-0" data-rounded="rounded-lg"></span>
          </a>
          <a href="#service" class="relative inline-block text-lg group">
            <span class="relative z-10 block px-5 py-3 overflow-hidden font-medium leading-tight text-customGreen transition-colors duration-300 ease-out border-2 border-customGreen rounded-lg group-hover:text-white">
            <span class="absolute inset-0 w-full h-full px-5 py-3 rounded-lg bg-gray-50"></span>
            <span class="absolute left-0 w-48 h-48 -ml-2 transition-all duration-300 origin-top-right -rotate-90 -translate-x-full translate-y-12 bg-customGreen group-hover:-rotate-180 ease"></span>
            <span class="relative">Contact</span>
            </span>
            <span class="absolute bottom-0 right-0 w-full h-12 -mb-1 -mr-1 transition-all duration-200 ease-linear bg-customGreen rounded-lg group-hover:mb-0 group-hover:mr-0" data-rounded="rounded-lg"></span>
            </a>
            <a href="#offers" class="relative inline-block text-lg group">
              <span class="relative z-10 block px-5 py-3 overflow-hidden font-medium leading-tight text-customGreen transition-colors duration-300 ease-out border-2 border-customGreen rounded-lg group-hover:text-white">
              <span class="absolute inset-0 w-full h-full px-5 py-3 rounded-lg bg-gray-50"></span>
              <span class="absolute left-0 w-48 h-48 -ml-2 transition-all duration-300 origin-top-right -rotate-90 -translate-x-full translate-y-12 bg-customGreen group-hover:-rotate-180 ease"></span>
              <span class="relative">Offers</span>
              </span>
              <span class="absolute bottom-0 right-0 w-full h-12 -mb-1 -mr-1 transition-all duration-200 ease-linear bg-customGreen rounded-lg group-hover:mb-0 group-hover:mr-0" data-rounded="rounded-lg"></span>
              </a>
  </div>
    
  <!-- Banners -->

  <div class="flex space-x-4 mt-12 p-12">
    <!-- First Image (Left) -->
    <div class="relative w-50% h-50%">
      <img src="assets/spinach.png" alt="First Image" class="w-full h-full object-cover ">
      <div class="absolute inset-0 items-center left-3/4 top-3/4 ">
        <button class="px-4 py-2 border-2 border-customGreen text-customGreen font-bold uppercase hover:border-lime-900 hover:text-lime-900 transition-all duration-300 ease-in-out">
          Shop Now
        </button>
      </div>
    </div>
  
    <!-- Vertical Flex for the Next Two Images (Right) -->
    <div class="flex flex-col space-y-4 w-2/3 h-1/2">
      <!-- Second Image -->
      <div class="relative flex-1">
        <img src="assets/hairoil.png" alt="Second Image" class="w-full h-full object-cover">
        <div class="absolute inset-0 items-center ml-14 left-2/4 top-3/4">
          <button class="px-4 py-2 bg-transparent border-2 border-customGreen text-customGreen font-bold uppercase hover:border-lime-900 hover:text-lime-900 transition-all duration-300 ease-in-out">
            Shop Now
          </button>
        </div>
      </div>
      
      <!-- Third Image -->
      <div class="relative flex-1">
        <img src="assets/shampoo.png" alt="Third Image" class="w-full h-full object-cover">
        <div class="absolute inset-0 flex items-center ml-14 left-2/4 top-2/4">
          <button class="px-4 py-2 bg-transparent border-2 border-customGreen text-customGreen font-bold uppercase hover:border-lime-900 hover:text-lime-900 transition-all duration-300 ease-in-out">
            Shop Now
          </button>
        </div>
      </div>
    </div>
  </div>



  <!--Shop-->
  <h1 id="shop" class="flex justify-center mt-12 mb-12 text-4xl font-bold text-customGreen"> Shop by categories</h1>
  <div class="flex justify-center items-center">
    
    <div class="relative w-[500px] overflow-hidden">
        <!-- Left Arrow Button -->
        <button id="scrollLeft" class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-yellow-400 border rounded-full p-2 z-10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>

        <!-- Categories Container -->
        <div id="categoriesContainer" class="flex space-x-4 w-max transition-transform duration-300">
            <!-- Category 1 -->
            <a href="fruits&veges.php"><div class="min-w-[240px] bg-gray-100 p-4 rounded-lg flex-shrink-0 text-center">
              <i class="fa-solid fa-carrot text-2xl text-customGreen"></i>
                <h3 class="font-semibold text-customGreen">Fruits & Veges</h3>
                <p class="text-sm text-gray-500">Many items</p>
            </div></a>

            <!-- Category 2 -->
            <a href="breads&sweets.php"><div class="min-w-[240px] bg-gray-100 p-4 rounded-lg flex-shrink-0 text-center">
              <i class="fa-solid fa-bread-slice text-2xl text-customGreen"></i>
                <h3 class="font-semibold text-customGreen">Breads & Sweets</h3>
                <p class="text-sm text-gray-500">Many items</p>
            </div></a>

            <!-- Category 3 -->
            <a href="oil&ghee.php"><div class="min-w-[240px] bg-gray-100 p-4 rounded-lg flex-shrink-0 text-center">
              <i class="fa-solid fa-bottle-droplet text-2xl text-customGreen"></i>
                <h3 class="font-semibold text-customGreen">Oil & Ghee</h3>
                <p class="text-sm text-gray-500">Many items</p>
            </div></a>

            <!-- Category 4 -->
            <a href="milk&drinks.php"><div class="min-w-[240px] bg-gray-100 p-4 rounded-lg flex-shrink-0 text-center">
              <i class="fa-solid fa-jug-detergent text-2xl text-customGreen"></i>
                <h3 class="font-semibold text-customGreen">Milk & Drinks</h3>
                <p class="text-sm text-gray-500">Many items</p>
            </div></a>

            <!-- Category 5 -->
            <a href="naturalherbs.php"><div class="min-w-[240px] bg-gray-100 p-4 rounded-lg flex-shrink-0 text-center">
              <i class="fa-brands fa-pagelines text-2xl text-customGreen"></i>
                <h3 class="font-semibold text-customGreen">Natural Herbs</h3>
                <p class="text-sm text-gray-500">Many items</p>
            </div></a>

            <!-- Category 6 -->
            <a href="cosmetics.php"><div class="min-w-[240px] bg-gray-100 p-4 rounded-lg flex-shrink-0 text-center">
              <i class="fa-solid fa-paintbrush text-2xl text-customGreen"></i>
              <h3 class="font-semibold text-customGreen">Cosmetics</h3>
              <p class="text-sm text-gray-500">Many items</p>
          </div></a>
          <!-- Category 7 -->
          <a href="others.php"><div class="min-w-[240px] bg-gray-100 p-4 rounded-lg flex-shrink-0 text-center">
            <i class="fa-solid fa-cube text-2xl text-customGreen"></i>
            <h3 class="font-semibold text-customGreen">Others</h3>
            <p class="text-sm text-gray-500">Many items</p>
        </div></a>

            <!-- Repeat categories for smooth scrolling loop -->
            <!-- Add as many categories as needed -->
        </div>

        <!-- Right Arrow Button -->
        <button id="scrollRight" class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-yellow-400 border rounded-full p-2 z-10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </div>
</div>



  <!--Latest Products-->

  <div class="flex justify-between items-center mb-4 mt-5 p-12">
    <h2 class="text-2xl font-bold text-customGreen">Latest Products</h2>
    <div class="flex items-center space-x-2">
        <button id="prevBtn" class="p-2 bg-yellow-400 rounded-full text-white focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M12.707 14.707a1 1 0 01-1.414 0L7 10.414a1 1 0 010-1.414l4.293-4.293a1 1 0 111.414 1.414L9.414 10l3.293 3.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
        </button>
        <button id="nextBtn" class="p-2 bg-yellow-400 rounded-full text-white focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M7.293 5.293a1 1 0 011.414 0L12 8.586a1 1 0 010 1.414L8.707 13.707a1 1 0 01-1.414-1.414L10.586 10 7.293 6.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>
</div>

<!-- Product Scroll Section -->
<div class="relative overflow-hidden p-8 mb-36">
    
    <div id="productContainer1" class="flex space-x-4 transition-transform duration-300">
        <?php
        if ($result_latest->num_rows > 0) {
            // Loop through each product
            while ($row = $result_latest->fetch_assoc()) {
                $productName = htmlspecialchars($row['product_name']);
                $productPrice = number_format($row['product_price'], 2);
                $productPhoto = htmlspecialchars($row['product_photo']);

                echo "
                <div class='min-w-[250px] bg-white p-4 rounded-lg shadow-lg flex-shrink-0'>
                    <img src='admin/uploads/$productPhoto' alt='$productName' class='h-32 w-full object-cover mb-2 rounded'>
                    <h3 class='text-lg font-semibold'>$productName</h3>
                    <p class='text-gray-600'>&#2547; $productPrice</p>
                    <p class='text-sm mb-4'>1 UNIT</p>

                    <!-- Star Rating -->
                    <div class='flex space-x-1 star-container'>
                        <button class='star' data-value='1'>
                            <svg class='h-6 w-6 fill-current text-gray-300 hover:text-yellow-400 transition' viewBox='0 0 24 24'>
                                <polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'></polygon>
                            </svg>
                        </button>
                        <button class='star' data-value='2'>
                            <svg class='h-6 w-6 fill-current text-gray-300 hover:text-yellow-400 transition' viewBox='0 0 24 24'>
                                <polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'></polygon>
                            </svg>
                        </button>
                        <button class='star' data-value='3'>
                            <svg class='h-6 w-6 fill-current text-gray-300 hover:text-yellow-400 transition' viewBox='0 0 24 24'>
                                <polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'></polygon>
                            </svg>
                        </button>
                        <button class='star' data-value='4'>
                            <svg class='h-6 w-6 fill-current text-gray-300 hover:text-yellow-400 transition' viewBox='0 0 24 24'>
                                <polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'></polygon>
                            </svg>
                        </button>
                        <button class='star' data-value='5'>
                            <svg class='h-6 w-6 fill-current text-gray-300 hover:text-yellow-400 transition' viewBox='0 0 24 24'>
                                <polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'></polygon>
                            </svg>
                        </button>
                    </div>
                    <p class='mt-2 text-gray-600 text-sm'>Your Rating: <span class='user-rating'>0</span>/5</p>
                </div>";
            }
        } else {
            echo "<p class='text-gray-600'>No Latest products found.</p>";
        }
        ?>
    </div>
</div>




<!--Best Selling Products-->

<div class="flex justify-between items-center mb-4 mt-5 p-12">
    <h2 class="text-2xl font-bold text-customGreen">Best Selling</h2>
    <div class="flex items-center space-x-2">
        <button id="prevBtn2" class="p-2 bg-yellow-400 rounded-full text-white focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M12.707 14.707a1 1 0 01-1.414 0L7 10.414a1 1 0 010-1.414l4.293-4.293a1 1 0 111.414 1.414L9.414 10l3.293 3.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
        </button>
        <button id="nextBtn2" class="p-2 bg-yellow-400 rounded-full text-white focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M7.293 5.293a1 1 0 011.414 0L12 8.586a1 1 0 010 1.414L8.707 13.707a1 1 0 01-1.414-1.414L10.586 10 7.293 6.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>
</div>

<!-- Product Scroll Section -->
<div class="relative overflow-hidden p-8 mb-36">
    
    <div id="productContainer1" class="flex space-x-4 transition-transform duration-300">
        <?php
        if ($result_bestsell->num_rows > 0) {
            // Loop through each product
            while ($row = $result_bestsell->fetch_assoc()) {
                $productName = htmlspecialchars($row['product_name']);
                $productPrice = number_format($row['product_price'], 2);
                $productPhoto = htmlspecialchars($row['product_photo']);

                echo "
                <div class='min-w-[250px] bg-white p-4 rounded-lg shadow-lg flex-shrink-0'>
                    <img src='admin/uploads/$productPhoto' alt='$productName' class='h-32 w-full object-cover mb-2 rounded'>
                    <h3 class='text-lg font-semibold'>$productName</h3>
                    <p class='text-gray-600'>&#2547; $productPrice</p>
                    <p class='text-sm mb-4'>1 UNIT</p>

                    <!-- Star Rating -->
                    <div class='flex space-x-1 star-container'>
                        <button class='star' data-value='1'>
                            <svg class='h-6 w-6 fill-current text-gray-300 hover:text-yellow-400 transition' viewBox='0 0 24 24'>
                                <polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'></polygon>
                            </svg>
                        </button>
                        <button class='star' data-value='2'>
                            <svg class='h-6 w-6 fill-current text-gray-300 hover:text-yellow-400 transition' viewBox='0 0 24 24'>
                                <polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'></polygon>
                            </svg>
                        </button>
                        <button class='star' data-value='3'>
                            <svg class='h-6 w-6 fill-current text-gray-300 hover:text-yellow-400 transition' viewBox='0 0 24 24'>
                                <polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'></polygon>
                            </svg>
                        </button>
                        <button class='star' data-value='4'>
                            <svg class='h-6 w-6 fill-current text-gray-300 hover:text-yellow-400 transition' viewBox='0 0 24 24'>
                                <polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'></polygon>
                            </svg>
                        </button>
                        <button class='star' data-value='5'>
                            <svg class='h-6 w-6 fill-current text-gray-300 hover:text-yellow-400 transition' viewBox='0 0 24 24'>
                                <polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'></polygon>
                            </svg>
                        </button>
                    </div>
                    <p class='mt-2 text-gray-600 text-sm'>Your Rating: <span class='user-rating'>0</span>/5</p>
                </div>";
            }
        } else {
            echo "<p class='text-gray-600'>No Best Selling products found.</p>";
        }
        ?>
    </div>
</div>





  <!-- Offer Cupon -->

  <div class="flex justify-center items-center min-h-screen bg-lime-200 p-6" id="offers">
    <div class="bg-white shadow-lg rounded-lg max-w-5xl w-full md:flex overflow-hidden">
      <!-- Left side: Offer text -->
      <div class="p-10 bg-blue-50 flex-1 text-center content-center">
        <h1 class="text-4xl font-bold">Get <span class="text-customGreen">20% Discount</span></h1>
        <h1 class="text-4xl font-bold">On Your First Purchase</h1>
        <p class="text-gray-500 mt-4">Just Sign Up & Register now to become a member of</p>
        <img src="assets/logo.png" class="w-1/2 mx-auto">
      </div>
      <!-- Right side: Registration form -->
      <div class="p-10 bg-white flex-1">
        <form>
          <div class="mb-6">
            <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
            <input type="email" id="email" class="mt-2 w-full px-4 py-2 border rounded-md text-gray-600 focus:ring-2 focus:ring-lime-700 focus:outline-none" placeholder="Enter your email address..." />
          </div>
          <div class="mb-6">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" id="password" class="mt-2 w-full px-4 py-2 border rounded-md text-gray-600 focus:ring-2 focus:ring-lime-700 focus:outline-none" placeholder="Create a password..." />
          </div>
          <div class="mb-6">
            <label for="repeat-password" class="block text-sm font-medium text-gray-700">Repeat password</label>
            <input type="password" id="repeat-password" class="mt-2 w-full px-4 py-2 border rounded-md text-gray-600 focus:ring-2 focus:ring-lime-700 focus:outline-none" placeholder="Repeat password..." />
          </div>
          <a href="register.php" class="relative inline-block text-lg group w-full text-center">
            <span class="relative z-10 block px-5 py-3 overflow-hidden font-medium leading-tight text-customGreen transition-colors duration-300 ease-out border-2 border-customGreen rounded-lg group-hover:text-white">
            <span class="absolute inset-0 w-full h-full px-5 py-3 rounded-lg bg-gray-50"></span>
            <span class="absolute left-0 w-full h-48  transition-all duration-300 origin-top-right -rotate-90 -translate-x-full translate-y-12 bg-customGreen group-hover:-rotate-180 ease"></span>
            <span class="relative">Register it Now</span>
            </span>
            <span class="absolute bottom-0 right-0 w-full h-12 -mb-1 -mr-1 transition-all duration-200 ease-linear bg-customGreen rounded-lg group-hover:mb-0 group-hover:mr-0" data-rounded="rounded-lg"></span>
            </a>
          
        </form>
      </div>
    </div>
  </div>
  
  
  <!-- Footer -->


  

    <footer class="container mx-auto bg-white py-8 border-t border-gray-400 mt-36" id="service">
      <div class="container mx-auto grid grid-cols-1 md:grid-cols-5 gap-8 text-center md:text-left">
        <!-- Icons Section -->
        <div class="col-span-5 flex justify-around flex-wrap md:flex-nowrap">
          <div class="text-center">
            <i class="fas fa-shipping-fast text-3xl text-customGreen"></i>
            <h3 class="text-lg font-semibold mt-4 text-customGreen">Fast Delivery</h3>
           
          </div>
          <div class="text-center">
            <i class="fas fa-lock text-3xl text-customGreen"></i>
            <h3 class="text-lg font-semibold mt-4 text-customGreen">100% Secure Payment</h3>
            
          </div>
          <div class="text-center">
            <i class="fas fa-check-circle text-3xl text-customGreen"></i>
            <h3 class="text-lg font-semibold mt-4 text-customGreen">Quality Guarantee</h3>
           
          </div>
          <div class="text-center">
            <i class="fas fa-tags text-3xl text-customGreen"></i>
            <h3 class="text-lg font-semibold mt-4 text-customGreen">Guaranteed Savings</h3>
            
          </div>
          <div class="text-center">
            <i class="fas fa-gift text-3xl text-customGreen"></i>
            <h3 class="text-lg font-semibold mt-4 text-customGreen">Daily Offers</h3>
            
          </div>
        </div>
      </div>
    </div>
    
    <!-- Footer Bottom Section -->
    <div class="bg-white py-12">
      <div class="container mx-auto grid grid-cols-1 md:grid-cols-5 gap-1 text-center md:text-left">
        <!-- Logo and Social Icons -->
        <div class="md:col-span-1 flex flex-col items-center md:items-start">
          <img src="assets/logo.png" alt="" class="mb-4">
          <div class="flex space-x-4 pl-14">
            <a href="#"><i class="fab fa-facebook-f text-customGreen hover:text-lime-600"></i></a>
            <a href="#"><i class="fab fa-twitter text-customGreen hover:text-lime-600"></i></a>
            <a href="#"><i class="fab fa-pinterest text-customGreen hover:text-lime-600"></i></a>
            <a href="#"><i class="fab fa-instagram text-customGreen hover:text-lime-600"></i></a>
            <a href="#"><i class="fab fa-youtube text-customGreen hover:text-lime-600"></i></a>
          </div>
        </div>
    
        <!-- Quick Links -->
        <div class="ml-20">
          <h4 class="font-bold mb-4">Quick Links</h4>
          <ul class="space-y-2 text-gray-600">
            <li><a href="#" class="hover:underline">Home</a></li>
            <li><a href="#" class="hover:underline">Shop</a></li>
            <li><a href="#" class="hover:underline">Services</a></li>
            <li><a href="#" class="hover:underline">Contact</a></li>
            <li><a href="#" class="hover:underline">Offers</a></li>
          </ul>
        </div>
    
        <!-- Contact -->
<div class="ml-20">
  <h4 class="font-bold mb-4">Contact</h4>
  <ul class="space-y-2 text-gray-600">
    <li>
      <a href="mailto:info@example.com" class="hover:underline flex items-center">
      <div class="flex gap-2">
      <div><i class="fa-regular fa-envelope"></i></div>
      <div>info@example.com</div>
      </div>
      </a>
    </li>
    <li>
    <a href="#" class="hover:underline flex items-center">
      <div class="flex gap-2">
      <div><i class="fa-solid fa-phone"></i></div>
      <div>+996 675 588</div>
      </div>
      </a>
    </li>
    <li>
    <a href="#" class="hover:underline flex items-center">
      <div class="flex gap-2">
      <div><i class="fa-solid fa-location-dot"></i></div>
      <div>xyz Street, Hall Town Villa, Dhaka.</div>
      </div>
      </a>
    </li>
  </ul>
</div>

    
        
    
        <!-- Newsletter Subscription -->
        <div class="ml-20">
          <h4 class="font-bold mb-4">Our Newsletter</h4>
          <p class="text-gray-600 mb-4">Subscribe to our newsletter to get updates about our grand offers.</p>
          <form class="flex">
            <input type="email" class="text-sm text-center py-2 border rounded-l-md focus:outline-none" placeholder="Enter your email address">
            <button class="px-4 py-2 bg-customGreen text-white font-semibold rounded-r-md hover:bg-lime-600">Send</button>
          </form>
        </div>
      </div>
      
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
  const productContainer = document.getElementById('productContainer');
const nextBtn = document.getElementById('nextBtn');
const prevBtn = document.getElementById('prevBtn');

let scrollAmount = 0;

nextBtn.addEventListener('click', () => {
    const containerWidth = productContainer.offsetWidth;
    scrollAmount += containerWidth / 2; // Scroll half the container width
    productContainer.style.transform = `translateX(-${scrollAmount}px)`;
});

prevBtn.addEventListener('click', () => {
    const containerWidth = productContainer.offsetWidth;
    scrollAmount -= containerWidth / 2; // Scroll half the container width
    if (scrollAmount < 0) scrollAmount = 0; // Prevent scrolling back beyond the first item
    productContainer.style.transform = `translateX(-${scrollAmount}px)`;
});

</script>


<script>
  const productContainer2 = document.getElementById('productContainer2');
const nextBtn2 = document.getElementById('nextBtn2');
const prevBtn2 = document.getElementById('prevBtn2');

let scrollAmount2 = 0;

nextBtn2.addEventListener('click', () => {
    const containerWidth = productContainer2.offsetWidth;
    scrollAmount += containerWidth / 2; // Scroll half the container width
    productContainer2.style.transform = `translateX(-${scrollAmount}px)`;
});

prevBtn2.addEventListener('click', () => {
    const containerWidth = productContainer2.offsetWidth;
    scrollAmount -= containerWidth / 2; // Scroll half the container width
    if (scrollAmount < 0) scrollAmount = 0; // Prevent scrolling back beyond the first item
    productContainer2.style.transform = `translateX(-${scrollAmount}px)`;
});

</script>

<script>
 document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('categoriesContainer');
    const scrollAmount = 240; // Each category width is 240px (2 categories per view)
    const categories = container.children.length; // Number of categories
    const visibleCategories = 2; // Number of categories visible at a time
    let currentIndex = 0; // Track the current visible index

    // Auto scroll every 3 seconds
    function autoScroll() {
        currentIndex++;
        if (currentIndex >= categories - visibleCategories) {
            currentIndex = 0; // Loop back to the start
        }
        updateScrollPosition();
    }

    // Update scroll position
    function updateScrollPosition() {
        const scrollPosition = currentIndex * scrollAmount;
        container.style.transform = `translateX(-${scrollPosition}px)`;
    }

    // Scroll to the right (manual)
    document.getElementById('scrollRight').addEventListener('click', function() {
        currentIndex++;
        if (currentIndex >= categories - visibleCategories) {
            currentIndex = 0; // Loop back to the start
        }
        updateScrollPosition();
    });

    // Scroll to the left (manual)
    document.getElementById('scrollLeft').addEventListener('click', function() {
        currentIndex--;
        if (currentIndex < 0) {
            currentIndex = categories - visibleCategories; // Loop back to the end
        }
        updateScrollPosition();
    });

    // Start auto scrolling
    let autoScrollInterval = setInterval(autoScroll, 3000); // Scroll every 3 seconds

    // Pause auto scrolling when mouse is over the section
    container.addEventListener('mouseenter', function() {
        clearInterval(autoScrollInterval);
    });

    // Resume auto scrolling when mouse leaves the section
    container.addEventListener('mouseleave', function() {
        autoScrollInterval = setInterval(autoScroll, 3000);
    });
});

</script>



<!-- JavaScript for Interactive Rating -->
<script>
  // Apply rating functionality to all product cards
  document.querySelectorAll('.star-container').forEach(container => {
    const stars = container.querySelectorAll('.star');
    const ratingDisplay = container.nextElementSibling.querySelector('.user-rating');

    stars.forEach(star => {
      star.addEventListener('click', () => {
        const ratingValue = star.getAttribute('data-value');
        ratingDisplay.textContent = ratingValue;

        // Reset all stars to default color in this container
        stars.forEach(s => {
          s.querySelector('svg').classList.remove('text-yellow-400');
          s.querySelector('svg').classList.add('text-gray-300');
        });

        // Highlight the selected stars up to the clicked one
        for (let i = 0; i < ratingValue; i++) {
          stars[i].querySelector('svg').classList.add('text-yellow-400');
          stars[i].querySelector('svg').classList.remove('text-gray-300');
        }
      });
    });
  });
</script>
</body>

</html>
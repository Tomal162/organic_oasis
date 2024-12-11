<?php
session_start();

// Check if the user is logged in and retrieve the user_id
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
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
    
  <main class="container mx-auto py-8">
    <!-- Cart Table -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <table class="table-auto w-full text-left border-collapse">
            <thead>
                <tr>
                    <th class="border-b px-4 py-2">Product Name</th>
                    <th class="border-b px-4 py-2">Price (BDT)</th>
                    <th class="border-b px-4 py-2">Quantity</th>
                    <th class="border-b px-4 py-2">Subtotal</th>
                    <th class="border-b px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody id="cart-items">
                <!-- Cart items will be dynamically added here -->
            </tbody>
        </table>
        <div class="text-right mt-4">
            <p class="text-xl font-semibold">
                Total Price: <i class="fa-solid fa-bangladeshi-taka-sign"></i>
                <span id="total-price">0.00</span>
            </p>
        </div>
        <div class="mt-6 flex justify-end">
            <button onclick="placeOrder()" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md transition">
                Place Order
            </button>
        </div>
    </div>
</main>

<script>
    // Load cart from localStorage
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const cartItems = document.getElementById('cart-items');
    const totalPriceElement = document.getElementById('total-price');
    let totalPrice = 0;

    // Clear previous cart items in DOM
    cartItems.innerHTML = '';

    // Display cart items
    cart.forEach((item, index) => {
        const subtotal = item.price * item.quantity;
        totalPrice += subtotal;

        const row = `
            <tr data-index="${index}">
                <td class="border-b px-4 py-2">${item.name}</td>
                <td class="border-b px-4 py-2">&#2547; ${item.price.toFixed(2)}</td>
                <td class="border-b px-4 py-2">${item.quantity}</td>
                <td class="border-b px-4 py-2">&#2547; ${subtotal.toFixed(2)}</td>
                <td class="border-b px-4 py-2">
                    <button onclick="removeItem(${index})" class="bg-red-600 hover:bg-red-700 text-white px-4 py-1 rounded-md">
                        Remove
                    </button>
                </td>
            </tr>
        `;
        cartItems.innerHTML += row;
    });

    // Update total price
    totalPriceElement.innerText = totalPrice.toFixed(2);

    // Remove item from cart
    function removeItem(index) {
        if (confirm("Are you sure you want to remove this item?")) {
            cart.splice(index, 1); // Remove the item from the cart array
            localStorage.setItem('cart', JSON.stringify(cart)); // Update localStorage
            location.reload(); // Reload the page to update the cart display
        }
    }

    // Place Order Function
    function placeOrder() {
        if (cart.length === 0) {
            alert("Your cart is empty!");
            return;
        }

        const data = {
            cart: cart
        };

        fetch("place_order.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                alert(result.message);
                localStorage.removeItem('cart');
                window.location.href = 'index.php';
            } else {
                alert("Failed to place order: " + result.message);
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("An error occurred while placing the order. Please try again.");
        });
    }
</script>




</body>
</html>

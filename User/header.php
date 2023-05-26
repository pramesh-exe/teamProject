<?php
    $user = $_SESSION['email'];
    $uid = $_SESSION['id'];
    $query=oci_parse($conn, "SELECT * FROM USER_ONE WHERE USER_ID = '$uid'");
    oci_execute($query);
    $row=oci_fetch_assoc($query);
    $name=$row['FIRSTNAME']." ".$row['LASTNAME'];
?>
<nav class="fixed top-0 z-50 w-full bg-slate-100 border-b border-gray-200 ">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 ">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
                <a class="flex gap-2 self-center mr-2" href="./landing.php">

                    <img src="../Logo/Tribus1.png" width="35">
                    <span class="self-center text-2xl font-semibold whitespace-nowrap">TRIBUS</span>

                </a>
                <div class="ml-2 flex-initial hidden lg:inline">
                    <div class="flex justify-end items-center relative">
                        <div class="flex mr-4 items-center text-sm">
                            <a class="inline-block py-2 px-3 hover:bg-gray-200 rounded-full" href="#">
                                <div class="flex items-center relative cursor-pointer whitespace-nowrap">
                                    About Us
                                </div>
                            </a>
                            <a class="inline-block py-2 px-3 hover:bg-gray-200 rounded-full" href="#">
                                <div class="flex items-center relative cursor-pointer whitespace-nowrap">
                                    Pricing
                                </div>
                            </a>
                            <a class="inline-block py-2 px-3 hover:bg-gray-200 rounded-full" href="#">
                                <div class="flex items-center relative cursor-pointer whitespace-nowrap">
                                    Community
                                </div>
                            </a>
                            <a class="inline-block py-2 px-3 hover:bg-gray-200 rounded-full" href="#">
                                <div class="flex items-center relative cursor-pointer whitespace-nowrap">
                                    Support
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <form method="post" action="./allproducts.php">
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only ">Search</label>
                <div class="relative">
                    <input type="search" id="default-search" name='search' value="<?php if(isset($_POST['search'])){
                        $search=$_POST['search'];
                        echo "$search";
                        }
                    ?>" class="block w-64 p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 "
                        placeholder="Search Products">
                    <button type="submit"
                        class="text-white absolute right-1.5 bottom-0.5  font-medium rounded-lg text-sm px-4 py-2 "><svg
                            aria-hidden="true" class="w-5 h-5 text-gray-500 " fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg></button>
                </div>
            </form>

            <div class="relative w-10 h-10 overflow-hidden bg-gray-400 rounded-full hover:cursor-pointer" type="button">
                <svg data-dropdown-toggle="userDropdown" class=" absolute w-12 h-12 text-gray-100 -left-1"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                        clip-rule="evenodd">
                    </path>
                </svg>
            </div>
            <!-- Dropdown menu -->
            <div id="userDropdown" class="z-50 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 d">
                <div class="px-4 py-3 text-sm text-gray-900 ">
                    <div><?php echo $name?></div>
                    <div class="font-medium truncate"><?php echo $user?></div>
                </div>
                <ul class="py-2 text-sm text-gray-700 " aria-labelledby="avatarButton">
                    <li>
                        <a href="./profile.php" class="block px-4 py-2 hover:bg-gray-100 ">Profile</a>
                    </li>
                    <li>
                        <a href="./cart.php" class="block px-4 py-2 hover:bg-gray-100 ">Cart</a>
                    </li>
                    <li>
                        <a href="./wishlist.php" class="block px-4 py-2 hover:bg-gray-100 ">Wishlist</a>
                    </li>
                </ul>
                <div class="py-1">
                    <a href="../logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 ">Sign
                        out</a>
                </div>
            </div>
        </div>
    </div>
</nav>

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-slate-100 border-r border-gray-200 md:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-slate-100 ">
        <ul class="space-y-2 font-medium">
            <li>
                <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg  hover:bg-gray-900   hover:text-gray-100"
                    href="./landing.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    <span class="mx-2 text-sm font-medium">Home</span>
                </a>
            </li>
            <li>
                <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg  hover:bg-gray-900 hover:text-gray-100"
                    href="./allproducts.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418" />
                    </svg>
                    <span class="mx-2 text-sm font-medium">Explore</span>
                </a>
            </li>
            <li>
                <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg  hover:bg-gray-900 hover:text-gray-100"
                    href="./wishlist.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                    </svg>
                    <span class="mx-2 text-sm font-medium">Saved</span>
                </a>
            </li>
            <li>
                <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg  hover:bg-gray-900 hover:text-gray-100"
                    href="./cart.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                    <span class="mx-2 text-sm font-medium">Cart</span>
                </a>
            </li>
            <li>
                <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg  hover:bg-gray-900   hover:text-gray-100"
                    href="./profile.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                    <span class="mx-2 text-sm font-medium">Profile</span>
                </a>
            </li>
            <li>
                <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg  hover:bg-gray-900   hover:text-gray-100"
                    href="./purchase_history.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="mx-2 text-sm font-medium">Purchase History</span>
                </a>
            </li>
            <li>
                <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg  hover:bg-gray-900   hover:text-gray-100"
                    href="../contact.html">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                    </svg>
                    <span class="mx-2 text-sm font-medium">Contact Us</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
<div class="mb-14"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
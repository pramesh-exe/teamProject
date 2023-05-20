<?php
include 'connect.php';
if(!isset($_SESSION['email'])||!isset($_SESSION['password']) ||!isset($_SESSION['id'])) {
    header('location:./Login.php');
}
$user$_SESSION['email'];
$pass=$_SESSION['password'];
$uid=$_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TRIBUS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
    <link rel="stylesheet" href="main.css">
</head>

<body class="flex flex-col min-h-screen">
    <!-- component -->
    <nav class="bg-slate-100 sticky top-0 w-full flex justify-between items-center mx-auto md:px-8 h-20 border-b">
        <div class="flex items-start justify-between gap">

            <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                type="button"
                class="inline-flex items-center mr-2 p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-200 ">
                <span class="sr-only">Open sidebar</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd" fill-rule="evenodd"
                        d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                    </path>
                </svg>
            </button>
            <!-- logo -->

            <a class="flex items-start gap-2" href="./index.html">

                <img src="./Logo/Tribus1.png" width="35">
                <span class="self-center text-2xl font-semibold whitespace-nowrap">TRIBUS</span>

            </a>

            <!-- end logo -->
        </div>

        <!-- login -->
        <!-- <div class="flex-initial">
            <div class="flex justify-end items-center relative">
                <div class="flex mr-4 items-center gap-4">
                    <a class="inline-block py-2 px-4 hover:bg-gray-200 rounded-lg border border-slate-600"
                        href="./Register.php">
                        <div class="flex items-center relative cursor-pointer whitespace-nowrap">
                            Sign Up
                        </div>
                    </a>
                    <a class="inline-block py-2 px-6 bg-black rounded-lg border border-black text-white"
                        href="./Login.php">
                        <div class="flex items-center relative cursor-pointer whitespace-nowrap">
                            Login
                        </div>
                    </a>
                </div>
            </div>
        </div> -->
        <div class="flex px-3 lg:px-0 lg:justify-end items-center relative">
            <!-- component -->
            <div class="flex justify-center">
                <div class="relative inline-block">
                    <!-- Dropdown toggle button -->
                    <button data-target="#user-dropdown"
                        class="user-dropdown rounded-full transition-border border-2 border-slate-300 hover:border-black focus:border-black relative z-10 flex items-center text-sm text-gray-600 focus:border-blue-500 focus:ring-opacity-40 focus:ring-blue-300 focus:ring focus:outline-none">
                        <a href="#"
                            class="flex items-center text-sm transition-colors w-12 h-12 overflow-hidden items-center justify-center duration-200 transform shadow-lg rounded-full">
                            <h3 class="text-xl font-medium text-slate-700">MK</h3>
                        </a>
                    </button>

                    <!-- Dropdown menu -->
                    <div id="user-dropdown"
                        class="hidden absolute -right-100 lg:right-0 z-20 w-56 py-2 mt-2 overflow-hidden bg-white rounded-md shadow-xl">
                        <a href="#"
                            class="flex items-center p-3 -mt-2 text-sm transition-colors duration-200 transform hover:bg-black  hover:text-white">
                            <img class="flex-shrink-0 object-cover mx-1 rounded-full w-9 h-9"
                                src="https://images.unsplash.com/photo-1523779917675-b6ed3a42a561?ixid=MnwxMjA3fDB8MHxzZWFyY2h8N3x8d29tYW4lMjBibHVlfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=face&w=500&q=200"
                                alt="jane avatar">
                            <div class="mx-1">
                                <h1 class="text-sm font-semibold">Admin</h1>
                                <p class="text-sm">admin@admin.com</p>
                            </div>
                        </a>

                        <hr class="border-gray-200">

                        <a href="./profile.php"
                            class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform hover:bg-black hover:text-white">
                            view profile
                        </a>

                        <a href="#"
                            class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform hover:bg-black hover:text-white">
                            Settings
                        </a>

                        <hr class="border-gray-200">

                        <a href="#"
                            class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform hover:bg-black hover:text-white">
                            Help
                        </a>
                        <a href="./logout.php"
                            class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform hover:bg-black hover:text-white">
                            Sign Out
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end login -->
    </nav>

    <!-- Sidebar -->
    <div class="flex justify-center ">
        <aside
            class="flex-col hidden md:inline w-64 h-full fixed left-0 px-5 overflow-y-auto bg-slate-100 border-r rtl:border-r-0 rtl:border-l ">
            <div class="flex flex-col justify-between flex-1 mt-6">
                <nav class="-mx-3 space-y-6">
                    <div class="space-y-3">

                        <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg  hover:bg-gray-900   hover:text-gray-100"
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>


                            <span class="mx-2 text-sm font-medium">Home</span>
                        </a>



                        <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg  hover:bg-gray-900 hover:text-gray-100"
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                            </svg>



                            <span class="mx-2 text-sm font-medium">Products</span>
                        </a>
                        <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg  hover:bg-gray-900 hover:text-gray-100"
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>



                            <span class="mx-2 text-sm font-medium">Manage Products</span>
                        </a>
                        <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg  hover:bg-gray-900 hover:text-gray-100"
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>



                            <span class="mx-2 text-sm font-medium">Add Products</span>
                        </a>

                        <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg  hover:bg-gray-900   hover:text-gray-100"
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>


                            <span class="mx-2 text-sm font-medium">Profile</span>
                        </a>

                        <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg  hover:bg-gray-900   hover:text-gray-100"
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25M9 16.5v.75m3-3v3M15 12v5.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>



                            <span class="mx-2 text-sm font-medium">Report</span>
                        </a>

                        <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg  hover:bg-gray-900   hover:text-gray-100"
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                            </svg>


                            <span class="mx-2 text-sm font-medium">Contact Us</span>
                        </a>
                    </div>
                </nav>
            </div>
        </aside>
    </div>

    <!-- CONTENT -->

    <div class=" md:ml-64 pl-4 pt-4 gap-x-8 gap-y-4 mb-5">
        <div class="grid gap-8">
            <h3 class="text-2xl font-sans font-bold mb-2">Welcome to your Dashboard</h3>
            <div class="grid gap-8 md:grid-cols-1 lg:grid-cols-2 ">
                <a href="#"
                    class="flex flex-col items-cente border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 bg-gradient-to-r from-slate-200 ">
                    <img class="object-cover h-48 w-48 rounded-none rounded-l-lg p-2" src="./images/trader/product.png"
                        alt="">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">View Products</h5>
                        <p class="mb-3 font-normal text-gray-700 ">Here are the biggest enterprise
                            technology acquisitions of 2021 so far, in reverse chronological order.</p>
                    </div>
                </a>
                <a href="#"
                    class="flex flex-col items-center bg-gradient-to-r from-slate-200  border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 ">
                    <img class="object-cover h-48 w-48 rounded-none rounded-l-lg" src="./images/trader/add.png" alt="">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">Add Products</h5>
                        <p class="mb-3 font-normal text-gray-700 ">Here are the biggest enterprise
                            technology acquisitions of 2021 so far, in reverse chronological order.</p>
                    </div>
                </a>
            </div>
            <div class="grid gap-8 md:grid-cols-1 lg:grid-cols-2 lg:mt-8">
                <a href="#"
                    class="flex flex-col items-center bg-gradient-to-r from-slate-200  border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 ">
                    <img class="object-cover h-48 w-48 rounded-none rounded-l-lg p-2" src="./images/trader/edit.png"
                        alt="">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">Manage Products</h5>
                        <p class="mb-3 font-normal text-gray-700 ">Here are the biggest enterprise
                            technology acquisitions of 2021 so far, in reverse chronological order.</p>
                    </div>
                </a>
                <a href="#"
                    class="flex flex-col items-center bg-gradient-to-r from-slate-200  border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 ">
                    <img class="object-cover h-48 w-48 rounded-none rounded-l-lg p-2"
                        src="./images/trader/report-icon.png" alt="">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">Reports</h5>
                        <p class="mb-3 font-normal text-gray-700 ">Here are the biggest enterprise
                            technology acquisitions of 2021 so far, in reverse chronological order.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>

<!-- Footer -->
<?php
include('footer.php');
?>

</html>
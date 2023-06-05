<?php
include 'connect.php';
if(isset($_SESSION['email'])||isset($_SESSION['password']) ||isset($_SESSION['id'])) {
    header('location:./user/landing.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TRIBUS</title>
    <link rel="stylesheet" type="text/css" href="./slick/slick.css">
    <link rel="stylesheet" type="text/css" href="./slick/slick-theme.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style type="text/css">
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .slick-slide {
        margin: 0 1rem;
        /* max-width: 300px; */
    }

    .slick-arrow {
        position: relative;
    }

    .slick-prev:before,
    .slick-next:before {
        position: relative;
        color: black;
    }

    .slick-prev,
    .slick-next {
        left: 0;
        right: 0;
        transform: unset;
    }


    .slick-slide {
        transition: all ease-in-out .3s;
    }

    @media (min-width: 1024px) {
        .top-navbar {
            display: inline-flex !important;
        }

        .main-section {
            width: calc(100% - 250px) !important;
        }
    }

    @media (min-width: 1440px) {
        .main-body {
            display: flex;
            width: calc(100% - 400px);
        }

        .main-section {
            display: flex;
        }
    }

    @media (min-width: 1440px) {
        .main-body {
            display: flex;
            width: calc(100% - 400px);
        }

        .main-section {
            display: flex;
        }
    }
    </style>
</head>

<body class="top-wrapper flex flex-col max-w-full">
    <?php include 'header.php'; ?>
    <section class="main-section w-full md:ml-64 ml-6 mb-8 pt-2">
        <div class="main-body 2xl:flex">
            <div class="w-auto lg:w-full p-8">
                <div class="mb-8">
                    <h3 class="text-2xl font-sans font-bold mb-2">What's New?</h3>
                    <div class="responsive-slider flex items-center">
                        <?php
                                    $query = "SELECT * FROM (SELECT * FROM PRODUCT ORDER BY PRODUCT_ID DESC) WHERE ROWNUM <= 10";
                                    $stid = oci_parse($conn, $query);
                                    oci_execute($stid);
                                    // $st = oci_fetch_assoc($stid);
                                    while ($row = oci_fetch_array($stid))
                                     {
                                        $image=$row['PRODUCTIMAGE'];
                                        echo '<div class="flex flex-col rounded-lg overflow-hidden shadow-md hover:scale-105">
                                        <div class="w-full h-40 overflow-hidden">
                                            <a href="./product.php?id='.$row['PRODUCT_ID'].'">
                                                <img class="w-full h-40 object-cover"
                                                    src="./images/'.$image.'"
                                                    alt="product image" />
                                            </a>
                                        </div>
                                        <div class="p-4 flex flex-col gap-2">
                                            <div class="font-medium whitespace-nowrap"><a href="./product.php?id='.$row['PRODUCT_ID'].'">'.$row['NAME'].'</a></div>
                                            <div class="flex justify-between flex-col gap-2">
                                                <div class="font-bold text-2xl">&pound;'.$row['PRICE'].'</div>                                                
                                                <a href="login.php">
                                                <div
                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3.5 py-2 text-center">Add
                                                    to cart</div>
                                                    </a>
                                            </div>
                                        </div>
                                    </div>';
                                    }
                                    ?>


                    </div>
                </div>
                <div class="mb-8">
                    <h3 class="text-2xl font-sans font-bold mb-2">You may like</h3>
                    <div class="responsive-slider flex items-center">
                        <?php
                                    $query2 = "SELECT * FROM (SELECT * FROM PRODUCT ORDER BY dbms_random.value) WHERE ROWNUM <= 10";
                                    $stid2 = oci_parse($conn, $query2);
                                    oci_execute($stid2);
                                    while ($row2 = oci_fetch_array($stid2))
                                     {
                                        
                                        echo '<div class="flex flex-col rounded-lg overflow-hidden shadow-md hover:scale-105">
                                        <div class="w-full h-40 overflow-hidden">
                                            <a href="product.php?id='.$row2['PRODUCT_ID'].'">
                                                <img class="w-full h-40 object-cover"
                                                    src="./images/'.$row2['PRODUCTIMAGE'].'"
                                                    alt="product image" />
                                            </a>
                                        </div>
                                        <div class="p-4 flex flex-col gap-2">
                                        <div class="font-medium whitespace-nowrap"><a href="./product.php?id='.$row2['PRODUCT_ID'].'">'.$row2['NAME'].'</a></div>
                                            <div class="flex justify-between flex-col gap-2">
                                                <div class="font-bold text-2xl">&pound;'.$row2['PRICE'].'</div>
                                                <a href="login.php">
                                                <div
                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3.5 py-2 text-center">Add
                                                    to cart</div>
                                                    </a>
                                            </div>
                                        </div>
                                    </div>';
                                    }
                                    ?>


                    </div>
                </div>
                <div class="mb-8">
                    <h3 class="text-2xl font-sans font-bold mb-2">FRESH OFF THE SHELF</h3>
                    <div class="responsive-slider flex items-center">
                        <?php
                                    $query2 = "SELECT * FROM (SELECT * FROM PRODUCT ORDER BY dbms_random.value) WHERE ROWNUM <= 10";
                                    $stid2 = oci_parse($conn, $query2);
                                    oci_execute($stid2);
                                    while ($row2 = oci_fetch_array($stid2))
                                     {
                                        
                                        echo '<div class="flex flex-col rounded-lg overflow-hidden shadow-md hover:scale-105">
                                        <div class="w-full h-40 overflow-hidden">
                                            <a href="product.php?id='.$row2['PRODUCT_ID'].'">
                                                <img class="w-full h-40 object-cover"
                                                    src="./images/'.$row2['PRODUCTIMAGE'].'"
                                                    alt="product image" />
                                            </a>
                                        </div>
                                        <div class="p-4 flex flex-col gap-2">
                                        <div class="font-medium whitespace-nowrap"><a href="./product.php?id='.$row2['PRODUCT_ID'].'">'.$row2['NAME'].'</a></div>
                                            <div class="flex justify-between flex-col gap-2">
                                                <div class="font-bold text-2xl">&pound;'.$row2['PRICE'].'</div>
                                                <a href="login.php">
                                                <div
                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3.5 py-2 text-center">Add
                                                    to cart</div>
                                                    </a>
                                            </div>
                                        </div>
                                    </div>';
                                    }
                                    ?>


                    </div>
                </div>
            </div>
            <!-- <div class="flex flex-col p-8 min-w-[300px] w-full gap-8">
                            <div class="flex flex-col gap-6">
                                <div
                                    class="card shadow-lg p-4 rounded-lg bg-gradient-to-r from-white to-slate-200 flex flex-col gap-2">
                                    <h3 class="text-lg font-medium">Summer headphones from top brands</h3>
                                    <div class="flex justify-between items-center">
                                        <a href="#"><span
                                                class="text-slate-500 font-medium hover:text-slate-900 duration-200 transition">Get
                                                it now <i class="fas fa-arrow-right"></i></span></a>
                                        <div class="flex items-center text-sm transition-colors duration-200 transform">
                                            <img class="flex-shrink-0 object-cover mx-1 rounded-full w-14 h-14"
                                                src="https://th.bing.com/th/id/R.947c05f4a206f9b351e39dab7110482c?rik=IrKmzwj3fg4sAg&pid=ImgRaw&r=0"
                                                alt="jane avatar">
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="card shadow-lg p-4 rounded-lg bg-gradient-to-r from-white to-slate-200 flex flex-col gap-2">
                                    <h3 class="text-lg font-medium">Summer headphones from top brands</h3>
                                    <div class="flex justify-between items-center">
                                        <a href="#"><span
                                                class="text-slate-500 font-medium hover:text-slate-900 duration-200 transition">Get
                                                it now <i class="fas fa-arrow-right"></i></span></a>
                                        <div class="flex items-center text-sm transition-colors duration-200 transform">
                                            <img class="flex-shrink-0 object-cover mx-1 rounded-full w-14 h-14"
                                                src="https://th.bing.com/th/id/R.947c05f4a206f9b351e39dab7110482c?rik=IrKmzwj3fg4sAg&pid=ImgRaw&r=0"
                                                alt="jane avatar">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col gap-6">
                                <div class="flex justify-between">
                                    <h3 class="font-bold text-xl">Daily Deals</h3>
                                    <a href="#"><span
                                            class="text-slate-500 font-medium hover:text-slate-900 duration-200 transition">See
                                            all <i class="fas fa-arrow-right"></i></span></a>
                                </div>
                                <div class="items-list">
                                    <div class="flex flex-col mb-6">
                                        <div class="flex flex-col gap-2">
                                            <div class="flex gap-2">
                                                <div
                                                    class="flex items-center text-sm transition-colors duration-200 transform gap-2">
                                                    <img class="flex-shrink-0 object-cover mx-1 rounded-full w-14 h-14"
                                                        src="https://th.bing.com/th/id/R.947c05f4a206f9b351e39dab7110482c?rik=IrKmzwj3fg4sAg&pid=ImgRaw&r=0"
                                                        alt="jane avatar">
                                                    <div class="flex flex-col gap-1">
                                                        <h3 class="text-md">Summer headphones from top brands</h3>
                                                        <span class="text-sm font-medium text-slate-400">2406 Reviews |
                                                            1629
                                                            Orders</span>
                                                    </div>
                                                </div>
                                                <div class="flex justify-between items-center">
                                                    <a href="#"><span
                                                            class="text-slate-500 font-medium hover:text-slate-900 duration-200 transition">$320</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col mb-6">
                                        <div class="flex flex-col gap-2">
                                            <div class="flex gap-2">
                                                <div
                                                    class="flex items-center text-sm transition-colors duration-200 transform gap-2">
                                                    <img class="flex-shrink-0 object-cover mx-1 rounded-full w-14 h-14"
                                                        src="https://th.bing.com/th/id/R.947c05f4a206f9b351e39dab7110482c?rik=IrKmzwj3fg4sAg&pid=ImgRaw&r=0"
                                                        alt="jane avatar">
                                                    <div class="flex flex-col gap-1">
                                                        <h3 class="text-md">Summer headphones from top brands</h3>
                                                        <span class="text-sm font-medium text-slate-400">2406 Reviews |
                                                            1629
                                                            Orders</span>
                                                    </div>
                                                </div>
                                                <div class="flex justify-between items-center">
                                                    <a href="#"><span
                                                            class="text-slate-500 font-medium hover:text-slate-900 duration-200 transition">$320</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col mb-6">
                                        <div class="flex flex-col gap-2">
                                            <div class="flex gap-2">
                                                <div
                                                    class="flex items-center text-sm transition-colors duration-200 transform gap-2">
                                                    <img class="flex-shrink-0 object-cover mx-1 rounded-full w-14 h-14"
                                                        src="https://th.bing.com/th/id/R.947c05f4a206f9b351e39dab7110482c?rik=IrKmzwj3fg4sAg&pid=ImgRaw&r=0"
                                                        alt="jane avatar">
                                                    <div class="flex flex-col gap-1">
                                                        <h3 class="text-md">Summer headphones from top brands</h3>
                                                        <span class="text-sm font-medium text-slate-400">2406 Reviews |
                                                            1629
                                                            Orders</span>
                                                    </div>
                                                </div>
                                                <div class="flex justify-between items-center">
                                                    <a href="#"><span
                                                            class="text-slate-500 font-medium hover:text-slate-900 duration-200 transition">$320</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col mb-6">
                                        <div class="flex flex-col gap-2">
                                            <div class="flex gap-2">
                                                <div
                                                    class="flex items-center text-sm transition-colors duration-200 transform gap-2">
                                                    <img class="flex-shrink-0 object-cover mx-1 rounded-full w-14 h-14"
                                                        src="https://th.bing.com/th/id/R.947c05f4a206f9b351e39dab7110482c?rik=IrKmzwj3fg4sAg&pid=ImgRaw&r=0"
                                                        alt="jane avatar">
                                                    <div class="flex flex-col gap-1">
                                                        <h3 class="text-md">Summer headphones from top brands</h3>
                                                        <span class="text-sm font-medium text-slate-400">2406 Reviews |
                                                            1629
                                                            Orders</span>
                                                    </div>
                                                </div>
                                                <div class="flex justify-between items-center">
                                                    <a href="#"><span
                                                            class="text-slate-500 font-medium hover:text-slate-900 duration-200 transition">$320</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col mb-6">
                                        <div class="flex flex-col gap-2">
                                            <div class="flex gap-2">
                                                <div
                                                    class="flex items-center text-sm transition-colors duration-200 transform gap-2">
                                                    <img class="flex-shrink-0 object-cover mx-1 rounded-full w-14 h-14"
                                                        src="https://th.bing.com/th/id/R.947c05f4a206f9b351e39dab7110482c?rik=IrKmzwj3fg4sAg&pid=ImgRaw&r=0"
                                                        alt="jane avatar">
                                                    <div class="flex flex-col gap-1">
                                                        <h3 class="text-md">Summer headphones from top brands</h3>
                                                        <span class="text-sm font-medium text-slate-400">2406 Reviews |
                                                            1629
                                                            Orders</span>
                                                    </div>
                                                </div>
                                                <div class="flex justify-between items-center">
                                                    <a href="#"><span
                                                            class="text-slate-500 font-medium hover:text-slate-900 duration-200 transition">$320</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col mb-6">
                                        <div class="flex flex-col gap-2">
                                            <div class="flex gap-2">
                                                <div
                                                    class="flex items-center text-sm transition-colors duration-200 transform gap-2">
                                                    <img class="flex-shrink-0 object-cover mx-1 rounded-full w-14 h-14"
                                                        src="https://th.bing.com/th/id/R.947c05f4a206f9b351e39dab7110482c?rik=IrKmzwj3fg4sAg&pid=ImgRaw&r=0"
                                                        alt="jane avatar">
                                                    <div class="flex flex-col gap-1">
                                                        <h3 class="text-md">Summer headphones from top brands</h3>
                                                        <span class="text-sm font-medium text-slate-400">2406 Reviews |
                                                            1629
                                                            Orders</span>
                                                    </div>
                                                </div>
                                                <div class="flex justify-between items-center">
                                                    <a href="#"><span
                                                            class="text-slate-500 font-medium hover:text-slate-900 duration-200 transition">$320</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
    </section>




    <!-- Footer -->
    <footer class="mt-auto bg-slate-100 text-center text-neutral-600  lg:text-left border-t-2">
        <div class="flex items-center justify-center border-b border-neutral-200 p-4  lg:justify-between ">
            <div class="mr-12 hidden lg:block">
                <span>Get connected with us on social networks:</span>
            </div>
            <div class="flex justify-center">
                <a href="#!" class="mr-6 text-neutral-600 ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                    </svg>
                </a>
                <a href="#!" class="mr-6 text-neutral-600 ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                    </svg>
                </a>
                <a href="#!" class="mr-6 text-neutral-600 ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M7 11v2.4h3.97c-.16 1.029-1.2 3.02-3.97 3.02-2.39 0-4.34-1.979-4.34-4.42 0-2.44 1.95-4.42 4.34-4.42 1.36 0 2.27.58 2.79 1.08l1.9-1.83c-1.22-1.14-2.8-1.83-4.69-1.83-3.87 0-7 3.13-7 7s3.13 7 7 7c4.04 0 6.721-2.84 6.721-6.84 0-.46-.051-.81-.111-1.16h-6.61zm0 0 17 2h-3v3h-2v-3h-3v-2h3v-3h2v3h3v2z"
                            fill-rule="evenodd" clip-rule="evenodd" />
                    </svg>
                </a>
                <a href="#!" class="mr-6 text-neutral-600 ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                    </svg>
                </a>
                <a href="#!" class="mr-6 text-neutral-600 ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z" />
                    </svg>
                </a>
                <a href="#!" class="text-neutral-600 ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                    </svg>
                </a>
            </div>
        </div>
        <div class="mx-6 py-6 text-center md:text-left">
            <div class="grid-1 grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                <div class="">
                    <h6 class="mb-4 flex items-center justify-center font-semibold uppercase md:justify-start">
                        <img src="./Logo/Tribus1.png" alt="" class="h-4">
                        TRIBUS
                    </h6>
                    <p>
                        "Your One-Stop Online Shopping Destination"
                    </p>
                </div>
                <div class="">
                    <h6 class="mb-4 flex justify-center font-semibold uppercase md:justify-start">
                        Products
                    </h6>
                    <p class="mb-4">
                        <a href="#!" class="text-neutral-600 ">Greengrocer</a>
                    </p>
                    <p class="mb-4">
                        <a href="#!" class="text-neutral-600 ">Fishmonger</a>
                    </p>
                    <p class="mb-4">
                        <a href="#!" class="text-neutral-600 ">Delicatessen</a>
                    </p>
                    <p class="mb-4">
                        <a href="#!" class="text-neutral-600 ">Butchers</a>
                    </p>
                    <p>
                        <a href="#!" class="text-neutral-600 ">Bakery</a>
                    </p>
                </div>
                <div class="">
                    <h6 class="mb-4 flex justify-center font-semibold uppercase md:justify-start">
                        Useful links
                    </h6>
                    <p class="mb-4">
                        <a href="#!" class="text-neutral-600 ">About Us</a>
                    </p>
                    <p class="mb-4">
                        <a href="#!" class="text-neutral-600 ">Pricing</a>
                    </p>
                    <p class="mb-4">
                        <a href="#!" class="text-neutral-600 ">Community</a>
                    </p>
                    <p>
                        <a href="#!" class="text-neutral-600 ">Support</a>
                    </p>
                </div>
                <div>
                    <h6 class="mb-4 flex justify-center font-semibold uppercase md:justify-start">
                        Contact
                    </h6>
                    <p class="mb-4 flex items-center justify-center md:justify-start">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="mr-3 h-5 w-5">
                            <path
                                d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
                            <path
                                d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
                        </svg>
                        Cleckhuddersfax, UK
                    </p>
                    <p class="mb-4 flex items-center justify-center md:justify-start">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="mr-3 h-5 w-5">
                            <path fill-rule="evenodd"
                                d="M1.5 4.5a3 3 0 013-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 01-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 006.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 011.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 01-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5z"
                                clip-rule="evenodd" />
                        </svg>
                        + 44 234 567 88
                    </p>
                    <p class="flex items-center justify-center md:justify-start">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="mr-3 h-5 w-5">
                            <path fill-rule="evenodd"
                                d="M7.875 1.5C6.839 1.5 6 2.34 6 3.375v2.99c-.426.053-.851.11-1.274.174-1.454.218-2.476 1.483-2.476 2.917v6.294a3 3 0 003 3h.27l-.155 1.705A1.875 1.875 0 007.232 22.5h9.536a1.875 1.875 0 001.867-2.045l-.155-1.705h.27a3 3 0 003-3V9.456c0-1.434-1.022-2.7-2.476-2.917A48.716 48.716 0 0018 6.366V3.375c0-1.036-.84-1.875-1.875-1.875h-8.25zM16.5 6.205v-2.83A.375.375 0 0016.125 3h-8.25a.375.375 0 00-.375.375v2.83a49.353 49.353 0 019 0zm-.217 8.265c.178.018.317.16.333.337l.526 5.784a.375.375 0 01-.374.409H7.232a.375.375 0 01-.374-.409l.526-5.784a.373.373 0 01.333-.337 41.741 41.741 0 018.566 0zm.967-3.97a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H18a.75.75 0 01-.75-.75V10.5zM15 9.75a.75.75 0 00-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 00.75-.75V10.5a.75.75 0 00-.75-.75H15z"
                                clip-rule="evenodd" />
                        </svg>
                        + 44 234 567 88
                    </p>
                </div>
            </div>
        </div>
        <div class="bg-slate-100 p-3 text-center border-t-2">
            <span>© 2023 Copyright:</span>
            <a class="font-semibold text-neutral-600 " href="/index.html">TRIBUS</a>
        </div>
    </footer>



    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="./slick/slick.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $(".nav-toggler").each(function(_, navToggler) {
            var target = $(navToggler).data("target");
            $(navToggler).on("click", function() {
                console.log("OK")
                $(target).animate({
                    height: "toggle"
                });
            });
        });

        $('.responsive-slider').slick({
            infinite: false,
            dots: false,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 4,
            responsive: [{
                    breakpoint: 1536,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                    }
                },
                {
                    breakpoint: 1310,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4,
                    }
                },
                {
                    breakpoint: 1280,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                    }
                },
                {
                    breakpoint: 640,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 520,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    });
    </script>

</body>

</html>
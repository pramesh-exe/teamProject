<?php
include 'connect.php';
if ((empty(strtolower($_SESSION['email']))) || (empty($_SESSION['id']))) {
    header('location:../Login.php');
}
if(!empty($_SESSION['message'])){
    $message=$_SESSION['message'];
    echo "<script>alert('TRIBUS=> {$message}');</script>";
    unset($_SESSION['message']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TRIBUS</title>
    <link rel="stylesheet" type="text/css" href="../slick/slick.css">
    <link rel="stylesheet" type="text/css" href="../slick/slick-theme.css">
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

<body class="flex flex-col min-h-screen bg-slate-50">
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
                                                    src="../images/'.$image.'"
                                                    alt="product image" />
                                            </a>
                                        </div>
                                        <div class="p-4 flex flex-col gap-2 bg-slate-100">
                                            <div class="font-medium whitespace-nowrap"><a href="./product.php?id='.$row['PRODUCT_ID'].'">'.$row['NAME'].'</a></div>
                                            <div class="flex justify-between flex-col gap-2">
                                                <div class="font-bold text-2xl">$'.$row['PRICE'].'</div>                                                
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
                                                    src="../images/'.$row2['PRODUCTIMAGE'].'"
                                                    alt="product image" />
                                            </a>
                                        </div>
                                        <div class="p-4 flex flex-col gap-2">
                                        <div class="font-medium whitespace-nowrap"><a href="./product.php?id='.$row2['PRODUCT_ID'].'">'.$row2['NAME'].'</a></div>
                                            <div class="flex justify-between flex-col gap-2 bg-slate-100">
                                                <div class="font-bold text-2xl">$'.$row2['PRICE'].'</div>
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
                                            src="../images/'.$row2['PRODUCTIMAGE'].'"
                                                    alt="product image" />
                                            </a>
                                        </div>
                                        <div class="p-4 flex flex-col gap-2">
                                        <div class="font-medium whitespace-nowrap"><a href="./product.php?id='.$row2['PRODUCT_ID'].'">'.$row2['NAME'].'</a></div>
                                            <div class="flex justify-between flex-col gap-2 bg-slate-100">
                                                <div class="font-bold text-2xl">$'.$row2['PRICE'].'</div>
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
            <div class="flex flex-col p-8 min-w-[300px] w-full gap-8">
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
            </div>
    </section>




    <!-- Footer -->
    <?php include 'footer.php';?>


    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="../slick/slick.js" type="text/javascript" charset="utf-8"></script>
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
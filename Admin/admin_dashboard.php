<?php
include_once('connect.php');
if(!isset($_SESSION['ADMIN'])){
    header('location:../Login.php');
}
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
    <?php include "header.php"; ?>
    <!-- CONTENT -->
    <h3 class="md:ml-64 mb-4 pl-6 pt-8 mt-14 text-3xl font-sans font-bold">Welcome to your Dashboard</h3>
    <div class=" md:ml-64 pl-4 pt-4 gap-x-8 gap-y-4 mb-5">
        <div class="grid gap-8">
            <div class="grid gap-8 md:grid-cols-1 lg:grid-cols-2 ">

                <a href="./admin_viewproducts.php"
                    class="flex flex-col items-cente border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 bg-gradient-to-r from-slate-200 ">
                    <img class="object-cover h-48 w-48 rounded-none rounded-l-lg p-2" src="../images/trader/product.png"
                        alt="">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">View Products</h5>
                        <p class="mb-3 font-normal text-gray-700 ">Lorem ipsum dolor sit amet consectetur adipisicing
                            elit. A eos voluptate alias, quibusdam sed ratione, aliquid quam earum hic pariatur ut
                            veritatis asperiores debitis illum. Cupiditate ratione rem iure eaque?</p>
                    </div>
                </a>
                <a href="./admin_viewuser.php"
                    class="flex flex-col items-center bg-gradient-to-r from-slate-200  border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 ">
                    <img class="object-cover h-48 w-48 rounded-none rounded-l-lg" src="../images/admin/user.png" alt="">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">View Customers</h5>
                        <p class="mb-3 font-normal text-gray-700 ">Lorem ipsum dolor sit amet, consectetur adipisicing
                            elit. Vitae ab neque consequuntur voluptatum nostrum. Autem accusamus nam alias, aperiam
                            impedit natus distinctio doloremque, in enim possimus, nobis molestias omnis vero!</p>
                    </div>
                </a>
            </div>
            <div class="grid gap-8 md:grid-cols-1 lg:grid-cols-2 lg:mt-8">
                <a href="./admin_trader.php"
                    class="flex flex-col items-center bg-gradient-to-r from-slate-200  border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 ">
                    <img class="object-cover h-48 w-48 rounded-none rounded-l-lg p-2"
                        src="../images/admin/add-trader.png" alt="updateProduct.php">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">New Traders</h5>
                        <p class="mb-3 font-normal text-gray-700 ">Lorem ipsum dolor sit amet, consectetur adipisicing
                            elit. Delectus consectetur corporis dolorem tempore maiores numquam magni doloremque eveniet
                            temporibus repellat. Debitis vitae maiores eveniet culpa, fugiat animi asperiores voluptas
                            aut.</p>
                    </div>
                </a>
                <a href="./admin_viewtrader.php"
                    class="flex flex-col items-center bg-gradient-to-r from-slate-200  border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 ">
                    <img class="object-cover h-48 w-48 rounded-none rounded-l-lg p-2" src="../images/admin/trader.png"
                        alt="">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">View Traders</h5>
                        <p class="mb-3 font-normal text-gray-700 ">Lorem ipsum dolor sit amet consectetur, adipisicing
                            elit. Maiores unde, ad ut odio natus magni officia accusamus vel reprehenderit eos quas, quo
                            architecto! Consectetur eaque at saepe repellat perferendis iste.</p>
                    </div>
                </a>
            </div>
            <div class="grid gap-8 md:grid-cols-1 lg:grid-cols-2 lg:mt-8">
                <a href="#"
                    class="flex flex-col items-center bg-gradient-to-r from-slate-200  border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 ">
                    <img class="object-cover h-48 w-48 rounded-none rounded-l-lg p-2"
                        src="../images/trader/report-icon.png" alt="">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">Reports</h5>
                        <p class="mb-3 font-normal text-gray-700 ">Lorem ipsum dolor sit amet consectetur adipisicing
                            elit. Quas qui, vitae, minus doloremque voluptate saepe quae atque, cumque voluptates odit
                            exercitationem error id aliquam minima consequuntur? Tempore qui impedit neque.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>

<!-- Footer -->


</html>
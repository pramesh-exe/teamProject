<?php
include './connect.php';
if(!isset($_SESSION['email'])||!isset($_SESSION['password']) ||!isset($_SESSION['id'])) {
    header('location:./trader_login.php');
}
$user=$_SESSION['email'];
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
    <?php
    include 'header.php';
    ?>

    <!-- CONTENT -->

    <div class=" md:ml-64 pl-4 pt-4 gap-x-8 gap-y-4 mb-5">
        <div class="grid gap-8">
            <h3 class="text-2xl font-sans font-bold mb-2">Welcome to your Dashboard</h3>
            <div class="grid gap-8 md:grid-cols-1 lg:grid-cols-2 ">

                <a href="./trader_products.php"
                    class="flex flex-col items-center border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 bg-gradient-to-r from-slate-200 ">
                    <img class="object-cover h-48 w-48 rounded-none rounded-l-lg p-2" src="../images/trader/product.png"
                        alt="">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">View Products</h5>
                        <p class="mb-3 font-normal text-gray-700 ">View all the products from your shop.</p>
                    </div>
                </a>
                <a href="insert_product.php"
                    class="flex flex-col items-center bg-gradient-to-r from-slate-200  border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 ">
                    <img class="object-cover h-48 w-48 rounded-none rounded-l-lg" src="../images/trader/add.png" alt="">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">Add Products</h5>
                        <p class="mb-3 font-normal text-gray-700 ">You can add multiple datas one after another.</p>
                    </div>
                </a>
            </div>
            <div class="grid gap-8 md:grid-cols-1 lg:grid-cols-2 lg:mt-8">
                <a href="./trader_manageprodcts.php"
                    class="flex flex-col items-center bg-gradient-to-r from-slate-200  border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 ">
                    <img class="object-cover h-48 w-48 rounded-none rounded-l-lg p-2" src="../images/trader/edit.png"
                        alt="updateProduct.php">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">Manage Products</h5>
                        <p class="mb-3 font-normal text-gray-700 ">You can update and delete your product information.
                        </p>
                    </div>
                </a>
                <a href="http://localhost:8080/apex/f?p=102:LOGIN_DESKTOP:29759651161866:::::"
                    class="flex flex-col items-center bg-gradient-to-r from-slate-200  border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 ">
                    <img class="object-cover h-48 w-48 rounded-none rounded-l-lg p-2"
                        src="../images/trader/report-icon.png"
                        alt="http://localhost:8080/apex/f?p=102:LOGIN_DESKTOP:29759651161866:::::">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">Reports</h5>
                        <p class="mb-3 font-normal text-gray-700 ">View your reports.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>

<!-- Footer -->
<?php
include('footer.php');
?>

</html>
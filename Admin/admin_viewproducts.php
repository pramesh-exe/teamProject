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
    <?php
    include 'header.php';
    ?>

    <!-- CONTENT -->

    <span class="md:ml-64 mb-4 pl-6 pt-8 text-3xl font-sans font-bold">Products</span>

    <div class="flex:col md:ml-72 ml-6 mb-8 pt-2 gap-2 ">
        <div>
            <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                class="text-white bg-blue-600 hover:bg-blue-800 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center mb-4"
                type="button">Sort by <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg></button>
            <!-- Dropdown menu -->
            <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                    <li>
                        <a href="./admin_viewproducts.php?sid=1" class="block px-4 py-2 hover:bg-gray-100">Name
                            Ascending</a>
                    </li>
                    <li>
                        <a href="./admin_viewproducts.php?sid=2" class="block px-4 py-2 hover:bg-gray-100">Name
                            Descending</a>
                    </li>
                    <li>
                        <a href="./admin_viewproducts.php?sid=3" class="block px-4 py-2 hover:bg-gray-100">Price
                            Ascending</a>
                    </li>
                    <li>
                        <a href="./admin_viewproducts.php?sid=4" class="block px-4 py-2 hover:bg-gray-100">Price
                            Descending</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <?php
            $qry = "SELECT * FROM SHOP";
            $stid = oci_parse($conn, $qry);
            oci_execute($stid);
            while($rows=oci_fetch_array($stid,OCI_ASSOC)){
                $sid=$rows['SHOP_ID'];
            }
            if (isset($_GET['sid'])) {
                if ($_GET['sid']==1) {
                    $query = "SELECT * FROM PRODUCT ORDER BY NAME ASC";
                } 
                elseif ($_GET['sid']==2) {
                    $query = "SELECT * FROM PRODUCT ORDER BY NAME DESC";
                } 
                elseif ($_GET['sid']==3){
                    $query = "SELECT * FROM PRODUCT ORDER BY PRICE ASC";
                }
                elseif ($_GET['sid']==4){
                    $query = "SELECT * FROM PRODUCT ORDER BY PRICE DESC";
                }
            }
            else {
                $query = "SELECT * FROM PRODUCT";
            }         
            $statement = oci_parse($conn, $query);
            oci_execute($statement);
            

            echo'<table class=" w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            image
                        </th>
                        <th scope="col" class="px-6 py-3">
                            product name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            description
                        </th>
                        <th scope="col" class="px-6 py-3">
                            action
                        </th>
                    </tr>
                </thead>';
                while($row=oci_fetch_array($statement,OCI_ASSOC)){
                    $id=$row['PRODUCT_ID'];
                    echo"<tr class='bg-white border-b hover:bg-gray-50'>";
                    echo'<td class="w-48 p-2"><img src="../images/'.$row['PRODUCTIMAGE'].'"alt="product image" /></td>';
                    echo"<td class='px-6 py-4 font-medium text-gray-900 whitespace-nowrap'>".$row['NAME']."</td>";
                    echo"<td class='px-6 py-4'>$".$row['PRICE']."</td>";
                    echo"<td class='px-6 py-4'>".$row['DESCRIPTION']."</td>";
                    echo'<td><a href="../Trader/updateProduct.php?id='.$id.'&action=update" class="mr-2 text-blue-500 hover:underline">VIEW</a> | <a href="./delete_product.php?id='.$id.'&action=delete" class="ml-2 text-red-500 hover:underline">DELETE</a></td>';
                    
                }
            echo "</table>";
        ?>
        </div>
    </div>
</body>

<!-- CONTENT -->

<!-- Footer -->


</html>
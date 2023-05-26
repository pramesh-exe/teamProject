<?php
include('connect.php');

// Check if the user is logged in
if ((empty(strtolower($_SESSION['email']))) || (empty($_SESSION['id']))) {
    header('location:../Login.php');
}
if ((empty(strtolower($_SESSION['items']))) || (empty($_SESSION['total']))) {
    header('location:../Login.php');
}else{
    $items=$_SESSION['items'];
    $total=$_SESSION['total'];
}
$message="Please collect your invoice.";
echo "<script>alert('TRIBUS=> {$message}');</script>";
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
    <span class="md:ml-72 mb-4 pt-8 text-3xl font-sans font-bold">Order Summary</span>
    <div class="flex-col md:ml-72 mx-6 pt-2 gap-2 h-full">
        <div class=" w-full overflow-x-auto sm:rounded-lg">
            <?php
            $query = "SELECT c.NUMBER_OF_ITEMS, p.PRODUCT_ID, p.NAME, p.PRICE, p.PRODUCTIMAGE
                FROM cart c
                JOIN cart_product cp ON c.cart_id = cp.fk1_cart_id
                JOIN product p ON cp.fk2_product_id = p.product_id";
            $stid = oci_parse($conn, $query);
            oci_execute($stid);
            $sn=1;
            echo'<table class="table-auto border w-full">
            <thead class="text-xs text-center text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            sn
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            unit Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Quantity
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price
                        </th>
                    </tr>
                </thead>';
            while ($row = oci_fetch_array($stid)){
                echo'<tr class="text-center border-b">';
                echo'<td >'.$sn.'</td>';
                echo'<td>'.$row['NAME'].'</td>';
                echo'<td>&pound'.$row['PRICE'].'</td>';
                echo'<td>'.$row['NUMBER_OF_ITEMS'].'</td>';
                echo'<td>&pound'.$row['PRICE']*$row['NUMBER_OF_ITEMS'].'</td>';
                echo'</tr>';
                $sn++;
            }
            echo'</table>';
            ?>
        </div>
        <div class="flex justify-end w-full ">
            <div class="flex-col px-6 py-3 rounded-lg max-h-fit border divide-y divide-black">
                <div class=" -mx-6 px-6 py-3">
                    <p class="font-medium text-right">
                        Total Items:<?php echo $items;?> &emsp;&emsp;
                        Total: <?php echo '&pound'.$total;
                            $_SESSION['AMOUNT']=$total;?>
                    </p>
                </div>
                <div class="">
                    
                </div>
            </div>

        </div>
        <a href="./landing.php">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                        Proceed To Homepage
                        </button>
                    </a>   
    </div>

</body>

<!-- Footer -->
<?php
    include 'footer.php';
    ?>

</html>
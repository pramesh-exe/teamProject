<?php
include('connect.php');

// Check if the user is logged in
if ((empty(strtolower($_SESSION['email']))) || (empty($_SESSION['id']))) {
    header('location:../Login.php');
}
if ((empty(strtolower($_SESSION['items']))) || (empty($_SESSION['total']))) {
    header('location:../Login.php');
}
    $items=$_SESSION['items'];
    $total=$_SESSION['total'];
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
                        Total: <?php echo '&pound'.$total;?>
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
include_once('../try.php');
$id=$_SESSION['id'];
date_default_timezone_set("Asia/Kathmandu");
$date = date('d-M-Y'); // Format the date as per Oracle's default format

$sql = "INSERT INTO PRODUCT_ORDER (ORDER_DATE, QUANTITY, TOTAL_COST, FK2_USER_ID) 
        VALUES (to_date(:order_date, 'DD-MON-YYYY'), :quantity, :total_cost, :user_id)";

$statement = oci_parse($conn, $sql);
oci_bind_by_name($statement, ":order_date", $date);
oci_bind_by_name($statement, ":quantity", $items);
oci_bind_by_name($statement, ":total_cost", $total);
oci_bind_by_name($statement, ":user_id", $id);
oci_execute($statement);

$query = "SELECT c.NUMBER_OF_ITEMS, p.PRODUCT_ID, p.NAME, p.PRICE
                FROM cart c
                JOIN cart_product cp ON c.cart_id = cp.fk1_cart_id
                JOIN product p ON cp.fk2_product_id = p.product_id";
$stid = oci_parse($conn, $query);
oci_execute($stid);
$sql4=oci_parse($conn,"SELECT * FROM PRODUCT_ORDER ORDER BY ORDER_ID DESC");
oci_execute($sql4);
$data=oci_fetch_array($sql4,OCI_ASSOC);
$orderid=$data['ORDER_ID'];
while ($row = oci_fetch_array($stid)) {
    $count = $row['NUMBER_OF_ITEMS'];
    $productid = $row['PRODUCT_ID'];
    $sql3 = oci_parse($conn, "INSERT INTO PRODUCT_ORDER_PRODUCT (NUMBER_OF_ITEMS, FK1_ORDER_ID, FK2_PRODUCT_ID) 
                        VALUES (:count, :orderid, :productid)");
    oci_bind_by_name($sql3, ":count", $count);
    oci_bind_by_name($sql3, ":orderid", $orderid);
    oci_bind_by_name($sql3, ":productid", $productid);
    oci_execute($sql3);
}

$sql1 = oci_parse($conn, "INSERT INTO PAYMENT (AMOUNT, PAYMENT_DATE, FK1_USER_ID, FK2_ORDER_ID)
        VALUES (:amount, to_date(:payment_date, 'DD-MON-YYYY'), :user_id, :orderid)");
oci_bind_by_name($sql1, ":amount", $amount);
oci_bind_by_name($sql1, ":payment_date", $date);
oci_bind_by_name($sql1, ":user_id", $id);
oci_bind_by_name($sql1, ":orderid", $orderid);
oci_execute($sql1);
$sqlshow=oci_parse($conn,"SELECT CART_ID FROM CART WHERE FK1_USER_ID='$id'");
oci_execute($sqlshow);
$cartids = array();
while($rowss=oci_fetch_array($sqlshow,OCI_ASSOC)){
    $cartids[]=$rowss['CART_ID'];
}
foreach($cartids as $cartid){
    $sqldel=oci_parse($conn,"DELETE FROM CART_PRODUCT WHERE FK1_CART_ID='$cartid'");
    $exe=oci_execute($sqldel);
}
$sqldel1=oci_parse($conn,"DELETE FROM CART WHERE FK1_USER_ID='$id'");
$exe1=oci_execute($sqldel1);

if($exe1){  
    $messag='Payment was done successfull. Thank you for buying products from us.';
    $message="Please collect your invoice.".$messag;
    echo "<script>alert('TRIBUS=> {$message}');</script>";
}
    include 'footer.php';
    ?>

</html>
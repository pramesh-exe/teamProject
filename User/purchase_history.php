<?php
include_once('connect.php');
if ((empty(strtolower($_SESSION['email']))) || (empty($_SESSION['password']))||empty($_SESSION['id'])) {
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
    <?php
    include 'header.php';?>

    <!-- CONTENT -->
    <div class="md:ml-64 pl-6 pt-8">
        <Span class="text-4xl font-serif font-medium">Purchase History</Span>
        <div class="flex-auto border rounded overflow-x-auto shadow-md sm:rounded-lg mb-3">
            <?php
                    $id = $_SESSION['id'];
                    $query = "SELECT P.PRODUCTIMAGE, PO.Order_date, P.Name, POP.NUMBER_OF_ITEMS, P.PRICE
                    FROM PRODUCT_ORDER PO
                    JOIN USER_ONE U ON PO.fk2_user_id = U.User_id
                    JOIN PRODUCT_ORDER_PRODUCT POP ON PO.Order_id = POP.fk1_Order_id
                    JOIN PRODUCT P ON POP.fk2_Product_id = P.Product_id
                    WHERE U.USER_ID = '$id'
                    ORDER BY PO.Order_date DESC";
                    $stid = oci_parse($conn, $query);
                    oci_execute($stid);
                    $sn=1;
                    echo'<table class=" w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    SN
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    name
                                <th scope="col" class="px-6 py-3">
                                    order date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Quantity
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Paid
                                </th>
                            </tr>
                        </thead>';

                    while ($rows = oci_fetch_array($stid)){
                        echo'<tr class="border-b">';
                        echo"<td class='px-6 text-gray-900'>".$sn."</td>";
                        echo'<td class="w-48 p-2"><img src="../images/'.$rows['PRODUCTIMAGE'].'"alt="product image" class="" /></td>';
                        echo"<td class='px-6 text-gray-900'>".$rows['NAME']."</td>";
                        echo"<td class='px-6 text-gray-900'>".$rows['ORDER_DATE']."</td>";
                        echo"<td class='px-6 text-gray-900'>".$rows['NUMBER_OF_ITEMS']."</td>";
                        echo"<td class='px-6 text-gray-900'>&pound".$rows['PRICE']*$rows['NUMBER_OF_ITEMS']."</td></tr>";
                        $sn++;
                    }
                    echo "</table>"
                ?>
        </div>
    </div>
</body>
<?php
include 'footer.php';
?>

</html>
<?php
include_once('connect.php');
if ((empty(strtolower($_SESSION['email']))) || (empty($_SESSION['id']))) {
    header('location:../Login.php');
}
if(isset($_SESSION['message'])){
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
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
    <link rel="stylesheet" href="main.css">
</head>

<body class="flex flex-col min-h-screen">
    <?php
    include 'header.php';
    ?>


    <!-- CONTENT -->
    <span class="md:ml-72 mb-4 pt-8 text-3xl font-sans font-bold">Wishlist</span>
    <div class="md:ml-72 ml-6 mb-8 pt-2 gap-2 mr-4 overflow-x-auto shadow-md sm:rounded-lg">
        <?php
        $id=$_SESSION['id'];
        $wid=[];
        $pid=[];
        $query = "SELECT * FROM WISHLIST WHERE FK1_USER_ID= '$id'";
        $que =oci_parse($conn,"SELECT COUNT(*) as count from wishlist");
        oci_execute($que);
        $row=oci_fetch_array($que,OCI_ASSOC);
        $count=$row['COUNT'];
        $stid = oci_parse($conn, $query);
        oci_execute($stid);
        // if(oci_fetch_array($stid,OCI_ASSOC)>=0){
        while($rows=oci_fetch_array($stid,OCI_ASSOC)){
            $wid[]=$rows['WISHLIST_ID'];
        }
        $rows=oci_fetch_array($stid,OCI_ASSOC);
        if($count>0){
        $query2 = 'SELECT * FROM PRODUCT_WISHLIST WHERE FK1_WISHLIST_ID IN (' . implode(',', $wid) . ')';
        $stid2 = oci_parse($conn, $query2);
        oci_execute($stid2);
        while($rows=oci_fetch_array($stid2,OCI_ASSOC)){
            $pid[]=$rows['FK2_PRODUCT_ID'];
        }
        $query3 = 'SELECT * FROM PRODUCT WHERE PRODUCT_ID IN (' . implode(',', $pid) . ')';
        $stid3 = oci_parse($conn, $query3);
        oci_execute($stid3);
        

        echo'<table class=" w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">
                    IMAGE
                </th>
                <th scope="col" class="px-6 py-3">
                    PRODUCT NAME
                </th>
                <th scope="col" class="px-6 py-3">
                    PRICE
                </th>
                <th scope="col" class="px-6 py-3">
                    DESCRIPTION
                </th>
                <th scope="col" class="px-6 py-3">
                    ADD TO CART | REMOVE FROM WISHLIST
                </th>
                </tr>
        </thead>';
        while($rows=oci_fetch_array($stid3,OCI_ASSOC)){
            $id=$rows['PRODUCT_ID'];
           
            echo"<tr class='bg-white border-b '>";
            echo'<td class="w-48 p-2"><img src="../images/'.$rows['PRODUCTIMAGE'].'"alt="product image" class="" /></a></td>';
            echo'<td class="bg-slate-50 px-6 py-4 font-medium text-gray-900 whitespace-nowrap"><a href="./product.php?id='.$id.'">'.$rows["NAME"].'</a></td>';
            echo"<td class='px-6 text-gray-900'>&pound;".$rows['PRICE']."</td>";
            echo"<td class='bg-slate-50 px-6'>".$rows['DESCRIPTION']."</td>";
            echo'<td class="px-6">
                <a href="./addToCart.php?id='.$id.'&action=add" class="mr-2 text-blue-500 hover:underline">Add To Cart</a> |
                <a href="./removefromwishlist.php?id='.$id.'&action=delete" class="ml-2 text-red-500 hover:underline">DELETE</a>
                </td>
            </tr>';
        }
        echo'</table>';
    }else{
        echo "Wishlist is empty.";
    }
        ?>
    </div>
</body>

<!-- Footer -->
<?php include 'footer.php'?>

</html>
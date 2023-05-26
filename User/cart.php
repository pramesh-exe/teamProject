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
    <!-- component -->
    <?php
    include 'header.php';
    ?>


    <!-- CONTENT -->
    <span class="md:ml-72 mb-4 pt-8 text-3xl font-sans font-bold">CART</span>
    <div class="flex md:ml-72 mx-6 pt-2 gap-2 overflow-x-auto shadow-md sm:rounded-lg">
        <?php
            $id=$_SESSION['id'];
            $cid=[];
            $pid=[];
            $quantity=[];
            $price=[];
            $total = 0;
            $items = 0;
            $query4 = "SELECT COUNT(*) AS Count
                FROM cart c
                JOIN cart_product cp ON c.cart_id = cp.fk1_cart_id
                JOIN product p ON cp.fk2_product_id = p.product_id";
            $stid4 = oci_parse($conn, $query4);
            oci_execute($stid4);
            $row = oci_fetch_assoc($stid4);
            if ($row['COUNT'] > 0) {
            $query = "SELECT * FROM CART WHERE FK1_USER_ID= '$id'";
            $stid = oci_parse($conn, $query);
            oci_execute($stid);
            while($rows=oci_fetch_array($stid,OCI_ASSOC)){
                $cid[]=$rows['CART_ID'];
                $quantity[]=$rows['NUMBER_OF_ITEMS'];                
            }
            $query2 = 'SELECT * FROM CART_PRODUCT WHERE FK1_CART_ID IN (' . implode(',', $cid) . ')';
            $stid2 = oci_parse($conn, $query2);
            oci_execute($stid2);
            while($rows=oci_fetch_array($stid2,OCI_ASSOC)){
                $pid[]=$rows['FK2_PRODUCT_ID'];
            }
            $query3 = 'SELECT * FROM PRODUCT WHERE PRODUCT_ID IN (' . implode(',', $pid) . ')';
            $stid3 = oci_parse($conn, $query3);
            oci_execute($stid3);
            

            $count=0;
            
                
            
            echo'<table class=" w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Product
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            action
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
                while($rows=oci_fetch_array($stid3,OCI_ASSOC)){
                    for ($j=0; $j < count($pid); $j++) { 
                        if($rows['PRODUCT_ID']==$pid[$j]) {
                            $count=$quantity[$j];
                            $cart_id = $cid[$j];
                            
                        }
                    }
                      
                    echo"<tr class='bg-white border-b hover:bg-gray-50'>";
                        echo'<td class="w-48 p-2"><img src="../images/'.$rows['PRODUCTIMAGE'].'"alt="product image" class="" /></td>';
                        echo"<td class='bg-slate-50 px-6 py-4  whitespace-nowrap'><a href='../product.php?id=".$rows['PRODUCT_ID']."' class='font-medium text-gray-900'>".$rows['NAME']."</a><br>
                            <p class ='text=gray-200'>In Stock: ".$rows['PRODUCT_SIZE']."</p></td>";
                        echo'<td class="px-6 "><a href="./removefromcart.php"?id='.$cart_id.'&action=delete" class="ml-2 text-red-500 hover:underline">DELETE</a></td>';
                        echo"<td class='px-6 bg-slate-50 text-gray-900'>&pound;".$rows['PRICE']."</td>";
                        echo"<td class=' px-6'>";
                        echo'<form id="myForm" method="post" action="./cart_items.php">';
                        echo'<select name="options">';
                        for ($i = 1; $i <= $rows['PRODUCT_SIZE']; $i++) {
                            if ($i <=20) {
                                if($count==$i){
                                echo"<option selected value=".$i.">".$i."</option>";
                                }else{
                                echo"<option value=".$i.">".$i."</option>"; 
                                }     
                            }
                        }
                        echo'</select>
                            <input type="hidden" name="submit" value="true">
                            <input type="hidden" value="'.$cart_id.'" name="cid">
                            <button type="submit" class="hover:underline text-blue-400">Update</button>
                            </form></td>';
                        
                        echo"<td class='px-6 bg-slate-50 text-gray-900'>&pound;".$rows['PRICE']*$count."</td>";
                        echo"</tr>";
                        $total = $total + $rows['PRICE']*$count;
                        $items = $items + $count;                                    
                }
                echo"<tr class='font-bold'><td></td>
                <td></td>
                <td></td>
                <td class='flex justify-end py-6 px-3 text-lg underline'>Total</td>
                <td class='py-6 px-6'>Items: ".$items."</td>
                <td class='py-6 px-6'>&pound;".$total."</td>
                </tr>";
            echo "</table>";
            $_SESSION['items'] = $items;
            $_SESSION['total'] = $total;
            $_SESSION['AMOUNT'] = $total;
        
        
    echo'</div>';
    
    if ($items > 20) {
       echo'<div class="my-6 mx-3 flex justify-end">
       <button data-modal-target="defaultModal" data-modal-toggle="defaultModal" class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-3 text-center inline-flex items-center mr-2  " type="button">
       <svg aria-hidden="true" class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
                </path>
            </svg>
            Proceed to payment
     </button>
     </div>
     
     <!-- Main modal -->
     <div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
         <div class="relative w-full max-w-2xl max-h-full">
             <!-- Modal content -->
             <div class="relative bg-white rounded-lg shadow ">
                 <!-- Modal header -->
                 <div class="flex items-start justify-between p-4 border-b rounded-t ">
                     <h3 class="text-xl font-semibold text-gray-900 ">
                         Cannot proceed to checkout
                     </h3>
                     <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center  " data-modal-hide="defaultModal">
                         <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                         <span class="sr-only">Close modal</span>
                     </button>
                 </div>
                 <!-- Modal body -->
                 <div class="p-6 space-y-6">
                     <p class="text-base leading-relaxed text-gray-500 ">
                     Items quantity more than allowed. Please make sure that the total quantity of the goods is less or equal to 20 before checking out. Please remove some items before proceeding further.
                     </p>
                 </div>
                 <!-- Modal footer -->
                 <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b ">
                     <button data-modal-hide="defaultModal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">I understand</button>
                     
                 </div>
             </div>
         </div>
     </div>'; 
    }else {
        echo'<div class="my-6 mx-3 flex justify-end">
        <a href="./checkout.php">
        <button type="button"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-3 text-center inline-flex items-center mr-2 ">
            <svg aria-hidden="true" class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
                </path>
            </svg>
            Proceed to payment
        </button>
        </a>
    </div>';
    }
} else {
    echo 'The cart is empty. </div>';

}
    ?>


</body>

<!-- Footer -->
<?php
    include 'footer.php';
    ?>

</html>
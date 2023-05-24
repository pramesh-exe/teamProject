<?php
include_once('connect.php');
if ((empty(strtolower($_SESSION['email']))) || (empty($_SESSION['id']))) {
    header('location:./Login.php');
}
if(isset($_SESSION['message'])){
    $message=$_SESSION['message'];
    echo "<script>alert('TRIBUS=> {$message}');</script>";
    unset($message);
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
    <div class="flex md:ml-72 ml-6 pt-2 gap-2 overflow-x-auto shadow-md sm:rounded-lg">
        <?php
            $id=$_SESSION['id'];
            $cid=[];
            $pid=[];
            $quantity=[];
            $price=[];
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
            echo'<table class="table-auto w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Product
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Quantity
                        </th>
                        <th scope="col" class="px-6 py-3">
                            unit Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            action
                        </th>
                    </tr>
                </thead>';
                while($rows=oci_fetch_array($stid3,OCI_ASSOC)){
                    for ($j=0; $j < count($pid); $j++) { 
                        if($rows['PRODUCT_ID']==$pid[$j]) {
                            $count=$quantity[$j];
                        }
                    }    
                    echo"<tr class='bg-white border-b '>";
                        echo'<td><img src="../images/'.$rows['PRODUCTIMAGE'].'"alt="product image" class="w-32" /></a></td>';
                        echo"<td class='bg-slate-50 px-6 py-4  whitespace-nowrap'><a href='../product.php?id=".$rows['PRODUCT_ID']."' class='font-medium text-gray-900'>".$rows['NAME']."</a><br>
                            <p class ='text=gray-200'>In Stock: ".$rows['PRODUCT_SIZE']."</p></td>";
                        echo"<td class=' px-6'>";
                        echo'<form id="myForm" method="post" action="">';
                        echo'<select name="options" onchange="submitForm()">';
                        for ($i = 1; $i <= $rows['PRODUCT_SIZE']; $i++) {
                            if($count==$i){
                            echo"<option selected value=".$i.">".$i."</option>";
                            }else{
                            echo"<option value=".$i.">".$i."</option>"; 
                            }     
                        }
                        echo'</select>
                            <input type="hidden" name="submit" value="true">
                            </form></td>';
                        echo"<td class='px-6 bg-slate-50 text-gray-900'>$".$rows['PRICE']."</td>";
                        
                        echo"<td class='px-6  text-gray-900'>$".$rows['PRICE']*$count."</td>";
                        echo'<td class="px-6 bg-slate-50"><a href="./removefromwishlist.php"?id=$id&action=delete" class="ml-2 text-red-500 hover:underline">DELETE</a></td>';
                        echo"</tr>";
                                    
                }
            echo "</table>";
        ?>
    </div>
    <script>
    function submitForm() {
        document.getElementById('myForm').submit();
    }
    </script>

</body>

<!-- Footer -->
<?php
    include 'footer.php';
    ?>


</html>
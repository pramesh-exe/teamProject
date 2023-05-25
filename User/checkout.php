<?php
include('connect.php');

// Check if the user is logged in
if ((empty(strtolower($_SESSION['email']))) || (empty($_SESSION['id']))) {
    header('location:../Login.php');
}

// Function to display collection days
function collection(){
    date_default_timezone_set("Asia/Kathmandu");
    $a = date("Y/m/d");
    $b = date("l");
    $c = date("h:i:sa");

    if ($b == "Sunday" || $b == "Monday" || $b =="Tuesday") {
        $day1 = <<<SPLIT
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
SPLIT;
        echo $day1;
    } else if($b == "Wednesday") {
        $day2 = <<<SPLIT
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
SPLIT;
        echo $day2;
    } else if($b == "Thursday") {
        $day1 = <<<SPLIT
            <option value="Friday">Friday</option>
            <option value="Wednesday">Next Wednesday</option>
SPLIT;
        echo $day1;
    } else if($b == "Friday") {
        $day1 = <<<SPLIT
            <option value="Wednesday">Next Wednesday</option>
            <option value="Thursday">Next Thursday</option>
SPLIT;
        echo $day1;
    } else {
        $day1 = <<<SPLIT
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
SPLIT;
        echo $day1;
    }
}


// Function to display collection time slots
function timer(){
    $b = date("l");
    $c = date("h G");

    if ($b == "Sunday" || $b == "Monday" || $b =="Tuesday" || $b == "Saturday") {
        $d5 = <<<SPLIT
            <option value="10am to 1pm">10 a.m to 1 p.m</option>
            <option value="1pm to 4pm">1 p.m to 4 p.m</option>
            <option value="4pm to 7pm">4 p.m to 7 p.m</option>
SPLIT;
        echo $d5;
    } else {
        if ($c > "18" || $c < "10"){
            $d1 = <<<SPLIT
                <option value="10am to 1pm">10 a.m to 1 p.m</option>
                <option value="1pm to 4pm">1 p.m to 4 p.m</option>
                <option value="4pm to 7pm">4 p.m to 7 p.m</option>
SPLIT;
            echo $d1;
        } elseif ($c < 13) {
            $d2 = <<<SPLIT
                <option value="1pm to 4pm">1 p.m to 4 p.m</option>
                <option value="4pm to 7pm">4 p.m to 7 p.m</option>
SPLIT;
            echo $d2;
        } elseif ($c < 16) {
            $d3 = <<<SPLIT
                <option value="4pm to 7pm">4 p.m to 7 p.m</option>
SPLIT;
            echo $d3;
        }
    }
}
?>
<div class="flex md:ml-72 mx-6 pt-2 gap-2 overflow-x-auto shadow-md sm:rounded-lg">
        <?php
            $id=$_SESSION['id'];
            $cid=[];
            $pid=[];
            $quantity=[];
            $price=[];
            $total = 0;
            $items = 0;
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
                           Product Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Decription
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
                        }
                    }    
                    echo"<tr class='bg-white border-b hover:bg-gray-50'>";
                        echo"<td class='bg-slate-50 px-6 py-4  whitespace-nowrap'><a href='../product.php?id=".$rows['PRODUCT_ID']."' class='font-medium text-gray-900'>".$rows['NAME']."</a><br></td>";
                        echo"<td class='px-6 bg-slate-50 text-gray-900'>".$rows['DESCRIPTION']."</td>";
                        echo"<td class='px-6 bg-slate-50 text-gray-900'>&pound;".$rows['PRICE']."</td>";
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
                        
                        echo"<td class='px-6 bg-slate-50 text-gray-900'>$".$rows['PRICE']*$count."</td>";
                        echo"</tr>";
                        $total = $total + $rows['PRICE']*$count;
                        $items = $items + $count;                                    
                }
                echo"<tr class='font-bold'><td></td>
                <td></td>
                <td></td>
                <td class='flex justify-end py-6 px-3 text-lg underline'>Total</td>
                <td class='py-6 px-6'>Items: ".$items."</td>
                <td class='py-6 px-6'>Total Amount: &pound;".$total."</td>
                </tr>";
            echo "</table>";
            
        ?>
    </div>

<!-- HTML form -->
<form>
    <label for="collection_day">Select Collection Day:</label>
    <select name="collection_day" id="collection_day">
        <?php collection(); ?>
    </select>

    <label for="collection_time">Select Collection Time:</label>
    <select name="collection_time" id="collection_time">
        <?php timer(); ?>
    </select>

    <button type="submit">Submit</button>
</form>
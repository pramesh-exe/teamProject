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
                            IMAGE
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
                echo'<td ><img src="../images/'.$row['PRODUCTIMAGE'].'"alt="product image" class="w-32" /></td>';
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
                        Total: <?php echo '&pound'.$total; ?>
                    </p>
                </div>
                <div class="">
                    <form>
                        <label for="collection_day">Select Collection Day:</label>
                        <select name="collection_day" id="collection_day"
                            class="bg-gray-50 border border-gray-300 text-gray-900 my-6 text-sm rounded-lg  focus:border-blue-500 inline p-2.5">
                            <?php collection(); ?>
                        </select>
                        <br />
                        <label for="collection_time">Select Collection Time:</label>
                        <select name="collection_time" id="collection_time"
                            class="bg-gray-50 border border-gray-300 text-gray-900 my-6 text-sm rounded-lg  focus:border-blue-500 inline p-2.5">
                            <?php timer(); ?>
                        </select>
                        <br />
                        <button type="button"
                            class="text-white bg-gradient-to-r from-[#253B80] to-[#169BD7] hover:bg-gradient-to-bl font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 mb-2">
                            <svg class="w-4 h-4 mr-2 -ml-1" aria-hidden="true" focusable="false" data-prefix="fab"
                                data-icon="paypal" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                <path fill="currentColor"
                                    d="M111.4 295.9c-3.5 19.2-17.4 108.7-21.5 134-.3 1.8-1 2.5-3 2.5H12.3c-7.6 0-13.1-6.6-12.1-13.9L58.8 46.6c1.5-9.6 10.1-16.9 20-16.9 152.3 0 165.1-3.7 204 11.4 60.1 23.3 65.6 79.5 44 140.3-21.5 62.6-72.5 89.5-140.1 90.3-43.4 .7-69.5-7-75.3 24.2zM357.1 152c-1.8-1.3-2.5-1.8-3 1.3-2 11.4-5.1 22.5-8.8 33.6-39.9 113.8-150.5 103.9-204.5 103.9-6.1 0-10.1 3.3-10.9 9.4-22.6 140.4-27.1 169.7-27.1 169.7-1 7.1 3.5 12.9 10.6 12.9h63.5c8.6 0 15.7-6.3 17.4-14.9 .7-5.4-1.1 6.1 14.4-91.3 4.6-22 14.3-19.7 29.3-19.7 71 0 126.4-28.8 142.9-112.3 6.5-34.8 4.6-71.4-23.8-92.6z">
                                </path>
                            </svg>
                            Check out with PayPal
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>



</body>

<!-- Footer -->
<?php
    include 'footer.php';
    ?>

</html>
<!-- HTML form -->
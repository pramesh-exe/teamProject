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
                        Total: <?php echo '&pound'.$total;
                            $_SESSION['AMOUNT']=$total;?>
                    </p>
                </div>
                <div class="">
                    <form method='post'>
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
                        <button type="submit" name='collectionslot'
                            class="text-white bg-gradient-to-r from-[#253B80] to-[#169BD7] hover:bg-gradient-to-bl font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 mb-2">
                            SUBMIT SLOT
                            
                        </button>
                    </form>
                    <?php
                        if(isset($_POST['collectionslot'])){
                            $ctime=$_POST['collection_time'];
                            $cday=$_POST['collection_day'];
                            $date=$ctime.$cday;
                            // Generate a random slot number
                            $slotNumber = mt_rand(1, 6);
                            
                            // Prepare and execute the SQL query
                            $sql = "INSERT INTO SLOT (SLOT_NUMBER, TIME, FK1_ORDER_ID)
                                    VALUES ( :slotNumber, :ctime, :orderId)";
                            $stmt = oci_parse($conn, $sql);
                            oci_bind_by_name($stmt, ":slotNumber", $slotNumber);
                            oci_bind_by_name($stmt, ":ctime", $date);
                            oci_bind_by_name($stmt, ":orderId", $orderId); // Replace with the actual order ID

                            if (oci_execute($stmt)) {
                                $message = "Slot data inserted successfully.";
                                echo "<script>alert('TRIBUS=> {$message}');</script>";
                            } else {
                                $message = "Slot data inserted successfully.";
                                echo "<script>alert('TRIBUS=> {$message}');</script>";
                            }

                        }else{
                            $message="Please select your viable slot before proceeding to pay via paypal. Slot must be confirmed to collect your product from collections slots.";
                            echo "<script>alert('TRIBUS=> {$message}');</script>";
                        }
                    echo "<br><br>";
                    echo "<strong>Payment Option:</strong>";
                    ?>
                </div>
                <?php
                                if(isset($_SESSION['AMOUNT'])){
                                $billAmount = $_SESSION['AMOUNT'];
                                }else{
                                header('location:./cart.php');
                                }

                                // Output the bill amount as JavaScript variable
                                echo '<script>';
                                echo 'var billAmount = ' . $billAmount . ';';
                                echo '</script>';
                                ?>

                                <!-- HTML content -->
                                <!DOCTYPE html>
                                <html>
                                <head>
                                <title>PayPal Payment</title>
                                </head>
                                <body>
                                <!-- PayPal payment button container -->
                                <div id="paypal-payment-button"></div>

                                <!-- Include the PayPal JavaScript SDK -->
                                <script src="https://www.paypal.com/sdk/js?client-id=ATClx8zyecvgRHDKtgs_ihWO4evHjsbhKndT8jGq47x4HJWre5yc9krapjFQHIrDA4nAUbruAVjhZDC4&currency=GBP&disable-funding=credit,card"></script>

                                <script>
                                    // PayPal button configuration
                                    paypal.Buttons({
                                    style: {
                                        color: 'blue',
                                        shape: 'pill'
                                    },
                                    createOrder: function(data, actions) {
                                        return actions.order.create({
                                        purchase_units: [{
                                            amount: {
                                                currency_code: 'GBP',
                                            value: billAmount
                                            }
                                        }]
                                        });
                                    },
                                    onApprove: function(data, actions) {
                                        return actions.order.capture().then(function(details) {
                                        console.log(details);
                                        window.location.replace("http://localhost/github/teamProject/user/success.php");
                                        });
                                    },
                                    onCancel: function(data) {
                                        window.location.replace("http://localhost/github/teamProject/user/Oncancel.php");
                                    }
                                    }).render('#paypal-payment-button');
                                </script>
                                </body>
                                </html>
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
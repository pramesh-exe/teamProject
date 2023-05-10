<?php
include('connect.php');
$query = "SELECT * FROM (SELECT * FROM PRODUCT ORDER BY PRODUCT_ID DESC) WHERE ROWNUM <= 7";
$stid = oci_parse($conn, $query);
oci_execute($stid);
// $st = oci_fetch_assoc($stid);
$filename = "image"; // filename without extension
$directory = "Images/"; // directory where the image is stored
$allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
while ($row = oci_fetch_array($stid))
{
    $filename=$row['PRODUCTIMAGE'];
    foreach ($allowed_extensions as $extension) {
        if (file_exists($directory . $filename . '.' . $extension)) {
            // Display the image
            
            break;
        }
    }
    echo '<div class="flex flex-col rounded-lg overflow-hidden shadow-md">
    <div class="w-full h-40 overflow-hidden">
    <a href="#">
    <img class="w-full h-40 object-cover"
    src="' . $directory . $filename . '.' . $extension . '"
    alt="product image" />
    </a>
    </div>
    <div class="p-4 flex flex-col gap-2">
    <div class="font-medium">'.$row['NAME'].'</div>
    <div class="flex justify-between flex-col gap-2">
    <div class="font-bold text-2xl">$'.$row['PRICE'].'</div>
    <button
    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3.5 py-2 text-center">Add
    to cart</button>
    </div>
    </div>
    <div class="flex flex-col rounded-lg overflow-hidden shadow-md">
    <div class="w-full h-40 overflow-hidden">
    <a href="#">
    <img class="w-full h-40 object-cover"
    src="./Imgaes/'.$row['PRODUCTIMAGE'].'.jpg"
    alt="product image" />
    </a>
    </div>
    </div>';
}
?>
<?php
include 'connect.php';

$id=$_GET['id'];

$query = "SELECT * FROM PRODUCT WHERE PRODUCT_ID=$id";

$stid = oci_parse($conn, $query);
oci_execute($stid);

$row = oci_fetch_array($stid, OCI_ASSOC);

$image=$row['PRODUCTIMAGE'];
echo'<img class="w-full h-40 object-cover"
src="./Imgaes/'.$image.'.jpg"
alt="product image" />
</a>';
?>
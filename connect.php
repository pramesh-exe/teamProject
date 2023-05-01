<?php
$conn = oci_connect('TeamProject', 'Nepal123', '//localhost/xe'); 
if (!$conn) {
   $m = oci_error();
   echo $m['message'], "\n";
   exit;
}
?>
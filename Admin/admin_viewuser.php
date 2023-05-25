<?php
include_once('connect.php');
if(!isset($_SESSION['ADMIN'])){
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
    <?php include "header.php"; ?>
    <span class="md:ml-64 mb-4 pl-6 pt-8 text-3xl font-sans font-bold">Customers</span>
    <div class="flex md:ml-72 mx-6 pt-2 gap-2 relative overflow-x-auto shadow-md sm:rounded-lg">
        <?php
        $query = "SELECT * FROM USER_ONE WHERE type = 'user'";
        $statement = oci_parse($conn, $query);
        oci_execute($statement);
        $order = 0;
    
        echo'<table class="table-auto w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        contact
                    </th>
                    <th scope="col" class="px-6 py-3">
                        email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Total Orders
                    </th>
                    <th scope="col" class="px-6 py-3">
                        action
                    </th>
                </tr>
            </thead>';
            while($row=oci_fetch_array($statement,OCI_ASSOC)){
                $id = $row['USER_ID'];;
                $query2 = "SELECT * FROM PRODUCT_ORDER WHERE FK2_USER_ID = '$id'";
                $stid = oci_parse($conn, $query2);
                oci_execute($stid);
                while($rows=oci_fetch_array($stid,OCI_ASSOC)){
                    $order++;
                }
                echo"<tr class='bg-white border-b '><td class='px-6 py-4 font-medium text-gray-900 whitespace-nowrap'>".$row['FIRSTNAME']." ".$row['LASTNAME']."</td>";
                if(isset($row['CONTACT'])){
                    echo"<td>+".$row['CONTACT']."</td>";
                }
                else{
                    echo"<td>-</td>";
                }
                echo"<td class='px-6'>".$row['EMAIL']."</td>";
                echo"<td class='px-6'>".$order."</td>";
                echo"<td><a href='' class='mr-2 text-blue-500 hover:underline'>VIEW</a> <a href='' class='text-red-500 hover:underline'>DELETE</a></td> </tr>";
                ;
                
            }
        echo "</table>";
        ?>
    </div>
</body>

<!-- CONTENT -->

<!-- Footer -->


</html>
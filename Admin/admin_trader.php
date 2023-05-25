<?php
include_once('connect.php');
if(!isset($_SESSION['ADMIN'])){
    header('location:../Login.php');
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
    <?php include 'header.php'; ?>


    <!-- CONTENT -->
    <span class="md:ml-64 pl-6 pt-8 mt-14 text-3xl font-sans font-bold">Trader's Request</span>
    <div class="flex md:ml-72 mx-6 pt-2 overflow-x-auto shadow-md sm:rounded-lg">
        <?php
    $datas=oci_parse($conn,"SELECT * FROM TRADER_APPROVAL ORDER BY TRADER_APPROVAL_ID");
    oci_execute($datas);
    $datas1=oci_parse($conn, "SELECT COUNT(*) FROM TRADER_APPROVAL ORDER BY TRADER_APPROVAL_ID");
    oci_execute($datas1);
    $data1=oci_fetch_array($datas1,OCI_ASSOC);
    $count=$data1['COUNT(*)'];
    if($count>=1){
        echo'<table class="table-auto w-full text-sm text-left text-gray-500">
        <thead class="text-sm uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-3 py-3">
                        name
                    </th>
                    <th scope="col" class="px-3 py-3">
                        address
                    </th>
                    <th scope="col" class="px-3 py-3">
                        contact
                    </th>
                    <th scope="col" class="px-3 py-3">
                        email
                    </th>
                    <th scope="col" class="px-3 py-3">
                        shop name
                    </th>
                    <th scope="col" class="px-3 py-3">
                        category
                    </th>
                    <th scope="col" class="px-3 py-3 text-center">
                        action
                    </th>
                </tr>
            </thead>';
        while($data=oci_fetch_array($datas,OCI_ASSOC)){
            $Ffirstname=$data['FIRSTNAME'];
            $Flastname=$data['LASTNAME'];
            $user=$Ffirstname.' '.$Flastname;
            $Faddress=$data['ADDRESS'];
            $contact=$data['CONTACT'];
            $Vemail=$data['EMAIL'];
            $id=$data['TRADER_APPROVAL_ID'];
            $gender=$data['GENDER'];
            $Fscategory=$data['SHOPCATEGORY'];
            $Fsname=$data['SHOPNAME'];
            echo"<tr class='bg-white border-b hover:bg-gray-50'>
                <td class='px-3 py-4 font-medium text-gray-900 whitespace-nowrap'>".$Ffirstname." ".$Flastname."</td>";
            echo"<td class='px-3 py-4'>".$Faddress."</td>";
            echo"<td class='px-3 py-4'>".$contact."</td>";
            echo"<td class='px-3 py-4'>".$Vemail."</td>";
            echo"<td class='px-3 py-4'>".$Fscategory."</td>";
            echo"<td class='px-3 py-4'>".$Fsname."</td>";
            echo "<td class='px-3 py-4 text-center'> <a class='text-blue-500' href=./trader_approval.php?id=$id&action=add>Approve</a> |
            <a class='text-red-500' href=./trader_disapproval.php?id=$id&action=delete>Disapprove</a></td></tr>";   
        }
    echo "</table>";
}
?>
        </br>
    </div>
</body>


</html>
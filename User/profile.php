<?php
include_once('connect.php');
if ((empty(strtolower($_SESSION['email']))) || (empty($_SESSION['password']))||empty($_SESSION['id'])) {
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
    <!-- component -->
    <?php
    include 'header.php';?>

    <!-- CONTENT -->
    <div class="md:ml-64 pl-6 pt-8">
        <div class="flex items-end justify-start gap-3">
            <p class="font-semibold text-4xl ">My Account
                <?php
                    $id = $_SESSION['id'];
                    $user = strtolower($_SESSION['email']);
                    $pass = $_SESSION['password'];
                    $info = "SELECT * FROM USER_ONE WHERE EMAIL=:email AND password=:password";
                    $userinfo = oci_parse($conn, $info) or die(oci_error($conn, $info));
                    oci_bind_by_name($userinfo, ":email", $user);
                    oci_bind_by_name($userinfo, ":password", $pass);
                    oci_execute($userinfo);
                    $row = oci_fetch_assoc($userinfo);
                    $fname = $row['FIRSTNAME'];
                    $lname = $row['LASTNAME'];
                    $email = strtolower($row['EMAIL']);
                    $contact = $row['CONTACT'];
                    $address = $row['ADDRESS'];
                    $query = "SELECT * FROM PRODUCT_ORDER WHERE FK2_USER_ID= '$id'";
                    $stid = oci_parse($conn, $query);
                    oci_execute($stid);
                    oci_fetch_all($stid, $result, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                    $order = count($result);
                    $query = "SELECT * FROM WISHLIST WHERE FK1_USER_ID= '$id'";
                    $stid = oci_parse($conn, $query);
                    oci_execute($stid);
                    oci_fetch_all($stid, $result, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                    $wishlist = count($result);
                    $query = "SELECT * FROM CART WHERE FK1_USER_ID= '$id'";
                    $stid = oci_parse($conn, $query);
                    oci_execute($stid);
                    oci_fetch_all($stid, $result, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                    $cart = count($result); 
                ?>
            </p>

        </div>
        <div class="flex flex-grow flex-wrap lg:flex-nowrap my-4 gap-2 w-11/12">
            <div class="bg-gray-100 p-3 border rounded grow lg:basis-1/2">
                <Span class="font-serif font-semibold text-lg mr-2">Personal Profile</Span>
                <a href="./update.php" class="text-blue-600 hover:underline">Edit Profile</a>
                <p class="mt-2">Name: <?php 
                echo $fname." ".$lname ; 
                ?></p>
                <p class="mt-2">Email: <?php 
                 echo $email;
                ?></p>
                <p class="mt-2">Contact: +<?php
                 echo $contact;
                  ?></p>
                <p class="mt-2">Address:
                    <?php
                   echo $address;
                  ?>
                </p>
            </div>
            <div class="bg-gray-100 p-3 border rounded grow lg:basis-1/2">
                <Span class="font-serif font-semibold text-lg mr-2">Stats</Span>
                <div class="flex mt-2 gap-6 px-2">
                    <div class="basis-1/3">
                        <span class="font-medium">Total Orders </span>
                        <p class="text-2xl lg:text-6xl font-sans font-semibold"><?php echo $order;?></p>
                    </div>
                    <div class="basis-1/3">
                        <span class="font-medium">Cart</span>
                        <p class="text-2xl lg:text-6xl font-sans font-semibold"><?php echo $cart;?></p>
                    </div>
                    <div class="basis-1/3">
                        <span class="font-medium">Saved</span>
                        <p class="text-2xl lg:text-6xl font-sans font-semibold"><?php echo $wishlist;?></p>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <Span class="text-4xl font-serif font-medium">Recent Orders</Span>
            <div class="bg-gray-100 p-3 flex-auto w-11/12 border rounded overflow-x-auto shadow-md sm:rounded-lg">
                <?php

                ?>
            </div>
        </div>
    </div>
</body>
<?php
include 'footer.php';
?>

</html>
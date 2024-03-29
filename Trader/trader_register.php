<?php
include_once('connect.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
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
    <nav
        class="bg-slate-100 sticky top-0 w-full flex justify-between items-center mx-auto md:px-8 h-20 border-b bg-opacity-[0.97]">
        <div class="flex items-start justify-between gap">

            <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                type="button"
                class="inline-flex items-center mr-2 p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-200 ">
                <span class="sr-only">Open sidebar</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd" fill-rule="evenodd"
                        d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                    </path>
                </svg>
            </button>
            <!-- logo -->

            <a class="flex items-start gap-2" href="./index.html">

                <img src="../Logo/Tribus1.png" width="35">
                <span class="self-center text-2xl font-semibold whitespace-nowrap">TRIBUS</span>

            </a>

            <!-- end logo -->

            <!-- nav links -->
            <div class="ml-2 flex-initial hidden lg:inline">
                <div class="flex justify-end items-center relative">
                    <div class="flex mr-4 items-center text-sm">
                        <a class="inline-block py-2 px-3 hover:bg-gray-200 rounded-full" href="#">
                            <div class="flex items-center relative cursor-pointer whitespace-nowrap">
                                About Us
                            </div>
                        </a>
                        <a class="inline-block py-2 px-3 hover:bg-gray-200 rounded-full" href="#">
                            <div class="flex items-center relative cursor-pointer whitespace-nowrap">
                                Pricing
                            </div>
                        </a>
                        <a class="inline-block py-2 px-3 hover:bg-gray-200 rounded-full" href="#">
                            <div class="flex items-center relative cursor-pointer whitespace-nowrap">
                                Community
                            </div>
                        </a>
                        <a class="inline-block py-2 px-3 hover:bg-gray-200 rounded-full" href="#">
                            <div class="flex items-center relative cursor-pointer whitespace-nowrap">
                                Support
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- end nav links -->
        </div>

        <!-- search bar -->
        <div class="hidden sm:block flex-shrink flex-grow-0 justify-start px-2">
            <div class="inline-block">
                <div class="inline-flex items-center max-w-full">
                    <button
                        class="flex items-center flex-grow-0 flex-shrink pl-2 relative w-60 border rounded-lg px-1 py-1 bg-white"
                        type="button">
                        <input class="block flex-grow flex-shrink overflow-hidden focus:outline-none px-4 py-1"
                            placeholder="Search Product" />

                        <div class="flex items-center justify-center relative h-8 w-8 rounded-lg">
                            <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                role="presentation" focusable="false" style="
                    display: block;
                    fill: none;
                    height: 12px;
                    width: 12px;
                    stroke: currentcolor;
                    stroke-width: 5.33333;
                    overflow: visible;
                  ">
                                <g fill="none">
                                    <path
                                        d="m13 24c6.0751322 0 11-4.9248678 11-11 0-6.07513225-4.9248678-11-11-11-6.07513225 0-11 4.92486775-11 11 0 6.0751322 4.92486775 11 11 11zm8-3 9 9">
                                    </path>
                                </g>
                            </svg>
                        </div>
                    </button>
                </div>
            </div>
        </div>
        <!-- end search bar -->

        <!-- login -->
        <div class="flex-initial">
            <div class="flex justify-end items-center relative">
                <div class="flex mr-4 items-center gap-4">
                    <a class="inline-block py-2 px-4 hover:bg-gray-200 rounded-lg border border-slate-600"
                        href="../Register.php">
                        <div class="flex items-center relative cursor-pointer whitespace-nowrap">
                            Sign Up
                        </div>
                    </a>
                    <a class="inline-block py-2 px-6 bg-black rounded-lg border border-black text-white"
                        href="../login.php">
                        <div class="flex items-center relative cursor-pointer whitespace-nowrap">
                            Login
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- end login -->
    </nav>

    <!-- Sidebar -->
    <div class="flex justify-center ">
        <aside
            class="flex-col hidden md:inline w-64 h-full fixed left-0 px-5 overflow-y-auto bg-slate-100 border-r rtl:border-r-0 rtl:border-l ">
            <div class="flex flex-col justify-between flex-1 mt-6">
                <nav class="-mx-3 space-y-6">
                    <div class="space-y-3">

                        <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg  hover:bg-gray-900   hover:text-gray-100"
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>


                            <span class="mx-2 text-sm font-medium">Home</span>
                        </a>

                        <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg  hover:bg-gray-900 hover:text-gray-100"
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418" />
                            </svg>


                            <span class="mx-2 text-sm font-medium">Explore</span>
                        </a>

                        <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg  hover:bg-gray-900 hover:text-gray-100"
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>


                            <span class="mx-2 text-sm font-medium">Saved</span>
                        </a>

                        <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg  hover:bg-gray-900 hover:text-gray-100"
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                            </svg>


                            <span class="mx-2 text-sm font-medium">Cart</span>
                        </a>

                        <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg  hover:bg-gray-900   hover:text-gray-100"
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>


                            <span class="mx-2 text-sm font-medium">Profile</span>
                        </a>

                        <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg  hover:bg-gray-900   hover:text-gray-100"
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>


                            <span class="mx-2 text-sm font-medium">Purchase History</span>
                        </a>

                        <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg  hover:bg-gray-900   hover:text-gray-100"
                            href="./contact.html">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                            </svg>


                            <span class="mx-2 text-sm font-medium">Contact Us</span>
                        </a>
                    </div>
                </nav>
            </div>
        </aside>


        <!-- CONTENT -->
        <div class="flex md:pl-64 py-4">
            <form class="bg-slate-100 p-5 px-5 rounded-md border" method="post">
                <div class=" text-3xl font-medium mb-5">
                    Sign up for a trader account
                </div>
                <div class="grid gap-6 mb-4 md:grid-cols-2">
                    <div>
                        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 ">First name</label>
                        <input type="text" id="first_name" name="Firstname" value="<?php
                                                                        if (isset($_POST['Firstname'])) {
                                                                          echo $_POST['Firstname'];
                                                                        }
                                                                        ?>"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                            placeholder="John" required>
                    </div>
                    <div>
                        <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 ">Last name</label>
                        <input type="text" id="last_name" name="Lastname" value="<?php
                                                                      if (isset($_POST['Lastname'])) {
                                                                        echo $_POST['Lastname'];
                                                                      }
                                                                      ?>"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                            placeholder="Doe" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="sname" class="block mb-2 text-sm font-medium text-gray-900 ">Shop name</label>
                    <input type="text" id="sname" name="sname" value="<?php
                                                                      if (isset($_POST['sname'])) {
                                                                        echo $_POST['sname'];
                                                                      }
                                                                      ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Shop Name" required>
                </div>
                <div class="mb-4">
                    <label for="Shop Category" class="block mb-2 text-sm font-medium text-gray-900 ">Shop
                        Category</label>
                    <input type="text" id="scat" name="scategory" value="<?php
                                                                      if (isset($_POST['scategory'])) {
                                                                        echo $_POST['scategory'];
                                                                      }
                                                                      ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Shop Category" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email address</label>
                    <input type="email" id="email" name="email" value="<?php
                                                              if (isset($_POST['email'])) {
                                                                echo $_POST['email'];
                                                              }
                                                              ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="john.doe@company.com" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Password</label>
                    <input type="password" id="password" name="password" value="<?php
                                                                      if (isset($_POST['password'])) {
                                                                        echo $_POST['password'];
                                                                      }
                                                                      ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="•••••••••" required>
                </div>
                <div class="mb-4">
                    <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900 ">Confirm
                        password</label>
                    <input type="password" id="confirm_password" name="cpassword" value="<?php
                                                                                if (isset($_POST['cpassword'])) {
                                                                                  echo $_POST['cpassword'];
                                                                                }
                                                                                ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="•••••••••" required>
                </div>
                <div class="mb-4">
                    <label for="contact" class="block mb-2 text-sm font-medium text-gray-900 ">Contact</label>
                    <input type="text" id="contact" name="contact" value="<?php
                                                                if (isset($_POST['contact'])) {
                                                                  echo $_POST['contact'];
                                                                }
                                                                ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="+977-9876543210" required>
                </div>
                <div class="mb-4">
                    <label for="address" class="block mb-2 text-sm font-medium text-gray-900 ">Address</label>
                    <input type="text" id="address" name="address" value="<?php
                                                                if (isset($_POST['address'])) {
                                                                  echo $_POST['address'];
                                                                }
                                                                ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Kathmadu" required>
                </div>
                <div class="mb-4">
                    <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 ">Gender</label>

                    <div class="flex">
                        <div class="flex items-center mr-4">
                            <input id="inline-radio" type="radio" name="gender" value="Male" name="inline-radio-group"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 ">
                            <label for="inline-radio" class="ml-2 text-sm font-medium text-gray-900 ">Male</label>
                        </div>
                        <div class="flex items-center mr-4">
                            <input id="inline-2-radio" type="radio" name="gender" value="Female"
                                name="inline-radio-group"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 ">
                            <label for="inline-2-radio" class="ml-2 text-sm font-medium text-gray-900 ">Female</label>
                        </div>
                        <div class="flex items-center mr-4">
                            <input checked id="inline-checked-radio" type="radio" name="gender" value="Others"
                                name="inline-radio-group"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 ">
                            <label for="inline-checked-radio"
                                class="ml-2 text-sm font-medium text-gray-900 ">Others</label>
                        </div>

                    </div>

                </div>
                <div class="flex items-start mb-4">
                    <div class="flex items-center h-5">
                        <input id="remember" type="checkbox" value="" name="confirm"
                            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 "
                            required>
                    </div>
                    <label for="remember" class="ml-2 text-sm font-medium text-gray-900 ">I agree with the <a href="#"
                            class="text-blue-600 hover:underline ">terms and conditions</a>.</label>
                </div>
                <button type="submit" name="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Register</button><br>
                <?php
        if (isset($_POST['submit'])) {
          $firstname = trim($_POST['Firstname']);
          $Ffirstname = filter_var($firstname, FILTER_SANITIZE_STRING);
          $sname = trim($_POST['sname']);
          $Fsname = filter_var($sname, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
          $scategory = trim($_POST['scategory']);
          $Fscategory = filter_var($scategory, FILTER_SANITIZE_STRING);
          $address = trim($_POST['address']);
          $Faddress = filter_var($address, FILTER_SANITIZE_STRING);
          $lastname = trim($_POST['Lastname']);
          $Flastname = filter_var($lastname, FILTER_SANITIZE_STRING);
          $password = trim($_POST['password']);
          $Fpassword = filter_var($password, FILTER_SANITIZE_STRING);
          $cpassword = trim($_POST['cpassword']);
          $Fcpassword = filter_var($cpassword, FILTER_SANITIZE_STRING);
          $email = trim($_POST['email']);
          $contact = trim($_POST['contact']);
          $Femail = filter_var($email, FILTER_SANITIZE_EMAIL);
          $Vemail = filter_var($Femail, FILTER_VALIDATE_EMAIL);
          $gender = trim($_POST['gender']);

          if (!empty($Fpassword) && !empty($Fcpassword)) {
            if ($Fpassword == $Fcpassword) {
              if (isset($Ffirstname) && isset($Flastname)) {
                $Fusername = $Ffirstname . $Flastname;
                $user = $Ffirstname . ' ' . $Flastname;
                if (ctype_alpha($Fusername)) {
                  if (strlen($Fusername) >= 6) {
                    if(isset($sname)){
                        if(isset($scategory)){
                            $checkcategory="SELECT * FROM CATEGORY WHERE TYPE=:scategory";
                            $check=oci_parse($conn,$checkcategory) or die(oci_error($conn,$checkcategory));
                            oci_bind_by_name($check,":scategory",$scategory);
                            oci_execute($check);
                            if(!$check){
                                echo"The quota for the shop category is already reached.<br> Please provide have different shop category.";
                                 
                            }else{
                                
                                if (!empty($Vemail)) {
                                if (isset($_POST['confirm'])) {
                                    $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,16}$/";
                                    if (!preg_match($pattern, $Fpassword)) {
                                    echo "Weak or invalid password!<br>" .
                                        "The password must have length between 6 <br>and 16 or more and must contain a number,<br> capital letter and a special character.";
                                    } else {
                                    if (validatePhoneNumber($contact)) {
                                        $existsEmail = "SELECT * FROM USER_ONE WHERE EMAIL = :email";
                                        $resultEmail = oci_parse($conn, $existsEmail) or die(oci_error($conn, $existsEmail));
                                        oci_bind_by_name($resultEmail, ":email", $Vemail);
                                        oci_execute($resultEmail);
                                        $Emailexists = oci_fetch_array($resultEmail, OCI_ASSOC);

                                        $existsPhone = "SELECT * FROM USER_ONE WHERE CONTACT = :contact";
                                        $resultPhone = oci_parse($conn, $existsPhone) or die(oci_error($conn, $existsPhone));
                                        oci_bind_by_name($resultPhone, ":contact", $contact);
                                        oci_execute($resultPhone);
                                        $PhoneExists = oci_fetch_array($resultPhone, OCI_ASSOC);
                                        if ($PhoneExists) {
                                        echo "The user with the same contact already exists.<br> Please verify it and provide different <br>contact number.";
                                        } else {
                                        if ($Emailexists) {
                                            echo "The user with same email already exists.<br> Please verify it and provide different<br> contact email.";
                                        } else {
                                            
                                            $pass = md5($Fcpassword);
                                            $type = 'trader';
                                            $sql = "INSERT INTO TRADER_APPROVAL(FIRSTNAME,LASTNAME,SHOPNAME,SHOPCATEGORY,ADDRESS,CONTACT,TYPE,EMAIL,GENDER,PASSWORD)
                                                                VALUES(:Firstname,:Lastname,:sname,:scategory,:address,:contact,:type,:email,:gender,:password)";

                                            $query = oci_parse($conn, $sql) or die(oci_error($conn,$sql));
                                            oci_bind_by_name($query, ":Firstname", $Ffirstname);
                                            oci_bind_by_name($query, ":Lastname", $Flastname);
                                            oci_bind_by_name($query,":sname",$Fsname);
                                            oci_bind_by_name($query,":scategory",$Fscategory);
                                            oci_bind_by_name($query, ":address", $Faddress);
                                            oci_bind_by_name($query, ":contact", $contact);
                                            oci_bind_by_name($query, ":type", $type);
                                            oci_bind_by_name($query, ":email", $Vemail);
                                            oci_bind_by_name($query, ":gender", $gender);
                                            oci_bind_by_name($query, ":password", $pass);
                                            oci_execute($query);
                                            if ($query) {
                                            require_once('../PHPMailer/src/PHPMailer.php');
                                            require_once('../PHPMailer/src/SMTP.php');

                                            require '../PHPMailer/src/Exception.php';

                                            // Create a new PHPMailer instance
                                            $mail = new PHPMailer();

                                            // Set the SMTP credentials
                                            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;  // Shows all the debugged message. Enable verbose debug output
                                            $mail->isSMTP();
                                            $mail->Host = 'smtp.gmail.com'; // your SMTP host
                                            $mail->SMTPAuth = true;
                                            $mail->Username = 'akapil21@tbc.edu.np'; // your SMTP username
                                            $mail->Password = 'zmkxnuhhidezpurb'; // your SMTP password
                                            $mail->SMTPSecure = 'tls';
                                            $mail->Port = 587;

                                            $mail->SMTPOptions = [
                                                'ssl' => [
                                                'verify_peer' => false,
                                                'verify_peer_name' => false,
                                                'allow_self_signed' => true
                                                ]
                                            ];
                                            // Set the email details
                                            $mail->setFrom('akapil21@tbc.edu.np', 'Team Tribus'); // the from email and name
                                            $mail->addAddress($Vemail, $user); // the recipient email and name
                                            $mail->Subject = 'Registration Form Received';
                                            $mail->Body = 'Thank you for connecting with us, your application is under review.' . "\n" .
                                                'It can take up to 2 working days for approving your form. Please have patience till then' . "\n" .
                                                "We will contact you if for further query" . "\n" .
                                                'Regards,' . "\n" .
                                                'Team Tribus';

                                            // Send the email
                                            if (!$mail->send()) {
                                                echo 'Mailer Error: ' . $mail->ErrorInfo;
                                            } else {
                                                echo ("Registration form submitted. Please check your email.");
                                            }
                                            }
                                            oci_close($conn);                                            
                                        }
                                        }
                                    } else {
                                        echo "Invalid phone number: " . $contact;
                                    }
                                }
                                } else {
                                    echo "Please agree to term and condition<br> before proceeding.";
                                }
                            } else {
                                echo "All fields required.";
                            }
                        }
                    }else{
                        echo "The category of your shop is missing";
                }
                }else{
                    echo "The name of your shop is missing";
                }
                  } else {
                    echo "The trader name must contain<br> more than or equal to 6 alphabets";
                  }
                } else {
                  echo "Username must have alphabets only.";
                }
              } else {
                echo "All fields required.";
              }
            } else {
              echo " Confirmation password and password didn't match";
            }
          } else {
            echo "All fields required.";
          }
        }
        // Function to validate phone numbers with country code
        function validatePhoneNumber($phoneNumber)
        {
          // Phone number format: +<country code><10 digit number>
          $pattern = "/^\+(?:\d{1,3})?(\d{10})$/";
          return preg_match($pattern, $phoneNumber, $matches) && strlen($matches[1]) === 10;
        }
        ?>
            </form>
        </div>
    </div>
</body>

<!-- Footer -->
<footer class="md:ml-64 mt-auto bg-slate-100 text-center text-neutral-600  lg:text-left border-t-2">
    <div class="flex items-center justify-center border-b border-neutral-200 p-4  lg:justify-between ">
        <div class="mr-12 hidden lg:block">
            <span>Get connected with us on social networks:</span>
        </div>
        <div class="flex justify-center">
            <a href="#!" class="mr-6 text-neutral-600 ">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                </svg>
            </a>
            <a href="#!" class="mr-6 text-neutral-600 ">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                </svg>
            </a>
            <a href="#!" class="mr-6 text-neutral-600 ">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M7 11v2.4h3.97c-.16 1.029-1.2 3.02-3.97 3.02-2.39 0-4.34-1.979-4.34-4.42 0-2.44 1.95-4.42 4.34-4.42 1.36 0 2.27.58 2.79 1.08l1.9-1.83c-1.22-1.14-2.8-1.83-4.69-1.83-3.87 0-7 3.13-7 7s3.13 7 7 7c4.04 0 6.721-2.84 6.721-6.84 0-.46-.051-.81-.111-1.16h-6.61zm0 0 17 2h-3v3h-2v-3h-3v-2h3v-3h2v3h3v2z"
                        fill-rule="evenodd" clip-rule="evenodd" />
                </svg>
            </a>
            <a href="#!" class="mr-6 text-neutral-600 ">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                </svg>
            </a>
            <a href="#!" class="mr-6 text-neutral-600 ">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z" />
                </svg>
            </a>
            <a href="#!" class="text-neutral-600 ">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                </svg>
            </a>
        </div>
    </div>
    <div class="mx-6 py-6 text-center md:text-left">
        <div class="grid-1 grid gap-8 md:grid-cols-2 lg:grid-cols-4">
            <div class="">
                <h6 class="mb-4 flex items-center justify-center font-semibold uppercase md:justify-start">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="mr-3 h-4 w-4">
                        <path
                            d="M12.378 1.602a.75.75 0 00-.756 0L3 6.632l9 5.25 9-5.25-8.622-5.03zM21.75 7.93l-9 5.25v9l8.628-5.032a.75.75 0 00.372-.648V7.93zM11.25 22.18v-9l-9-5.25v8.57a.75.75 0 00.372.648l8.628 5.033z" />
                    </svg>
                    TRIBUS
                </h6>
                <p>
                    Here you can use rows and columns to organize your footer
                    content. Lorem ipsum dolor sit amet, consectetur adipisicing
                    elit.
                </p>
            </div>
            <div class="">
                <h6 class="mb-4 flex justify-center font-semibold uppercase md:justify-start">
                    Products
                </h6>
                <p class="mb-4">
                    <a href="#!" class="text-neutral-600 ">Angular</a>
                </p>
                <p class="mb-4">
                    <a href="#!" class="text-neutral-600 ">React</a>
                </p>
                <p class="mb-4">
                    <a href="#!" class="text-neutral-600 ">Vue</a>
                </p>
                <p>
                    <a href="#!" class="text-neutral-600 ">Laravel</a>
                </p>
            </div>
            <div class="">
                <h6 class="mb-4 flex justify-center font-semibold uppercase md:justify-start">
                    Useful links
                </h6>
                <p class="mb-4">
                    <a href="#!" class="text-neutral-600 ">About Us</a>
                </p>
                <p class="mb-4">
                    <a href="#!" class="text-neutral-600 ">Pricing</a>
                </p>
                <p class="mb-4">
                    <a href="#!" class="text-neutral-600 ">Community</a>
                </p>
                <p>
                    <a href="#!" class="text-neutral-600 ">Support</a>
                </p>
            </div>
            <div>
                <h6 class="mb-4 flex justify-center font-semibold uppercase md:justify-start">
                    Contact
                </h6>
                <p class="mb-4 flex items-center justify-center md:justify-start">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="mr-3 h-5 w-5">
                        <path
                            d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
                        <path
                            d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
                    </svg>
                    New York, NY 10012, US
                </p>
                <p class="mb-4 flex items-center justify-center md:justify-start">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="mr-3 h-5 w-5">
                        <path
                            d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z" />
                        <path
                            d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z" />
                    </svg>
                    info@example.com
                </p>
                <p class="mb-4 flex items-center justify-center md:justify-start">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="mr-3 h-5 w-5">
                        <path fill-rule="evenodd"
                            d="M1.5 4.5a3 3 0 013-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 01-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 006.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 011.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 01-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5z"
                            clip-rule="evenodd" />
                    </svg>
                    + 01 234 567 88
                </p>
                <p class="flex items-center justify-center md:justify-start">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="mr-3 h-5 w-5">
                        <path fill-rule="evenodd"
                            d="M7.875 1.5C6.839 1.5 6 2.34 6 3.375v2.99c-.426.053-.851.11-1.274.174-1.454.218-2.476 1.483-2.476 2.917v6.294a3 3 0 003 3h.27l-.155 1.705A1.875 1.875 0 007.232 22.5h9.536a1.875 1.875 0 001.867-2.045l-.155-1.705h.27a3 3 0 003-3V9.456c0-1.434-1.022-2.7-2.476-2.917A48.716 48.716 0 0018 6.366V3.375c0-1.036-.84-1.875-1.875-1.875h-8.25zM16.5 6.205v-2.83A.375.375 0 0016.125 3h-8.25a.375.375 0 00-.375.375v2.83a49.353 49.353 0 019 0zm-.217 8.265c.178.018.317.16.333.337l.526 5.784a.375.375 0 01-.374.409H7.232a.375.375 0 01-.374-.409l.526-5.784a.373.373 0 01.333-.337 41.741 41.741 0 018.566 0zm.967-3.97a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H18a.75.75 0 01-.75-.75V10.5zM15 9.75a.75.75 0 00-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 00.75-.75V10.5a.75.75 0 00-.75-.75H15z"
                            clip-rule="evenodd" />
                    </svg>
                    + 01 234 567 89
                </p>
            </div>
        </div>
    </div>
    <div class="bg-slate-100 p-3 text-center border-t-2">
        <span>© 2023 Copyright:</span>
        <a class="font-semibold text-neutral-600 " href="/index.html">TRIBUS</a>
    </div>
</footer>

</html>
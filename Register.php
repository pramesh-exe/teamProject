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

                <img src="./Logo/Tribus1.png" width="35">
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
                        href="./Register.php">
                        <div class="flex items-center relative cursor-pointer whitespace-nowrap">
                            Sign Up
                        </div>
                    </a>
                    <a class="inline-block py-2 px-6 bg-black rounded-lg border border-black text-white"
                        href="./Login.php">
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
                    Sign up for a free account
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
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Register</button>
                <a href="./trader/trader_register.php" class="text-sm font-medium text-blue-600 hover:underline ">
                    <p class="mt-2"> Register as a
                        trader</p>
                </a>
                <p class="text-sm font-light text-gray-500  mt-2">
                    Already have an account? <a href="./Login.php"
                        class="font-medium text-blue-600 hover:underline ">Login</a>
                </p>
                <?php
        if (isset($_POST['submit'])) {
          $firstname = trim($_POST['Firstname']);
          $Ffirstname = filter_var($firstname, FILTER_SANITIZE_STRING);
          $address = trim($_POST['address']);
          $Faddress = filter_var($address, FILTER_SANITIZE_STRING);
          $lastname = trim($_POST['Lastname']);
          $Flastname = filter_var($lastname, FILTER_SANITIZE_STRING);
          $password = trim($_POST['password']);
          $Fpassword = filter_var($password, FILTER_SANITIZE_STRING);
          $cpassword = trim($_POST['cpassword']);
          $Fcpassword = filter_var($cpassword, FILTER_SANITIZE_STRING);
          $email = trim($_POST['email']);
          $lemail = strtolower($email);
          $contact = trim($_POST['contact']);
          $Femail = filter_var($lemail, FILTER_SANITIZE_EMAIL);
          $Vemail = filter_var($Femail, FILTER_VALIDATE_EMAIL);
          $gender = trim($_POST['gender']);

          if (!empty($Fpassword) && !empty($Fcpassword)) {
            if ($Fpassword == $Fcpassword) {
              if (isset($Ffirstname) && isset($Flastname)) {
                $Fusername = $Ffirstname . $Flastname;
                $user = $Ffirstname . ' ' . $Flastname;
                if (ctype_alpha($Fusername)) {
                  if (strlen($Fusername) >= 6) {
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
                                $type = 'user';
                                $sql = "INSERT INTO USER_ONE(FIRSTNAME,LASTNAME,ADDRESS,CONTACT,TYPE,EMAIL,GENDER,PASSWORD)
                                                    VALUES(:Firstname,:Lastname,:address,:contact,:type,:email,:gender,:password)";

                                $query = oci_parse($conn, $sql) or die(oci_error($conn));
                                oci_bind_by_name($query, ":Firstname", $Ffirstname);
                                oci_bind_by_name($query, ":Lastname", $Flastname);
                                oci_bind_by_name($query, ":address", $Faddress);
                                oci_bind_by_name($query, ":contact", $contact);
                                oci_bind_by_name($query, ":type", $type);
                                oci_bind_by_name($query, ":email", $Vemail);
                                oci_bind_by_name($query, ":gender", $gender);
                                oci_bind_by_name($query, ":password", $pass);
                                oci_execute($query);
                                if ($query) {

                                  require_once('./PHPMailer/src/PHPMailer.php');
                                  require_once('./PHPMailer/src/SMTP.php');

                                  require './PHPMailer/src/Exception.php';

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
                                  $mail->Subject = 'Registration Success';
                                  $mail->Body = 'Thank you for joining with us, we will be pleased to serve you.' . "\n" .
                                    'Proceed to login.' . "\n" .
                                    'Regards,' . "\n" .
                                    'Team Tribus';

                                  // Send the email
                                  if (!$mail->send()) {
                                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                                  } else {
                                    echo ("Registered successfully.<br> Check your email for confirmation and<br> proceed to login.");
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
                  } else {
                    echo "The length of username must be<br> greater than or equal to 6 alphabets";
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
<?php
include 'footer.php';
?>

</html>
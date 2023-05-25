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
    <?php include 'header.php'; ?>
    <div class="flex justify-center md:pl-64 py-4">
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
                        <input id="inline-2-radio" type="radio" name="gender" value="Female" name="inline-radio-group"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 ">
                        <label for="inline-2-radio" class="ml-2 text-sm font-medium text-gray-900 ">Female</label>
                    </div>
                    <div class="flex items-center mr-4">
                        <input checked id="inline-checked-radio" type="radio" name="gender" value="Others"
                            name="inline-radio-group"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 ">
                        <label for="inline-checked-radio" class="ml-2 text-sm font-medium text-gray-900 ">Others</label>
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
</body>

<!-- Footer -->
<?php
include 'footer.php';
?>

</html>
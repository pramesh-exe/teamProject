<?php
include_once('connect.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
if ((empty(strtolower($_SESSION['email']))) || (empty($_SESSION['password']))) {
    header('location:./Login.php');
}
$user = strtolower($_SESSION['email']);
$pass = $_SESSION['password'];
$info = "SELECT * FROM USER_ONE WHERE EMAIL=:email AND password=:password";
$userinfo = oci_parse($conn, $info) or die(oci_error($conn, $info));
oci_bind_by_name($userinfo, ":email", $user);
oci_bind_by_name($userinfo, ":password", $pass);
oci_execute($userinfo);
$row = oci_fetch_assoc($userinfo);
    // populate HTML form fields with data from $row
$fname = $row['FIRSTNAME'];
$lname = $row['LASTNAME'];
$email = strtolower($row['EMAIL']);
$contact = $row['CONTACT'];
$address = $row['ADDRESS'];
$id=$row['USER_ID'];

if (isset($_POST['submit'])) {
    echo "$id";
    echo "$email";
    $firstname = trim($_POST['fname']);
    $Ffirstname = filter_var($firstname, FILTER_SANITIZE_STRING);
    $address = trim($_POST['address']);
    $Faddress = filter_var($address, FILTER_SANITIZE_STRING);
    $lastname = trim($_POST['lname']);
    $Flastname = filter_var($lastname, FILTER_SANITIZE_STRING);
    $contacts = trim($_POST['contact']);
    $Fusername = $Ffirstname . $Flastname;
    $user = $Ffirstname . ' ' . $Flastname;
    echo "$id";
    if (ctype_alpha($Fusername) ) {
        echo "$id";
        if (strlen($Fusername) >= 6) {
            echo "$id";
            if(!empty($Faddress) && !empty($contacts)){
                echo "$id";
                    if (validatePhoneNumber($contacts)) {
                        echo "$id";

                    // fetch the result
                        $sql = "UPDATE USER_ONE SET FIRSTNAME=:fname, LASTNAME=:lname, ADDRESS=:address, CONTACT=:contact WHERE USER_ID='$id'";

                        $query = oci_parse($conn, $sql) or die(oci_error($conn));
                        oci_bind_by_name($query, ":fname", $Ffirstname);
                        oci_bind_by_name($query, ":lname", $Flastname);
                        oci_bind_by_name($query, ":address", $Faddress);
                        oci_bind_by_name($query, ":contact", $contacts);
                        oci_execute($query);
                        if ($query) {
                            echo "$id";

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
                            $mail->addAddress($email, $user); // the recipient email and name
                            $mail->Subject = 'Update Success';
                            $mail->Body = 'Your information was successfully updated' . "\n" .
                                'Proceed to login.' . "\n" .
                                'Regards,' . "\n" .
                                'Team Tribus';

                            // Send the email
                            if (!$mail->send()) {
                                $message= 'Mailer Error: ' . $mail->ErrorInfo;
                            } else {
                                echo "$id";
                                session_destroy();
                                $message=  ("Updated successfully. Check your email<br> for confirmation and proceed to login.");
                            }
                        }else{
                            $message= ('Kapil');
                        }
                                            
                                oci_close($conn);
                            }else {
                                $message= "Invalid phone number: " . $contact;
                        } 
                   
                }else {
                    $message= "All fields required.";
                }
            
            }else {
                $message=  "The length of username must be <br>greater than or equal to 6 alphabets";
            }
            }else {
                $message="User's name must have alphabets only.";
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
    <!-- CONTENT -->
    <div class="flex justify-center md:pl-72 py-4">
        <form class="bg-slate-100 p-5 px-5 rounded-md border" method='post'>
            <div class=" text-3xl font-medium mb-5">
                Update user profile
            </div>
            <div class="grid gap-6 mb-4 md:grid-cols-2">
                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                    <input type="text" id="first_name" name="email" value="<?php
                        echo $email;
                        ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        value="<?php echo $row['FIRSTNAME']; ?>" disabled>
                </div>
                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 ">First name</label>
                    <input type="text" id="first_name" name="contact" value="<?php
                        echo $contact;
                        ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        value="<?php echo $row['FIRSTNAME']; ?>" disabled>
                </div>
                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 ">First name</label>
                    <input type="text" id="first_name" name="fname" value="<?php
                        echo $fname;
                        ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        value="<?php echo $row['FIRSTNAME']; ?>" placeholder="John" required>
                </div>
                <div>
                    <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 ">Last name</label>
                    <input type="text" id="last_name" name="lname" value="<?php
                        echo $lname;
                        ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        value="<?php echo $row['LASTNAME']; ?>" placeholder="Doe" required>
                </div>
            </div>
            <div class="grid gap-6 mb-4 md:grid-cols-2">
                <div>
                    <label for="contact" class="block mb-2 text-sm font-medium text-gray-900 ">Contact</label>
                    <input type="contact" id="contact" name="contact" value="<?php
                        echo $contact;
                        ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        value="<?php echo $row['CONTACT']; ?>" placeholder="+9779876543210" required>
                </div>
                <div>
                    <label for="address" class="block mb-2 text-sm font-medium text-gray-900 ">Address</label>
                    <input type="address" id="address" name="address" value="<?php
                        echo $address;
                        ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        value="<?php echo $row['ADDRESS']; ?>" placeholder="Kathmadu" required>
                </div>
            </div>
            <button type="submit" name="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Update</button>
            <button type='reset' value="clear">
        </form>
        <?php
                if(isset($_POST['submit'])){
                    echo "<script>alert('TRIBUS=> {$message}');</script>";
                }
            ?>
    </div>

</body>

<?php include 'footer.php'; ?>


</html>
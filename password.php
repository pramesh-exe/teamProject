<?php
include_once('connect.php');

if (isset($_POST['Rsubmit'])) {
  $email = trim($_POST['Remail']);
  $contact = trim($_POST['Rcontact']);
  $lemail = strtolower($email);
  $Femail = filter_var($lemail, FILTER_SANITIZE_EMAIL);
  $Vemail = filter_var($Femail, FILTER_VALIDATE_EMAIL);
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
      $_SESSION['contact'] = $contact;
      if ($Emailexists) {
        $_SESSION['email'] = $Vemail;
        header("location:password2.php");
      }
    }
  }
}
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
    <div class="flex justify-center md:pl-64 py-4">
        <form class="bg-slate-100 p-5 px-5 rounded-md border w-96" method="post">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <div class=" text-3xl font-medium mb-5">
                    Enter user details
                </div>
                <div class="mb-6">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email address</label>
                    <input type="email" name="Remail" id="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="example@abc.com" required>
                </div>
                <div>
                    <label for="contact" class="block mb-2 text-sm font-medium text-gray-900 ">Contact</label>
                    <input type="contact" name="Rcontact" id="contact" placeholder="+9779876543210"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                        required="">
                </div>

                <button type="submit" name="Rsubmit"
                    class="w-full text-white bg-blue-600 hover:bg-blue-900 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                    Continue</button>
            </div>
        </form>
        <?php
                if (isset($_POST['Rsubmit'])) {
                    $email = trim($_POST['Remail']);
                    $lemail = strtolower($email);
                    $contact = trim($_POST['Rcontact']);
                    $Femail = filter_var($lemail, FILTER_SANITIZE_EMAIL);
                    $Vemail = filter_var($Femail, FILTER_VALIDATE_EMAIL);
                    if (validatePhoneNumber($contact)) {
                    include_once('connect.php');
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
                        if (!$Emailexists) {
                        echo "The user with the email address do not exists. Please verify it and provide the email used to create your account.";
                        }
                    } else {
                        echo "The user with the contact do not exists." . "<br>" . "Please verify it and provide the contact number used to create your account.";
                    }
                    } else {
                    echo "The format for phone number is not valid. Please provide it with your country code.";
                    }
                }
            ?>
    </div>


</body>

<!-- Footer -->
<?php
include 'footer.php';
?>

</html>
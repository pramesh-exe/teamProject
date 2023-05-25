<?php
include_once('connect.php');
if (empty(strtolower($_SESSION['email'])) || empty($_SESSION['contact'])) {
  header('location:./Login.php');
}
?>
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

<body class="mt-4 flex flex-col min-h-screen">
    <!-- component -->
    <?php include 'header.php'; ?>

    <!-- Sidebar -->
    <div class="flex justify-center ">

        <!-- CONTENT -->
        <div class="flex md:pl-64 py-4">
            <form class="bg-slate-100 p-5 px-5 rounded-md border w-96" method="post">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <div class=" text-3xl font-medium mb-5">
                        Enter new Password
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Password</label>
                        <input type="password" id="password" name="password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                            placeholder="•••••••••" required>
                    </div>
                    <div class="mb-4">
                        <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900 ">Confirm
                            password</label>
                        <input type="password" id="confirm_password" name="cpassword"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                            placeholder="•••••••••" required>
                    </div>

                    <button type="submit" name="Psubmit"
                        class="w-full text-white bg-blue-600 hover:bg-blue-900 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Continue</button>
                </div>
            </form>
            <?php
                if (isset($_POST['Psubmit'])) {
                    include_once('connect.php');
                    $password = trim($_POST['password']);
                    $Fpassword = filter_var($password, FILTER_SANITIZE_STRING);
                    $cpassword = trim($_POST['cpassword']);
                    $Fcpassword = filter_var($cpassword, FILTER_SANITIZE_STRING);
                    $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,16}$/";
                    if ($Fpassword == $Fcpassword) {
                    if (!preg_match($pattern, $Fpassword)) {
                        echo "Weak or invalid password!<br>" .
                        "The password must have length between 6 and 16 or more and must contain a number, capital letter and a special character.";
                    } else {
                        if (strtolower(($_SESSION['email'])) && ($_SESSION['contact'])) {
                        $pass = md5($Fpassword);
                        $sql = "UPDATE USER_ONE SET PASSWORD = :password where email=:email AND contact=:contact";
                        $update = oci_parse($conn, $sql) or die(oci_error($conn, $sql));
                        oci_bind_by_name($update, ":password", $pass);
                        oci_bind_by_name($update, ":email", $email);
                        oci_bind_by_name($update, ":contact", $contact);
                        oci_execute($update);
                        if ($update) {
                            session_destroy();
                            echo "Password resetted successfully. Please proceed to login.";
                        }
                        }
                    }
                    } else {
                    echo "The two password didn't match. Please provide matching passwords.";
                    }
                }
            ?>

        </div>
    </div>
</body>

<!-- Footer -->
<?php
include 'footer.php';
?>

</html>
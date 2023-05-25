<?php
if (isset($_POST['submit'])) {
  include_once("connect.php");
  $password = md5($_POST['password']);
  $pas =strtolower($_POST['password']);
  $admin = strtolower("ADMIN");
  $email = trim($_POST['email']);
  $lemail = strtolower($email);
  $Femail = filter_var($lemail, FILTER_SANITIZE_EMAIL);
  $Vemail = filter_var($Femail, FILTER_VALIDATE_EMAIL);
  if (($lemail == $admin) &&($pas == $admin)) {
      $_SESSION['ADMIN'] = "admin";
      header('location:./admin/admin_dashboard.php');   
  }else{
    $type="user";
    $sql = "SELECT * FROM USER_ONE WHERE email = :email AND password = :password AND type= :type";
    $result = oci_parse($conn, $sql) or die(oci_error($conn, $sql));

    oci_bind_by_name($result, ":email", $Vemail);
    oci_bind_by_name($result, ":password", $password);
    oci_bind_by_name($result, ":type", $type);
    oci_execute($result);
    $user = oci_fetch_array($result, OCI_ASSOC);
    
    if ($user) {
        $_SESSION['id']=$user['USER_ID'];
        $_SESSION['user'] = "user";
        $_SESSION['email'] = $Vemail;
        $_SESSION['password'] = $password;
      header('location:./landing.php');
      exit();
    } else {
      $_SESSION['error'] = 'Invalid login credentials!<br>Provide your valid email and password.';
    }
  }
  oci_close($conn);
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
    <div class="flex justify-center md:pl-64 py-4">
        <div class="bg-slate-100 p-5 px-5 rounded-md border">
            <form class="p-6 space-y-4 md:space-y-6 sm:p-8" method="post">
                <div class=" text-3xl font-medium mb-5">
                    Login into your account
                </div>
                <div class="mb-6">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email address</label>
                    <input type="text" name="email" id="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="john.doe@company.com" required>
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                        required="">
                </div>
                <div class="flex items-center justify-between">
                    <a href="./trader/trader_login.php"
                        class="text-sm font-medium text-blue-600 hover:underline ">Trader
                        Login?</a>
                    <a href="./password.php" class="text-sm font-medium text-blue-600 hover:underline ">Forgot
                        password?</a>
                </div>
                <button type="submit" name="submit"
                    class="w-full text-white bg-blue-600 hover:bg-blue-900 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Sign
                    in</button>
                <p class="text-sm font-light text-gray-500 ">
                    Don't have an account yet? <a href="./Register.php"
                        class="font-medium text-blue-600 hover:underline ">Sign up</a>
                </p>
            </form>
        </div>
        <?php
                // Output the error message if it exists
                if (isset($_SESSION['error'])) {
                echo "<br><strong>" . $_SESSION['error'] . "</strong>";
                unset($_SESSION['error']); // Clear the error message from the session
                }
                ?>
    </div>

</body>

<!-- Footer -->
<?php
include 'footer.php';
?>

</html>
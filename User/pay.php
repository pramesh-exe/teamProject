<?php
include_once('connect.php');
if ((empty(strtolower($_SESSION['email']))) || (empty($_SESSION['id']))) {
    header('location:../Login.php');
}
if(isset($_SESSION['AMOUNT'])){
  $billAmount = $_SESSION['AMOUNT'];
}else{
  header('location:./cart.php');
}

// Output the bill amount as JavaScript variable
echo '<script>';
echo 'var billAmount = ' . $billAmount . ';';
echo '</script>';
?>

<!-- HTML content -->
<!DOCTYPE html>
<html>
<head>
  <title>PayPal Payment</title>
</head>
<body>
  <!-- PayPal payment button container -->
  <div id="paypal-payment-button"></div>

  <!-- Include the PayPal JavaScript SDK -->
<script src="https://www.paypal.com/sdk/js?client-id=ATClx8zyecvgRHDKtgs_ihWO4evHjsbhKndT8jGq47x4HJWre5yc9krapjFQHIrDA4nAUbruAVjhZDC4&currency=GBP&disable-funding=credit,card"></script>

  <script>
    // PayPal button configuration
    paypal.Buttons({
      style: {
        color: 'blue',
        shape: 'pill'
      },
      createOrder: function(data, actions) {
        return actions.order.create({
          purchase_units: [{
            amount: {
                currency_code: 'GBP',
              value: billAmount
            }
          }]
        });
      },
      onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
          console.log(details);
          window.location.replace("http://localhost/github/teamProject/user/success.php");
        });
      },
      onCancel: function(data) {
        window.location.replace("http://localhost/github/teamProject/user/Oncancel.php");
      }
    }).render('#paypal-payment-button');
  </script>
</body>
</html>
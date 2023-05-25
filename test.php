<?php
// Retrieve the bill amount from your PHP logic
$billAmount = 10.00; // Replace with your actual bill amount
?>

<!-- Your HTML content -->

<form id="amount-form">
  <!-- Hidden input field to send the amount to JavaScript -->
  <input type="text" name="amount" value="<?php echo $billAmount; ?>">

  <!-- Submit button to trigger the JavaScript code -->
  <button type="submit" id="pay-button">Pay</button>
</form>

<!-- Include the PayPal JavaScript SDK and index.js -->
<script src="https://www.paypal.com/sdk/js?client-id=ATClx8zyecvgRHDKtgs_ihWO4evHjsbhKndT8jGq47x4HJWre5yc9krapjFQHIrDA4nAUbruAVjhZDC4&disable-funding=credit,card"></script>
<script src="index.js"></script>
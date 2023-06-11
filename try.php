<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once('../PHPMailer/src/PHPMailer.php');
require_once('../PHPMailer/src/SMTP.php');
require '../PHPMailer/src/Exception.php';

include_once('./connect.php');

if ((empty(strtolower($_SESSION['email']))) || (empty($_SESSION['id']))) {
    header('location:../Login.php');
}

if ((empty(strtolower($_SESSION['items']))) || (empty($_SESSION['total']))) {
    header('location:../Login.php');
}
    $items=$_SESSION['items'];
    $total=$_SESSION['total'];
$query = "SELECT c.NUMBER_OF_ITEMS, p.PRODUCT_ID, p.NAME, PRICE, p.PRODUCTIMAGE
    FROM cart c
    JOIN cart_product cp ON c.cart_id = cp.fk1_cart_id
    JOIN product p ON cp.fk2_product_id = p.product_id";
$stid = oci_parse($conn, $query);
oci_execute($stid);
$sn = 1;

$uid = $_SESSION['id'];
$sql = oci_parse($conn, "SELECT * FROM USER_ONE WHERE USER_ID='$uid'");
oci_execute($sql);
$row = oci_fetch_array($sql, OCI_ASSOC);
$Vemail = $row['EMAIL'];
$user = $row['FIRSTNAME'] . ' ' . $row['LASTNAME'];

$mail = new PHPMailer();

// Set the SMTP credentials
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

$tableData = '';
while ($row = oci_fetch_array($stid)) {
    $totali=$row['PRICE']*$row['NUMBER_OF_ITEMS'];
    $tableData .= "<tr class='text-center border-b'>";
    $tableData .= "<td>$sn</td>";
    $tableData .= "<td>{$row['NAME']}</td>";
    $tableData .= "<td>&pound;{$row['PRICE']}</td>";
    $tableData .= "<td>{$row['NUMBER_OF_ITEMS']}</td>";
    $tableData .= "<td>&pound;{$totali}</td>";
    $tableData .= "</tr>";
    $sn++;
}

$mail = new PHPMailer();

// Set the SMTP credentials
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

// Enable HTML rendering
$mail->isHTML(true);

$mail->Body = "Dear $user,<br><br> Thank you for buying products from us. Please save the invoice sent below.<br><br>";
$mail->Body .= "<table style='border-collapse: collapse; width: 100%;' border='1'>";
$mail->Body .= "<thead style='text-align: center; background-color: #f8f8f8;'>";
$mail->Body .= "<tr>";
$mail->Body .= "<th scope='col' style='padding: 6px;'>sn</th>";
$mail->Body .= "<th scope='col' style='padding: 6px;'>Name</th>";
$mail->Body .= "<th scope='col' style='padding: 6px;'>unit Price</th>";
$mail->Body .= "<th scope='col' style='padding: 6px;'>Quantity</th>";
$mail->Body .= "<th scope='col' style='padding: 6px;'>Price</th>";
$mail->Body .= "</tr>";
$mail->Body .= "</thead>";
$mail->Body .= "<tbody>";
$mail->Body .= $tableData;
$mail->Body .= "<tr>Total items: $items &emsp;&emsp; Total Amount: &pound;$total<tr>";
$mail->Body .= "</tbody>";
$mail->Body .= "</table>";
$mail->Body .= "<br>Team Tribus";

// Send the email
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo "<mark>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Invoice has been sent to your email account.<br>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Check your email for confirmation and collect it.</mark>";
}

?>

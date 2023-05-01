<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <form method="post" action="">
        <fieldset>
            <legend>Register</legend>
            <label for="Firstname">Firstname:</label>
            <input type="text" name="Firstname" id="Firstname" value="<?php
            if(isset($_POST['Firstname'])){
                echo $_POST['Firstname'];
            }
            ?>" placeholder="Firstname"><br><br>
            <label for="Lastname">Lastname:</label>
            <input type="text" name="Lastname" id="Lastname" value="<?php
            if(isset($_POST['Lastname'])){
                echo $_POST['Lastname'];
            }
            ?>" placeholder="Lastname"><br><br>
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php
                if(isset($_POST['email'])){
                    echo $_POST['email'];
                }
            ?>" placeholder="Email"><br><br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" value="<?php
            if(isset($_POST['password'])){
                echo $_POST['password'];
            }
            ?>" placeholder="Password"><br><br>
            <label for="COnfirm password">Confirm Password:</label>
            <input type="password" name="cpassword" id="cpassword" value="<?php
            if(isset($_POST['cpassword'])){
                echo $_POST['cpassword'];
            }
            ?>" placeholder="Confirm Password"><br><br>
             <label for="address">Address:</label>
            <input type="text" name="address" id="address" value="<?php
            if(isset($_POST['address'])){
                echo $_POST['address'];
            }
            ?>" placeholder="Address"><br><br>
            <label for="contact">Contact:</label>
            <input type="text" name="contact" id="contact" value="<?php
            if(isset($_POST['contact'])){
                echo $_POST['contact'];
            }
            ?>" placeholder="Contact"><br><br>
            <label for="DOB">Date of Birth: </label>
            <select name='dd' size='1' id="DOB" >
                <?php
                for($i=1;$i<=31; $i++){
                    $selected = ($_POST['dd'] == $i) ? 'selected' : '';
                    echo "<option value='$i' $selected>$i</option>";
            
            }?>
            </select>
            <select name='mm' size='1' id="DOB">
                
                <?php
                $months=array("January","February","March","April","May","June","July","August","September","October","November","December");
                    foreach($months as $M){
                        $selected = ($_POST['mm'] == $M) ? 'selected' : '';
                        echo "<option value=\"$M\">$M</option>";
                    }
                ?>
            </select>
            <select name='yyyy' size='1' id="DOB">
            <?php
                for($i=1940;$i<=2022; $i++){
                    $selected = ($_POST['yyyy'] == $i) ? 'selected' : '';
                    echo "<option value=\"$i\">$i</option>";
            
            }?>
            </select><br><br>
            <label for="gender">Gender: </label>
            <input type="radio" name="gender" id="gender" value="Male"checked/>Male
            <input type="radio" name="gender" id="gender" value="Female">Female
            <input type="radio" name="gender" id="gender" value="Others">Others
            <br><br>
            <input type="checkbox" name="confirm" value="confirm" 
            <?php echo isset($_POST['confirm']) ? 'checked' : ''; ?>> <a href="./teamproject/termsandconditions.php">Terms And Conditions </a>
        </fieldset>
        <input type="submit" name="submit" value="Register">
        <input type="reset" value="clear">
        
    </form>
<?php
if(isset($_POST['submit'])){
    include('connect.php');
    $firstname=trim($_POST['Firstname']);
    $Ffirstname=filter_var($firstname,FILTER_SANITIZE_STRING);
    $address=trim($_POST['address']);
    $Faddress=filter_var($address,FILTER_SANITIZE_STRING);
    $lastname=trim($_POST['Lastname']);
    $Flastname=filter_var($lastname,FILTER_SANITIZE_STRING);
    $password=trim($_POST['password']);
    $Fpassword=filter_var($password,FILTER_SANITIZE_STRING);
    $cpassword=trim($_POST['cpassword']);
    $Fcpassword=filter_var($cpassword,FILTER_SANITIZE_STRING);
    $email=trim($_POST['email']);
    $contact=trim($_POST['contact']);
    $Femail=filter_var($email,FILTER_SANITIZE_EMAIL);
    $Vemail=filter_var($Femail,FILTER_VALIDATE_EMAIL);
    $gender=trim($_POST['gender']); 
    $yy =trim($_POST['yyyy']);
    $mm =trim($_POST['mm']);
    $dd =trim($_POST['dd']);
    $date=$yy.'-'.$mm.'-'.$dd;
    $dob=new DateTime($date);
    // Create a DateTime object for today's date
    $today = new DateTime('now');
    
    // Calculate the difference between the two dates
    $age = $today->diff($dob)->y;
    if(!empty($Fpassword) && !empty($Fcpassword)){
        if($Fpassword == $Fcpassword){
            if(isset($Ffirstname)&&isset($Flastname)){
                $Fusername=$Ffirstname.$Flastname;
                if(ctype_alpha($Fusername)){
                    if(strlen($Fusername)>=6){
                        if(!empty($Vemail)){
                                if(isset($_POST['confirm'])){
                                    $pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,16}$/";
                                    if(!preg_match($pattern,$Fpassword)){
                                        echo "Weak or invalid password!<br>".
                                        "The password must have length between 6 and 16 or more and must contain a number, capital letter and a special character.";
                                    }else{
                                        if (validatePhoneNumber($contact)) {
                                            $pass=md5($Fcpassword);
                                            $type='user';
                                            $sql="INSERT INTO USER_ONE(FIRSTNAME,LASTNAME,ADDRESS,CONTACT,TYPE,EMAIL,GENDER,PASSWORD,YYYY,MM,DD,AGE)
                                            VALUES(:Firstname,:Lastname,:address,:contact,:type,:email,:gender,:password,:yyyy,:mm,:dd,:age)";

                                            $query=oci_parse($conn,$sql) or die(oci_error($conn));
                                            oci_bind_by_name($query,":Firstname",$Ffirstname);
                                            oci_bind_by_name($query,":Lastname",$Flastname);
                                            oci_bind_by_name($query,":address",$Faddress);
                                            oci_bind_by_name($query,":contact",$contact);
                                            oci_bind_by_name($query,":type",$type);
                                            oci_bind_by_name($query,":email",$Vemail);
                                            oci_bind_by_name($query,":gender",$gender);
                                            oci_bind_by_name($query,":password",$pass);
                                            oci_bind_by_name($query,":yyyy",$yy);
                                            oci_bind_by_name($query,":mm",$mm);
                                            oci_bind_by_name($query,":dd",$dd);
                                            oci_bind_by_name($query,":age",$age);
                                            oci_execute($query);
                                            if($query){

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
                                                $mail->setFrom('akapil21@tbc.edu.np', 'Your Name'); // the from email and name
                                                $mail->addAddress('aaryalkkapil@gmail.com', 'Recipient Name'); // the recipient email and name
                                                $mail->Subject = 'Registration Success';
                                                $mail->Body = 'Thank you for joining with us, we will be pleased to be working with you.'."\n".
                                                'Proceed to login.'."\n".
                                                 'Regards,'."\n".
                                                 'Team Tribus';

                                                // Send the email
                                                if (!$mail->send()) {
                                                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                                                } else {
                                                    alert('Registration successful. Please check your email.');
                                                    include('Ulogin.php');
                                                }

                                            }

                                            oci_close($conn);

                                        } else {
                                            echo "Invalid phone number: " . $contact;
                                        }
                                    }
                                }else
                                {
                                    echo "Please agree to term and condition before proceeding.";
                                }
                        }else{
                            echo "All fields required.";
                        }
                    }else{
                        echo "The length of username must be greater than or equal to 6 alphabets";
                    }
                }else{
                    echo "Username must have alphabets only.";
                }
            }else{
                echo "All fields required.";   
            }
        }else{
            echo " Confirmation password and password didn't match";
        }    
    }else{
        echo "All fields required.";
    }
}
// Function to validate phone numbers with country code
function validatePhoneNumber($phoneNumber) {
    // Phone number format: +<country code><10 digit number>
    $pattern = "/^\+(?:\d{1,3})?(\d{10})$/";
    return preg_match($pattern, $phoneNumber, $matches) && strlen($matches[1]) === 10;
}
?>   
</body>
</html>    
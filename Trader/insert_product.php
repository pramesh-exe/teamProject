<?php
include_once('connect.php');
if(!isset($_SESSION['id']) OR !isset($_SESSION['email']) OR !isset($_SESSION['password'])){
    header('location:./trader_login.php');
}
    if(isset($_POST['addproduct']))
    {
        if(isset($_POST['Pname'])&&($_POST['description'])&&($_POST['price'])&& $_FILES["upload"]["name"])
        {
            $id=$_SESSION['id'];
            $email=$_SESSION['email'];
            $password=$_SESSION['password'];
            $Pname= trim($_POST['Pname']);
            $FPname=filter_var($Pname,FILTER_SANITIZE_STRING);
            $description=trim($_POST['description']);
            $Fdescription=filter_var($description,FILTER_SANITIZE_STRING);
            $stock=trim($_POST['stock']);
            $Fstock=filter_var($stock,FILTER_SANITIZE_NUMBER_INT);
            $Vstock=filter_var($Fstock,FILTER_VALIDATE_INT);
            $price=trim($_POST['price']);
            $sql1=oci_parse($conn,"SELECT * FROM SHOP WHERE FK1_USER_ID='$id'");
            $exe1=oci_execute($sql1);
            $sql2=oci_parse($conn,"SELECT * FROM CATEGORY WHERE FK1_USER_ID='$id'");
            $exe2=oci_execute($sql2);
            $data1=oci_fetch_assoc($sql1);
            $data2=oci_fetch_assoc($sql2);
            $sid=$data1['SHOP_ID'];
            $cid=$data2['CATEGORY_ID'];

            //capturing the image name
            if(!empty($_FILES['upload'])){
                $uimage=$_FILES["upload"]["name"];
                $usize=$_FILES['upload']['size'];
                $utype=$_FILES['upload']['type'];
                $utmpname=$_FILES['upload']['tmp_name'];
                $location="images/";
                $ulocation=$location.basename($_FILES["upload"]["name"]);
                $utype = strtolower(pathinfo($ulocation,PATHINFO_EXTENSION));
        if($utype=="jpeg" || $utype=="jpg" || $utype=="png" || $utype=="svg" || $utype=="gif")
        {
            if(isset($Pname) )
            {   
        // Giving decision
            if(move_uploaded_file($utmpname, $ulocation)){
                // SQL statement with placeholders for bind variables
                $sql ="INSERT INTO PRODUCT(NAME, PRODUCT_SIZE, DESCRIPTION, PRICE, PRODUCTIMAGE,FK1_CATEGORY_ID,FK2_SHOP_ID) 
                VALUES('$FPname', '$Vstock',  '$Fdescription', '$price', '$uimage','$cid','$sid')";
                // Prepare SQL statement for execution
                $stmt = oci_parse($conn, $sql) or die(oci_error($conn, $sql));
                $result = oci_execute($stmt);
                if($result){
                    $message="New Product added successfully";
                }
            }else{
                $message= "Unable to upload the file";
            }
            }else{
                $message= "Please fill Category Name";
            }

     }else{
        $message= "Image format should be Jpeg, png, jpg or svg only";
    }
        }else{
            $message= "Product image not found";
        }
    }else{
        $message= "All details of the product are required";
    }
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
    <?php
    include 'header.php';
    ?>
    <!-- CONTENT -->
    <div class="md:ml-64 ml:8 py-4">
        <section class="bg-slate-100 border flex-grow rounded-lg mx-8">
            <div class="py-8 lg:py-16 px-4">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 ">Upload product</h2>

                <form method="post" class="space-y-8" enctype="multipart/form-data">
                    <div>
                        <label for="pname" class="block mb-2 text-sm font-medium text-gray-900 ">Product name</label>
                        <input type="pname" id="Pname" name="Pname"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5  "
                            placeholder="Product Name" required>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 ">Product
                            Description</label>
                        <textarea id="description" name="description" rows="6"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-primary-500 focus:border-primary-500 "
                            placeholder="Leave a comment..."></textarea>
                    </div>
                    <div class="grid gap-6 mb-4 md:grid-cols-2">
                        <div>
                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 ">Avilable
                                Stock</label>
                            <input type="text" id="first_name" name="stock" value=""
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                placeholder="000" required>
                        </div>
                        <div>
                            <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 ">Price</label>
                            <input type="text" id="last_name" name="price" value=""
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                placeholder="00.00" required>
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Upload file</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none "
                            aria-describedby="file_input_help" id="file_input" type="file" name="upload">
                        <p class="mt-1 text-sm text-gray-500" id="file_input_help">SVG, PNG, JPEG or JPG.</p>
                    </div>
                    <button type="submit" name="addproduct"
                        class="py-3 px-5 text-sm font-medium text-center text-white rounded-lg bg-blue-700 sm:w-fit hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 ">Upload</button>
                    <?php
                                if(isset($_POST['addproduct']))
                                {
                                    if(isset($_POST['Pname'])&&($_POST['description'])&&($_POST['price'])&& $_FILES["upload"]["name"])
                                    {
                                        echo "<script>alert('TRIBUS=> {$message}');</script>";

                                    }
                                }
                                ?>
                </form>
            </div>
        </section>
    </div>
</body>

<!-- Footer -->
<?php
    include 'footer.php';
    ?>

</html>
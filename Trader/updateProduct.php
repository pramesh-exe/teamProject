<?php
include_once('connect.php');
if(!isset($_SESSION['id']) OR !isset($_SESSION['email']) OR !isset($_SESSION['password'])){
    header('location:./trader_login.php');
}
if(!isset($_GET['id']) && !isset($_GET['action'])){
    header('location:./trader_dashboard.php');
}
$editid=$_GET['id'];
$data=oci_parse($conn,"SELECT * FROM PRODUCT WHERE PRODUCT_ID=:pid");
oci_bind_by_name($data,":pid",$editid);
oci_execute($data);
$row=oci_fetch_array($data, OCI_ASSOC);
$des=$row['DESCRIPTION'];
$productName=$row['NAME'];
$st=$row['PRODUCT_SIZE'];
$pr=$row['PRICE'];
$pimage=$row['PRODUCTIMAGE'];
?>
<?php
  if(isset($_POST['updateproduct']))
  {
    $id=$_SESSION['id'];
    $email=$_SESSION['email'];
    $password=$_SESSION['password'];
    if(!empty($_FILES['upload'])){
        $uimage=$_FILES["upload"]["name"];
        $usize=$_FILES['upload']['size'];
        $utype=$_FILES['upload']['type'];
        $utmpname=$_FILES['upload']['tmp_name'];
        $location="images/";
        $ulocation=$location.basename($_FILES["upload"]["name"]);
        $utype = strtolower(pathinfo($ulocation,PATHINFO_EXTENSION));

      if(isset($_POST['Pname'])&&isset($_POST['description'])&&isset($_POST['price']) &&isset($_POST['stock'])&& isset($_FILES["upload"]["name"]))
      {
          
          $Pname= trim($_POST['Pname']);
          $FPname=filter_var($Pname,FILTER_SANITIZE_STRING);
          $description=trim($_POST['description']);
          $Fdescription=filter_var($description,FILTER_SANITIZE_STRING);
          $stock=trim($_POST['stock']);
          $Fstock=filter_var($stock,FILTER_SANITIZE_NUMBER_INT);
          $Vstock=filter_var($Fstock,FILTER_VALIDATE_INT);
          $price=trim($_POST['price']);
          
      if($utype=="jpeg" || $utype=="jpg" || $utype=="png" || $utype=="svg" || $utype=="gif")
      {
          if(isset($Pname) )
          {   
      // Giving decision
          if(move_uploaded_file($utmpname, $ulocation)){
              // SQL statement with placeholders for bind variables
              $sql ="UPDATE PRODUCT SET NAME='$FPname', PRODUCT_SIZE='$Fstock', DESCRIPTION='$Fdescription', PRICE='$price', PRODUCTIMAGE='$uimage' where PRODUCT_ID='$editid'";
              // Prepare SQL statement for execution
              $stmt = oci_parse($conn, $sql) or die(oci_error($conn, $sql));
              $result = oci_execute($stmt);
              if($result){
                  $message="Product updated successfully";
              }
          }else{
              $message= "Unable to upload the image";
          }
          }else{
              $message= "Please fill Category Name";
          }

   }else{
      $message= "Image format should be Jpeg, png, jpg or svg only.";
  }
      }else{
          $message= "Product image not found.";
      }
  }else{
      $message= "All details of the product are required";
  }
  if(isset($_POST['Pname'])&&isset($_POST['price']) &&isset($_POST['stock'])){

    $Pname= trim($_POST['Pname']);
          $FPname=filter_var($Pname,FILTER_SANITIZE_STRING);
          $stock=trim($_POST['stock']);
          $Fstock=filter_var($stock,FILTER_SANITIZE_NUMBER_INT);
          $Vstock=filter_var($Fstock,FILTER_VALIDATE_INT);
          $price=trim($_POST['price']);
          if(isset($Pname))
          {   
              // SQL statement with placeholders for bind variables
              $sql ="UPDATE PRODUCT SET NAME='$FPname', PRODUCT_SIZE='$Fstock', PRICE='$price' where PRODUCT_ID='$editid'";
              // Prepare SQL statement for execution
              $stmt = oci_parse($conn, $sql) or die(oci_error($conn, $sql));
              $result = oci_execute($stmt);
              if($result){
                  $message="Product updated successfully";
              }
              if(isset($_POST['description'])){
                $description=trim($_POST['description']);
                $Fdescription=filter_var($description,FILTER_SANITIZE_STRING);
                // SQL statement with placeholders for bind variables
                $sql ="UPDATE PRODUCT SET NAME='$FPname', PRODUCT_SIZE='$Fstock',DESCRIPTION='$Fdescription', PRICE='$price' where PRODUCT_ID='$editid'";
              // Prepare SQL statement for execution
                $stmt = oci_parse($conn, $sql) or die(oci_error($conn, $sql));
                $result = oci_execute($stmt);
                if($result){
                    $message="Product updated successfully";
                }
              }
          }else{
              $message= "Please fill Category Name";
          }
  }else{
    $message= "All other details of the product are required<br> even if you don't want to change your image.";
    }
}

                       if(isset($_POST['updateproduct'])) {
                        $_SESSION['update']= "<script>alert('TRIBUS=> {$message}');</script>";
                        header('location:trader_products.php');
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
    <div class="md:ml-64 ml:8 py-4">
        <section class="bg-slate-100 border flex-grow rounded-lg mx-8">
            <div class="py-8 lg:py-16 px-4">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 ">Update product</h2>

                <form method="post" class="space-y-8" enctype="multipart/form-data">
                    <div>
                        <label for="pname" class="block mb-2 text-sm font-medium text-gray-900 ">Product name</label>
                        <input type="pname" id="Pname" name="Pname" value="<?php
                        echo $productName
                        ?>" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5  "
                            placeholder="Product Name" required>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 ">Product
                            Description</label>
                        <textarea id="description" name="description" rows="6"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-primary-500 focus:border-primary-500 "
                            placeholder="<?php
                        if(isset($row['DESCRIPTION'])){
                            echo $row['DESCRIPTION'];
                        }
                        ?>"></textarea>
                    </div>
                    <div class="grid gap-6 mb-4 md:grid-cols-2">
                        <div>
                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 ">Avilable
                                Stock</label>
                            <input type="text" id="first_name" name="stock" value="<?php
                        echo $st;
                        ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                placeholder="000" required>
                        </div>
                        <div>
                            <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 ">Price</label>
                            <input type="text" id="last_name" name="price" value="<?php
                       echo  $pr;
                        ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                placeholder="00.00" required>
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Upload file</label>
                        <?php
                        echo $_SESSION['image'].' width= "150px">';
                        ?>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none "
                            aria-describedby="file_input_help" id="file_input" type="file" name="upload">
                        <p class="mt-1 text-sm text-gray-500" id="file_input_help">SVG, JPEG, PNG or JPG.</p>
                    </div>
                    <button type="submit" name="updateproduct"
                        class="py-3 px-5 text-sm font-medium text-center text-white rounded-lg bg-blue-700 sm:w-fit hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 ">Upload</button>

                </form>
            </div>
        </section>
    </div>
</body>

<!-- Footer -->
<?php include './footer.php'; ?>

</html>
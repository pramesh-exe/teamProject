<?php
include 'connect.php';
if ((empty(strtolower($_SESSION['email']))) || (empty($_SESSION['id']))) {
    header('location:../Login.php');
}
// if($_SESSION['message']){
//     $message=$_SESSION['message'];
//     echo "<script>alert('TRIBUS=> {$message}');</script>";
//     unset($message);
// }
$user=$_SESSION['email'];
$pass=$_SESSION['password'];
$uid=$_SESSION['id'];

$id=$_GET['id'];
$_SESSION['pid']=$id;

    $query = "SELECT * FROM PRODUCT WHERE PRODUCT_ID=$id";
                
    $stid = oci_parse($conn, $query);
    oci_execute($stid);
                
    $row = oci_fetch_array($stid, OCI_ASSOC);
                
    $image=$row['PRODUCTIMAGE'];
    $pname=$row['NAME'];
    if(isset($row['DESCRIPTION'])){
        $desc=$row['DESCRIPTION'];
    }
    $stock=$row['PRODUCT_SIZE'];
    $price=$row['PRICE'];
    $shop=$row['FK2_SHOP_ID'];
                
    $query2 = "SELECT * FROM ( SELECT * FROM PRODUCT WHERE FK2_SHOP_ID=$shop ORDER BY dbms_random.value ) WHERE rownum <= 6";
    $stid2 = oci_parse($conn, $query2);
    oci_execute($stid2);
    
    $rating = 0;
    $number = 0;

    $query3 = "SELECT * FROM REVIEW WHERE FK2_PRODUCT_ID= '$id'";
    $stid3 = oci_parse($conn, $query3);
    oci_execute($stid3);
    while ($row = oci_fetch_array($stid3)) {
        $rating = $rating + $row['RATING'];
        $number++;
    }
    if ($number!=0) {
        $rating = $rating/$number;
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
    <?php
        include 'header.php';
    ?>

    <!-- CONTENT -->
    <div class="bg-slate-200 flex flex-col lg:flex-row max-w-full md:ml-64 pl-4 pt-4 gap-x-8 gap-y-4">
        <div>
            <div class="max-w-6xl grid gap-8 md:grid-cols-1 lg:grid-cols-2 p-2 bg-white rounded-lg">
                <div class="p-2">
                    <?php          
                        echo'<img class="rounded" src="../images/'.$image.'"
                        alt="product image" />
                        </a>';
                    ?>
                </div>
                <div class="flex flex-col p-2 justify-between">
                    <div class="">
                        <span class="text-4xl font-sans font-bold">
                            <?php 
                        echo $pname;
                        ?>
                        </span>
                        <p class="text-3xl font-sans font-semibold">
                            $<?php 
                        echo $price;
                        ?>
                        </p>
                    </div>
                    <div>

                        <div class="flex items-center">
                            <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <title>Rating star</title>
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <p class="ml-2 text-sm font-bold text-gray-900 "><?php echo $rating?></p>
                            <span class="w-1 h-1 mx-1.5 bg-gray-500 rounded-full "></span>
                            <div class="text-sm font-medium text-gray-900 underline">
                                <?php echo $number?>
                                review(s)</div>
                        </div>
                        <div class="font-serif text-sm mt-4 text-justify font-light">
                            <?php    
                                    echo $desc;
                                ?>
                        </div>
                    </div>
                    <div class="text-3xl font-sans font-semibold mt-4">
                        In stock: <?php 
                        echo $stock;
                        ?>
                    </div>
                    <div class="text-sm font-medium my-4">
                        <a href="./addToCart.php?id=<?php echo $id?>&action=add"
                            class="bg-blue-600 py-2 px-4 rounded-lg text-white hover:bg-blue-900">Add
                            to
                            cart</a>
                        <a href="./addtowishlist.php"
                            class="bg-blue-600 py-2 px-4 rounded-lg text-white hover:bg-blue-900">Add
                            to
                            wishlist</a>

                    </div>
                </div>
            </div>
            <div class="mt-8 p-4 rounded-md">
                <div class="mb-4">
                    <span class="pt-8 text-3xl font-sans font-semibold ">Add a review</span>
                </div>

                <div class="border-b border-gray-400">
                    <form>
                        <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 m-2">
                            <div class=" bg-white rounded-t-lg ">
                                <textarea id="comment" rows="4"
                                    class="w-full px-0 text-sm text-gray-900 bg-white border-0 focus:ring-0 focus:border-transparent rounded-t-lg"
                                    placeholder=" Leave a review..." required></textarea>
                            </div>
                            <div class="flex items-center px-3 py-2 border-t justify-end">
                                <button type="submit"
                                    class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 hover:bg-blue-800">
                                    Post comment
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mt-8 p-4 rounded-md">
                <div class="pb-8 ">
                    <span class="border-b-2 text-3xl font-sans font-semibold border-black"><?php echo $number?>
                        Reviews</span>
                </div>
                <div class=" border-gray-400">
                    <?php
                    $query4 = "SELECT * FROM REVIEW WHERE FK2_PRODUCT_ID= '$id'";
                    $stid4 = oci_parse($conn, $query4);
                    oci_execute($stid4);
                    while ($row = oci_fetch_array($stid4)) {
                        $uid = $row['FK1_USER_ID'];
                        $query5 = "SELECT * FROM USER_ONE WHERE USER_ID = '$uid'";
                        $stid5 = oci_parse($conn, $query5);
                        oci_execute($stid5);
                        $table = oci_fetch_assoc($stid5);
                        $fname = $table['FIRSTNAME'];
                        $lname = $table['LASTNAME'];
                        echo '<div class ="m-2 mb-4  border-b border-gray-700 rounded-xl shadow-md">';
                        echo '<div class ="flex gap-6 items-center p-5 bg-slate-100 border-t rounded-t-xl"><div class="text-2xl font-sans font-medium">'.$fname.' '.$lname.'</div>
                            <div>|</div>
                            <div class = "flex items-end"><svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Rating star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <p class="ml-2 text-sm font-bold text-gray-900">'.$row['RATING'].'</p></div></div>';
                        if (isset($row['COMMENTS'])) {
                            echo '<div class="font-light text-black p-5 bg-white border-t rounded-b-xl">'.$row['COMMENTS'].'</div></div>';
                        }
                        else {
                            echo '<div class="text-sm font-light text-gray-700 p-5 bg-white border-t rounded-b-xl">No review provided.</div></div>';
                        }
                    }
                ?>
                </div>
            </div>
        </div>
        <div class="bg-slate-100 p-6 rounded-md flex-col min-w-[256px]">
            <div class="px-4 pb-4">
                <span class="text-2xl font-sans font-semibold m-4">
                    More from the same seller
                </span>

            </div>
            <div class="grid gap-y-8 grid-cols-2 lg:grid-cols-1 ">
                <?php
                        while ($row2 = oci_fetch_array($stid2))
                        echo'<a href="product.php?id='.$row2['PRODUCT_ID'].'"><div class=" rounded-lg overflow-hidden shadow-md hover:scale-105">
                        <div class="w-full h-40 overflow-hidden">
                            
                                <img class="w-full h-40 object-cover" src="../images/'.$row2['PRODUCTIMAGE'].'"
                                    alt="product image" />
                            
                        </div>
                        <div class="p-4 flex flex-col gap-2 bg-gray-100">
                            <div class="font-medium">'.$row2['NAME'].'</div>
                        </div>
                    </div></a>';
                    ?>


            </div>

        </div>
    </div>

</body>

<!-- Footer -->
<?php
        include 'footer.php';
    ?>

</html>
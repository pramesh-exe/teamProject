<?php
include_once 'connect.php';


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

    <span class="md:ml-64 mb-4 pl-6 pt-8 text-3xl font-sans font-bold">Products</span>

    <div class="flex:col md:ml-72 ml-6 mb-8 pt-2 gap-2 ">
        <div>
            <form action="" method="post">
                <label for="Sort">Sort by:</label>
                <select id="sort" name="sort"
                    class="inline bg-gray-50 border border-gray-300 text-gray-900 text-sm mr-2 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 ">
                    <option value="1"
                        <?php if (isset($_POST['submit'])) {if ($_POST['sort'] == 1) {echo 'selected';}}?>>Name
                        Ascending</option>
                    <option value="2"
                        <?php if (isset($_POST['submit'])) {if ($_POST['sort'] == 2) {echo 'selected';}}?>>Name
                        Descending</option>
                    <option value="3"
                        <?php if (isset($_POST['submit'])) {if ($_POST['sort'] == 3) {echo 'selected';}}?>>Price
                        Lowest</option>
                    <option value="4"
                        <?php if (isset($_POST['submit'])) {if ($_POST['sort'] == 4) {echo 'selected';}}?>>Price
                        Highest</option>
                </select>
                <label for="Sort">Shop:</label>
                <select id="shop" name="shop"
                    class="inline bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 ">
                    <option value="6"
                        <?php if (isset($_POST['submit'])) {if ($_POST['shop'] == '6') {echo ' selected';}}?>>
                        All</option>
                    <option value="1"
                        <?php if (isset($_POST['submit'])) {if ($_POST['shop'] == '1') {echo ' selected';}}?>>
                        Greengrocer</option>
                    <option value="2"
                        <?php if (isset($_POST['submit'])) {if ($_POST['shop'] == '2') {echo ' selected';}}?>>Fishmonger
                    </option>
                    <option value="3"
                        <?php if (isset($_POST['submit'])) {if ($_POST['shop'] == '3') {echo ' selected';}}?>>
                        Delicatessen</option>
                    <option value="4"
                        <?php if (isset($_POST['submit'])) {if ($_POST['shop'] == '4') {echo ' selected';}}?>>Butchers
                    </option>
                    <option value="5"
                        <?php if (isset($_POST['submit'])) {if ($_POST['shop'] == '5') {echo ' selected';}}?>>Bakery
                    </option>
                </select>
                <?php if(isset($_POST['search'])){
                    $name=$_POST['search'];
                    echo '<input type="hidden" name="search" value="'.$name.'">';
                }?>
                <button type="submit" name="submit"
                    class="text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200  font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Filter</button>
                <button type="submit" name="reset"
                    class="text-white bg-gradient-to-r from-red-800 to-pink-600 hover:bg-gradient-to-l hover:from-teal-200 hover:to-lime-200 focus:ring-4 focus:outline-none focus:ring-lime-200  font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Reset
                    Filters</button>
            </form>

        </div>
        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <?php
                
                if(empty($_POST['search']) || $search == ''){
                    if (isset($_POST['shop'])) {
                        if ($_POST['shop']==1) {
                            if (isset($_POST['sort'])) {
                                if ($_POST['sort']==1) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '1' ORDER BY NAME ASC";
                                }elseif ($_POST['sort']==2) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '1' ORDER BY NAME DESC";
                                }elseif ($_POST['sort']==3) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '1' ORDER BY PRICE ASC";
                                }elseif ($_POST['sort']==4) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '1' ORDER BY PRICE DESC";
                                }
                            }
                                else{
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '1'";
                            }
                        }elseif ($_POST['shop']==2) {
                            if (isset($_POST['sort'])) {
                                if ($_POST['sort']==1) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '2' ORDER BY NAME ASC";
                                }elseif ($_POST['sort']==2) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '2' ORDER BY NAME DESC";
                                }elseif ($_POST['sort']==3) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '2' ORDER BY PRICE ASC";
                                }elseif ($_POST['sort']==4) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '2' ORDER BY PRICE DESC";
                                }else{
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '2'";
                                }
                            }
                        }elseif ($_POST['shop']==3){
                            if (isset($_POST['sort'])) {
                                if ($_POST['sort']==1) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '3' ORDER BY NAME ASC";
                                }elseif ($_POST['sort']==2) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '3' ORDER BY NAME DESC";
                                }elseif ($_POST['sort']==3) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '3' ORDER BY PRICE ASC";
                                }elseif ($_POST['sort']==4) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '3' ORDER BY PRICE DESC";
                                }else{
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '3'";
                                }
                            }
                        }elseif ($_POST['shop']==4){
                            if (isset($_POST['sort'])) {
                                if ($_POST['sort']==1) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '4' ORDER BY NAME ASC";
                                }elseif ($_POST['sort']==2) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '4' ORDER BY NAME DESC";
                                }elseif ($_POST['sort']==3) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '4' ORDER BY PRICE ASC";
                                }elseif ($_POST['sort']==4) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '4' ORDER BY PRICE DESC";
                                }else{
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '4'";
                                }
                            }
                        }elseif ($_POST['shop']==5){
                            if (isset($_POST['sort'])) {
                                if ($_POST['sort']==1) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '5' ORDER BY NAME ASC";
                                }elseif ($_POST['sort']==2) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '5' ORDER BY NAME DESC";
                                }elseif ($_POST['sort']==3) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '5' ORDER BY PRICE ASC";
                                }elseif ($_POST['sort']==4) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '5' ORDER BY PRICE DESC";
                                }else{
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '5'";
                                }
                            }
                        }elseif ($_POST['shop']==6){
                            if (isset($_POST['sort'])) {
                                if ($_POST['sort']==1) {
                                    $query = "SELECT * FROM PRODUCT ORDER BY NAME ASC";
                                }elseif ($_POST['sort']==2) {
                                    $query = "SELECT * FROM PRODUCT ORDER BY NAME DESC";
                                }elseif ($_POST['sort']==3) {
                                    $query = "SELECT * FROM PRODUCT ORDER BY PRICE ASC";
                                }elseif ($_POST['sort']==4) {
                                    $query = "SELECT * FROM PRODUCT ORDER BY PRICE DESC";
                                }else{
                                    $query = "SELECT * FROM PRODUCT";
                                }
                            }
                        }
                    }
                    
                    elseif (isset($_POST['sort'])) {
                            if ($_POST['sort']==1) {
                                $query = "SELECT * FROM PRODUCT ORDER BY NAME ASC";
                            }elseif ($_POST['sort']==2) {
                                $query = "SELECT * FROM PRODUCT ORDER BY NAME DESC";
                            }elseif ($_POST['sort']==3) {
                                $query = "SELECT * FROM PRODUCT ORDER BY PRICE ASC";
                            }elseif ($_POST['sort']==4) {
                                $query = "SELECT * FROM PRODUCT ORDER BY PRICE DESC";
                            }
                        }
                    else
                    {
                        $query = "SELECT * FROM PRODUCT";
                    }
                }
                if(isset($_POST['search']) && $_POST['search'] != '') {
                    if (isset($_POST['shop'])) {
                        if ($_POST['shop']==1) {
                            if (isset($_POST['sort'])) {
                                if ($_POST['sort']==1) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '1' AND WHERE LOWER(NAME) LIKE '%' || '$name' || '%' ORDER BY NAME ASC";
                                }elseif ($_POST['sort']==2) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '1' AND WHERE LOWER(NAME) LIKE '%' || '$name' || '%' ORDER BY NAME DESC";
                                }elseif ($_POST['sort']==3) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '1' AND WHERE LOWER(NAME) LIKE '%' || '$name' || '%' ORDER BY PRICE ASC";
                                }elseif ($_POST['sort']==4) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '1' AND WHERE LOWER(NAME) LIKE '%' || '$name' || '%' ORDER BY PRICE DESC";
                                }else{
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '1' AND WHERE LOWER(NAME) LIKE '%' || '$name' || '%'";
                                }
                            }
                        }elseif ($_POST['shop']==2) {
                            if (isset($_POST['sort'])) {
                                if ($_POST['sort']==1) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '2' AND WHERE LOWER(NAME) LIKE '%' || '$name' || '%' ORDER BY NAME ASC";
                                }elseif ($_POST['sort']==2) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '2' AND WHERE LOWER(NAME) LIKE '%' || '$name' || '%' ORDER BY NAME DESC";
                                }elseif ($_POST['sort']==3) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '2' AND WHERE LOWER(NAME) LIKE '%' || '$name' || '%' ORDER BY PRICE ASC";
                                }elseif ($_POST['sort']==4) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '2' AND WHERE LOWER(NAME) LIKE '%' || '$name' || '%' ORDER BY PRICE DESC";
                                }else{
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '2' AND WHERE LOWER(NAME) LIKE '%' || '$name' || '%'";
                                }
                            }
                        }elseif ($_POST['shop']==3){
                            if (isset($_POST['sort'])) {
                                if ($_POST['sort']==1) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '3' AND WHERE LOWER(NAME) LIKE '%' || '$name' || '%' ORDER BY NAME ASC";
                                }elseif ($_POST['sort']==2) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '3' AND WHERE LOWER(NAME) LIKE '%' || '$name' || '%' ORDER BY NAME DESC";
                                }elseif ($_POST['sort']==3) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '3' AND WHERE LOWER(NAME) LIKE '%' || '$name' || '%' ORDER BY PRICE ASC";
                                }elseif ($_POST['sort']==4) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '3' AND WHERE LOWER(NAME) LIKE '%' || '$name' || '%' ORDER BY PRICE DESC";
                                }else{
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '3' AND WHERE LOWER(NAME) LIKE '%' || '$name' || '%'";
                                }
                            }
                        }elseif ($_POST['shop']==4){
                            if (isset($_POST['sort'])) {
                                if ($_POST['sort']==1) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '4' AND WHERE LOWER(NAME) LIKE '%' || '$name' || '%' ORDER BY NAME ASC";
                                }elseif ($_POST['sort']==2) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '4' AND WHERE LOWER(NAME) LIKE '%' || '$name' || '%' ORDER BY NAME DESC";
                                }elseif ($_POST['sort']==3) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '4' AND WHERE LOWER(NAME) LIKE '%' || '$name' || '%' ORDER BY PRICE ASC";
                                }elseif ($_POST['sort']==4) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '4' AND WHERE LOWER(NAME) LIKE '%' || '$name' || '%' ORDER BY PRICE DESC";
                                }else{
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '4' AND WHERE LOWER(NAME) LIKE '%' || '$name' || '%'";
                                }
                            }
                        }elseif ($_POST['shop']==5){
                            if (isset($_POST['sort'])) {
                                if ($_POST['sort']==1) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '5' AND WHERE LOWER(NAME) LIKE '%' || '$name' || '%' ORDER BY NAME ASC";
                                }elseif ($_POST['sort']==2) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '5' AND WHERE LOWER(NAME) LIKE '%' || '$name' || '%' ORDER BY NAME DESC";
                                }elseif ($_POST['sort']==3) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '5' AND WHERE LOWER(NAME) LIKE '%' || '$name' || '%' ORDER BY PRICE ASC";
                                }elseif ($_POST['sort']==4) {
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '5' AND WHERE LOWER(NAME) LIKE '%' || '$name' || '%' ORDER BY PRICE DESC";
                                }else{
                                    $query = "SELECT * FROM PRODUCT WHERE FK2_SHOP_ID = '5' AND WHERE LOWER(NAME) LIKE '%' || '$name' || '%'";
                                }
                            }
                        }
                    }
                    
                    elseif (isset($_POST['sort'])) {
                            if ($_POST['sort']==1) {
                                $query = "SELECT * FROM PRODUCT WHERE LOWER(NAME) LIKE '%' || '$name' || '%' ORDER BY NAME ASC";
                            }elseif ($_POST['sort']==2) {
                                $query = "SELECT * FROM PRODUCT WHERE LOWER(NAME) LIKE '%' || '$name' || '%' ORDER BY NAME DESC";
                            }elseif ($_POST['sort']==3) {
                                $query = "SELECT * FROM PRODUCT WHERE LOWER(NAME) LIKE '%' || '$name' || '%' ORDER BY PRICE ASC";
                            }elseif ($_POST['sort']==4) {
                                $query = "SELECT * FROM PRODUCt WHERE LOWER(NAME) LIKE '%' || '$name' || '%' ORDER BY PRICE DESC";
                            }
                        }
                    else{
                        $query = "SELECT * FROM PRODUCT WHERE LOWER(NAME) LIKE '%' || '$name' || '%'";
                    }
                } 
                if(isset($_POST['reset'])){
                    $query = "SELECT * FROM PRODUCT";
                }
            $statement=oci_parse($conn,$query);
            oci_execute($statement);  
            echo'<table class=" w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            image
                        </th>
                        <th scope="col" class="px-6 py-3">
                            product name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            description
                        </th>
                        <th scope="col" class="px-6 py-3">
                            action
                        </th>
                    </tr>
                </thead>';
                while($row=oci_fetch_array($statement,OCI_ASSOC)){
                    $id=$row['PRODUCT_ID'];
                    echo"<tr class='bg-white border-b hover:bg-gray-50'>";
                    echo'<td class="w-48 p-2"><img src="../images/'.$row['PRODUCTIMAGE'].'"alt="product image" /></td>';
                    echo"<td class='px-6 py-4 font-medium text-gray-900 whitespace-nowrap'>".$row['NAME']."</td>";
                    echo"<td class='px-6 py-4'>$".$row['PRICE']."</td>";
                    echo"<td class='px-6 py-4'>".$row['DESCRIPTION']."</td>";
                    echo'<td><a href="./addToCart.php?id='.$id.'&action=add" class="mr-2 text-blue-500 hover:underline">Add to cart</a> ';
                    
                }
            echo "</table>";
        ?>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>

<!-- Footer -->
<?php
include('footer.php');
?>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="../assets/img/logo_web.jpg"/>
    <title>WABSI MIA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel ='stylesheet' href="../assets/css/CSS_allPage.css">
    <link rel="stylesheet" href="../assets/css/CSS_product.css">
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/products.js"></script>
    <style>
    </style>
</head>
<body>
    <?php
        require_once "../Components/header.php";
    ?>
    <div id="container" style='padding-bottom:0'>
        <section>
            <div class="item_section">
                <h2>Loại sản phẩm</h2>
                <ul class="choose_typeProduct">
                <?php
                    if(!isset($_GET['typeProduct'])){
                        echo "<li class='item_typeProduct'><input id='product_destiny'name='radio-type' type='radio'>Phong thủy</li>";
                        echo "<li class='item_typeProduct'><input id='product_fashion'name='radio-type' type='radio'>Thời trang</li>";
                    }
                    else{
                        if($_GET['typeProduct'] == "fashion"){
                            echo "<li class='item_typeProduct'><input id='product_destiny'name='radio-type' type='radio'>Phong thủy</li>";
                            echo "<li class='item_typeProduct'><input id='product_fashion' checkedname='radio-type' type='radio'>Thời trang</li>"; 
                        }
                        else{
                            echo "<li class='item_typeProduct'><input id='product_destiny' checkedname='radio-type' type='radio'>Phong thủy</li>";
                            echo "<li class='item_typeProduct'><input id='product_fashion'name='radio-type' type='radio'>Thời trang</li>";
                        }
                    }
                    if(isset($userName) && $userName != "Admin"){
                        echo "<li class='item_typeProduct'><input  type='radio' id='product_collect'>Bộ sưu tập</li>";
                    }
                ?>
                </ul>
            </div>
            <div class="item_section">
                <h2>Dòng sản phẩm</h2>
                <ul class="choose_typeProduct">
                    <li class="item_typeProduct"><input type="radio" name="dong_sp">Cao cấp</li>
                    <li class="item_typeProduct"><input type="radio" name="dong_sp">Trung cấp</li>
                    <li class="item_typeProduct"><input type="radio" name="dong_sp">Phổ thông</li>
                </ul>
            </div>
            <div class="item_section">
                <h2>Giá sản phẩm</h2>
                <div class="rangePrice">
                    <div class="choose_rangePrice col-12">
                        <span>10,000</span>   
                        <input type="range" id="input_rangePrice" min="10000" max="200000">
                        <span>200,000</span>
                    </div>
                    <p class="show_rangePrice">Giá : 0 VND &rarr; <span class='rangeShow_max'></span> VNĐ</p>
                </div>
            </div>
            <div class="item_section">
                <h2>Bản mệnh phù hợp</h2>
                <select name="" class="select_year">
                    <option value="null">-- Chọn năm sinh --</option>
                    <?php
                        for($i = 1980; $i <= 2021; $i++){
                            echo "<option value='{$i}'>$i</option>";
                        }
                    ?>
                </select>
            </div>
        </section>
        <aside>
            <form method='post' action='./products.php?search' class="formSearch_product col-10">
                <input type="text" class="item_formSearch input_searchProduct" name='input_searchProduct' placeholder='Nhập vào dữ liệu bạn muốn tìm kiếm...'>
                <select name="select_typeSearch" class= 'item_formSearch ' id="">
                    <option value="name">Tên sản phẩm</option>
                    <option value="gia">Giá sản phẩm</option>
                    <option value="type_destiny">Mệnh</option>
                </select>
                <input type="submit" class= 'item_formSearch submit_searchProduct' name='submit_searchProduct' value='Tìm kiếm'>
            </form>
            <?php
                echo "<div class='all_product col-12'>";
                    if(isset($_GET['numberPage'])){
                        $page_current = $_GET['numberPage'];
                        $product_start = $page_current * 6;
                        $all_product = "SELECT * FROM products  ORDER BY id DESC LIMIT 6 OFFSET $product_start";
                    }
                    else{
                        if(isset($_GET['typeProduct'])){
                            if($_GET['typeProduct'] == "destiny"){
                                $all_product = "SELECT * FROM products WHERE quantity > '0' ORDER BY id DESC LIMIT 24 ";
                            }
                            else{
                                $all_product = "SELECT * FROM products WHERE quantity > '0' ORDER BY id DESC LIMIT 24 ";
                            }
                        }
                        else if(isset($_GET['changePrice'])){
                            $getChangePrice = $_GET['changePrice'];
                            $all_product = "SELECT * FROM products WHERE quantity > '0' and  gia <= '{$getChangePrice}'  ORDER BY id DESC";
                        }
                        else if(isset($_POST['submit_searchProduct']) || isset($_GET['search'])){
                            $select_typeSearch = $_POST['select_typeSearch'];
                            $input_searchProduct = $_POST['input_searchProduct'];
                            if($select_typeSearch != "gia"){
                                $all_product = "SELECT * FROM products WHERE quantity > '0' and $select_typeSearch LIKE '%{$input_searchProduct}%' ORDER BY id DESC";
                            }
                            else{
                                $all_product = "SELECT * FROM products  WHERE quantity > '0' and $select_typeSearch <= '{$input_searchProduct}' ORDER BY id DESC";
                            }
                        }
                        else{
                            $all_product = "SELECT * FROM products WHERE quantity > '0' ORDER BY id DESC LIMIT 6 OFFSET 0";
                        }
                    }

                    $result_product = $conn->query($all_product);
                    if($result_product->num_rows>0){
                        while($rowInfo_product = $result_product->fetch_assoc()){
                            echo "<div class='item_product'>";
                                echo "<a class='details_product' href='./details.php?id={$rowInfo_product['id']}'>
                                        <img src='../assets/img/img-sp/{$rowInfo_product['image']}' class='img_product'>
                                    </a>";
                                echo "<div class='content_product'>";
                                    echo "<h3 class='name_product'>{$rowInfo_product['name']}</h3>";
                                    echo "<div class='content_detailsProduct'>";
                                        echo "<a class='details_product' href='./details.php?id={$rowInfo_product['id']}}'>Xem chi tiết</a>";
                                        echo "<p class='price_product'>Giá: <b>{$rowInfo_product['price']}đ</b></p>";
                                    echo "</div>";
                                echo "</div>";
                                echo "<img src= '../assets/img/img-destiny/{$rowInfo_product['type_destiny']}.png' alt = '{$rowInfo_product['type_destiny']}' class='destiny_product' title='Mệnh {$rowInfo_product['type_destiny']}'>";
                            echo "</div>";
                        }
                    }
                    else{
                        echo "<h3>Không có sản phẩm nào</h3>";
                    }               
                echo "</div>";
                
                if(!isset($_GET['changePrice']) && !isset($_GET['search'])){
                    if(isset($_GET['numberPage'])){
                        $page_current = $_GET['numberPage'];
                    }
                    else{
                        $page_current = 0;
                    }
                    echo "<div class='numberPage'>";
                        for($i = 0; $i <4; $i++){
                            $number = $i +1;
                            if($i == $page_current){
                                echo "<a href='./products.php?numberPage=$i'><p class='item_numberPage active_numberPage'>{$number}</p></a>";                                    
                            }
                            else{
                                echo "<a href='./products.php?numberPage=$i'><p class='item_numberPage'>{$number}</p></a>";
                            }
                        }
                    echo "</div>";
                }
            ?>
        </aside>
    </div>

    <?php
        if(isset($_GET['changePrice'])){
            $range_price = $_GET['changePrice'];
            echo "<script>
                var priceVND = '{$range_price}';
                var rangePrice_inner = formatCash(priceVND.toString());
                document.querySelector('.rangeShow_max').innerHTML = rangePrice_inner ;
            </script>";
        }
        if(isset($userName) && $userName !="Admin"){
            echo "<script>";
                echo "    document.querySelector('#product_collect').onclick = function(){
                    window.location.href = '../ProfileManager/index.php?id_active=4';
                }";
            echo "</script>";
        }
        require_once "../Components/footer.php";
        require_once "../Components/form.php";
    ?>
</body>
</html>

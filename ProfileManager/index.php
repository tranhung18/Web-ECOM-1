<?php
    require '/XAMPP ver8/htdocs/WABSI-MIA/connect.php';
    session_start();
    if(isset($_SESSION['user'])){
        $userName =  $_SESSION['user'];
        $sql_getInfoPage = "SELECT * FROM users WHERE name = '$userName'";
        $result_getInfoPage = $conn->query($sql_getInfoPage);
        if($result_getInfoPage->num_rows>0){
            $row_getInfoPage = $result_getInfoPage->fetch_assoc();
            $pass_userPage = $row_getInfoPage['password'];
            $ID_userPage = $row_getInfoPage['id'];
            echo "<script>var passUser = '{$pass_userPage}';</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/png" href="../assets/img/img_all/logo_web.jpg"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel ='stylesheet' href="../assets/css/CSS_allPage.css">
    <link rel="stylesheet" href="../assets/css/manage_css.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/admin.js"></script>
    <title>Information</title>
    <style>
       .name_collect{
            width: 90%;
            margin: 20px auto 0;
            font-size: 1.85rem;
            color: white;
            background: #dd8b52;
            padding: 10px;
            border-radius: 5px;
       }
       .numberPage{
            width: 60%;
            margin: 10px auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .item_numberPage{
            margin-right: 20px;
            background-color: orange;
            color:white;
            padding: 8px 15px;
            border: 1px solid #d68f60;
            border-radius: 6px;
            font-size: 1.8rem;
        }
        .item_numberPage.active_numberPage{
            color: black;
            background-color: white;
            border-color: orange;
        }

        .infoProduct-content p {
            line-height: 2.8rem;
        }
    </style>
</head>
<body>

    <script>
        document.addEventListener('DOMContentLoaded',function(){
            const sections = document.querySelectorAll('.item_section');
            const asides = document.querySelectorAll('.item_aside');
            sections.forEach((item,index) => {
                const aside_item = asides[index];
                item.onclick = function(){
                    document.querySelector('.item_aside.menu-active').classList.remove('menu-active');
                    document.querySelector('.item_section.menu-active').classList.remove('menu-active');

                    this.classList.add('menu-active');
                    aside_item.classList.add('menu-active');
                }
            });
            <?php
                if(isset($_GET['id_active'])){
                    $id_active = $_GET['id_active'];
                    echo "document.querySelector('.item_aside.menu-active').classList.remove('menu-active');";
                    echo "document.querySelector('.item_section.menu-active').classList.remove('menu-active');";

                    echo "const aside_item = asides[{$id_active}];";
                    echo "const section_item = sections[{$id_active}];";

                    echo "section_item.classList.add('menu-active');";
                    echo "aside_item.classList.add('menu-active');";
                }
            ?>
        });
    </script>
    <?php
        if(isset($userName) && $userName == "Admin"){
            ?>
            <script>
                document.addEventListener('DOMContentLoaded', function(){
                    var formSearch = document.querySelector('#formSearch');
                    var inputSearch = document.querySelector('#inputSearch_blogWeb');
                    formSearch.onsubmit = function (e) {
                        if(inputSearch.value.length === 0){
                            alert('Bạn hãy nhập gì đó rồi mới tìm kiếm ');
                            e.preventDefault();
                        }
                    }
                });
            </script>
            <?php
        }
    ?>
    
    <div id='body_info'>
        <section>
            <div class='menu_section'>
                <div class='item_menu item_section menu-active'>
                    <i class='fas fa-user'></i>
                    <button>Thông tin tài khoản</button>
                </div>
                <div class='item_menu item_section'>
                    <i class='fas fa-shield-alt'></i>
                    <button>Bảo mật</button>
                </div>
                <?php
                    if(isset($userName) && $userName == "Admin"){
                        echo "<div class='item_menu item_section'>";
                            echo "<i class='fas fa-users'></i>";
                            echo "<button>Quản lí tài khoản</button>";
                        echo "</div>";
                        echo "<div class='item_menu item_section'>";
                            echo "<i class='fas fa-store'></i>";
                            echo "<button>Sản phẩm</button>";
                        echo "</div>";
                        echo "<div class='item_menu item_section'>";
                            echo "<i class='fas fa-blog'></i>";
                            echo "<button>Blog Website</button>";
                        echo "</div>";
                        echo "<div class='item_menu item_section'>";
                            echo "<i class='fas fa-shipping-fast'></i>";
                            echo "<button>Giao hàng</button>";
                        echo "</div>";
                    }
                    else{
                        ?>
                            <div class='item_menu item_section'>
                                <i class='fas fa-shopping-cart'></i>
                                <button>Giỏ hàng</button>
                            </div>
                        <?php
                    }
                ?>
                <div class='item_menu backTo_pageHome'>
                    <i class='fas fa-home'></i>
                    <button>Trở về trang chủ</button>
                </div>
                <form action="../index.php" class='item_menu' method='post'>
                    <i class='fas fa-sign-out-alt'></i>
                    <button name='submit_logout'>Đăng xuất</button>
                </form>
            </div>
        </section>
        <aside>
            <div class="item_aside content_info menu-active">
                <h1 class="title_content">Thông tin cá nhân</h1>
                <div class='show_allInfoAcc col-11'>
                    <?php
                        $select_info = "SELECT * FROM users WHERE name = '$userName'";
                        $result_info = $conn->query($select_info);
                        if($result_info->num_rows>0){
                            $row_info = $result_info->fetch_assoc();
                            echo "<div class='img_info'>
                                    <img class='avatar_user' src='../assets/img/img-avatar/{$row_info['avatar']}' alt=''>
                                </div>";
                            echo "<form action='./index.php' class='form_infoAccount' method='post'>
                                    <table  class='table_info'>";
                                    echo "<input type='text' class='input_none' name='getInfo_userID' value='{$row_info['id']}'>";
                                        echo "<tr>";
                                            echo "<td><b>ID: </b></td>";
                                            echo "<td>109845385{$row_info['id']}</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                            echo "<td><b>Tên tài khoản: </b></td>";
                                            echo "<td>{$row_info['name']}</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                            echo "<td><b>Giới tính: </b></td>";
                                            echo "<td>{$row_info['gender']}</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                            echo "<td><b>Số điện thoại: </b></td>";
                                            echo "<td>{$row_info['number_mobile']}</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                            echo "<td><b>Địa chỉ: </b></td>";
                                            echo "<td>{$row_info['address']}</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                            echo "<td><b>Cập nhật lần cuối: </b></td>";
                                            echo "<td>{$row_info['created_at']}</td>";
                                        echo "</tr>";
                                    echo "</table>";
                                echo "<input type='submit' class='submit_form' name='submit_updateAccount' value='Cập nhật tài khoản'>";
                            echo "</form>";
                        }else{
                            echo "<h1>Bạn chưa đăng nhập</h1>";
                        }
                    ?>
                </div>
            </div>
            <div class="item_aside content_security">
                <h1 class='title_content'>Đổi mật khẩu</h1>
                <form action="" class='form_changePass' style="width: 50%;" method='post'>
                    <input type="text" class='input_none' name='ID_userChangePass' value='<?php echo $ID_userPage; ?>'>
                    <input type="password"  class='input-pass-old' required placeholder='Nhập mật khẩu hiện tại'>
                    <span class='span-check-pass'></span>
                    <input type="password"  class='input-pass-news' name='pass_news' required placeholder='Tạo mật khẩu mới'>
                    <span class='span-pass-news'></span>
                    <progress max="100" value="0" class="meter"></progress>
                    <input type="password" class='input-repass-news'  required placeholder='Nhập lại mật khẩu mới'>
                    <span class='span-repass-news'></span>
                    <input type="submit" class='btn_changePass' name='submit_changePassword' value='Đổi mật khẩu'>
                </form>
            </div>
            <?php
                if(isset($userName) && $userName == "Admin"){
                    echo "<div class='item_aside content_account'>";
                        echo "<form action='./index.php?id_active=2' class='formSearch' method='post'>";
                            echo "<input type='text' required class='input_textSearch' name='input_searchAccount' placeholder='Tìm kiếm tài khoản'>";
                            echo "<select name='select_typeSearch'>";
                                echo "<option value='ID'>ID</option>";
                                echo "<option value='name'>Tên</option>";
                                echo "<option value='number_mobile'>Số điện thoại</option>";
                                echo "<option value='address'>Địa chỉ</option>";
                            echo "</select>";
                            echo "<input type='submit' class='submit_form' name='submit_searchAccount' value='Tìm kiếm'>";
                        echo "</form>";
                        if(isset($_GET['numberPage_Account'])){
                            $page_current = $_GET['numberPage_Account'];
                            $account_start = $page_current * 4;
                            $allInfo_user = "SELECT * FROM users WHERE name != 'Admin' LIMIT 4 OFFSET $account_start";
                        }
                        else if(isset($_POST['submit_searchAccount'])){
                            echo "<form action='./index.php?id_active=2' class='form_addOrShow' method='post'>'";
                                echo "<input type='submit' class = 'submit_form' name='submit_showAllProduct' value='Hiển thị tất cả các tài khoản'>";
                            echo "</form>";
                            $select_typeSearch = $_POST['select_typeSearch'];
                            $data_search = $_POST['input_searchAccount'];
                            if($select_typeSearch == "ID"){
                                echo "<h1 style='line-height: 20px;' class='title_content'>Thông tin các tài khoản có ID: $data_search </h1>";
                                $allInfo_user = "SELECT * FROM users  WHERE $select_typeSearch = '{$data_search}'";
                            }
                            else{
                                if($select_typeSearch == "name"){
                                    echo "<h1 style='line-height: 20px;' class='title_content'>Thông tin các tài khoản có tên: $data_search </h1>";
                                }
                                else if($select_typeSearch == "SDT"){
                                    echo "<h1 style='line-height: 20px;' class='title_content'>Thông tin các tài khoản có số điện thoại: $data_search </h1>";
                                }
                                else if($select_typeSearch == "address"){
                                    echo "<h1 style='line-height: 20px;' class='title_content'>Thông tin các tài khoản có địa chỉ: $data_search </h1>";
                                }
                                $allInfo_user = "SELECT * FROM users  WHERE $select_typeSearch LIKE '%{$data_search}%'";
                            }
                        }
                        else{
                            echo "<h1 class='title_content'>Thông tin tất cả các tài khoản</h1>";
                            $allInfo_user = "SELECT * FROM users WHERE name != 'Admin' LIMIT 4 OFFSET 0";
                        }
                        $resultInfo_allUser = $conn->query($allInfo_user);
                        if($resultInfo_allUser ->num_rows>0){
                            while($row_info = $resultInfo_allUser->fetch_assoc()){
                                echo "<div class='item_info Account'>";
                                    echo "<div class='infoAccount_img'>";
                                        echo "<img src='../assets/img/img-avatar/{$row_info['avatar']}'>";
                                    echo "</div>";
                                    echo "<div class='infoAccount-content'>";
                                        echo "<p><b>ID:</b> {$row_info['id']}</p>";
                                        echo "<p><b>Tên tài khoản:</b> {$row_info['name']}</p>";
                                        echo "<p><b>Giới tính:</b> {$row_info['gender']}</p>";
                                        echo "<p><b>Số điện thoại:</b> {$row_info['number_mobile']}</p>";
                                        echo "<p><b>Địa chỉ:</b> {$row_info['address']}</p>";
                                        echo "<p><b>Ngày tạo:</b> {$row_info['created_at']}</p>";
                                    echo "</div>";
                                    echo "<a href='../User/delete_user.php?id={$row_info['id']}' class='btn_UpdateDelete-item'>Xóa</a>";
                                echo "</div>";
                            }
                        }
                        else{
                            echo "<h1 class='title_content'>Không có dữ liệu tài khoản</h1>";
                        }
                        if(!isset($_POST['submit_searchAccount'])){
                            if(isset($_GET['numberPage_Account'])){
                                $page_currentAcc = $_GET['numberPage_Account'];
                            }
                            else{
                                $page_currentAcc = 0;
                            }

                            $numberPage_account = "SELECT COUNT(*) as sumAccount FROM users";
                            $sqlSum_Account = $conn->query($numberPage_account);
                            if($sqlSum_Account == TRUE){
                                $rowSum = $sqlSum_Account->fetch_assoc();
                                $sumAccount = $rowSum['sumAccount'];

                                $sumNumber_pageAccount = ceil($sumAccount / 4);
                                echo "<div class='numberPage'>";
                                    for($i = 0; $i <$sumNumber_pageAccount; $i++){
                                        $number = $i +1;
                                        if($i == $page_currentAcc){
                                            echo "<a href='./index.php?numberPage_Account=$i&id_active=2'><p class='item_numberPage active_numberPage'>{$number}</p></a>";
                                        }
                                        else{
                                            echo "<a href='./index.php?numberPage_Account=$i&id_active=2'><p class='item_numberPage'>{$number}</p></a>";
                                        }
                                    }
                                echo "</div>";
                            }
                        }
                    echo "</div>";

                    echo "<div class='item_aside content_product'>";
                        echo "<form action='./index.php?id_active=3' class='formSearch' method='post'>";
                            echo "<input type='text' class='input_textSearch'required name='input_searchProduct' placeholder='Tìm kiếm sản phẩm'>";
                            echo "<select name='select_typeSearch'>";
                                echo "<option value='id'>Mã sản phẩm</option>";
                                echo "<option value='name'>Tên sản phẩm</option>";
                                echo "<option value='price'>Giá</option>";
                                echo "<option value='quantity'>Số lượng</option>";
                                echo "<option value='type_destiny'>Mệnh</option>";
                            echo "</select>";
                            echo "<input type='submit' class='submit_form' name='submit_searchProduct' value='Tìm kiếm'>";
                        echo "</form>";
                        echo "<form action='./index.php?id_active=3' class='form_addOrShow' method='post'>'";
                            echo "<a href='index.php?id_active=3&addProduct' class='submit_form'>Thêm sản phẩm mới</a>";
                            echo "<input type='submit' class = 'submit_form' name='submit_showAllProduct' value='Hiển thị tất cả các sản phẩm'>";
                        echo "</form>";
                        if(isset($_GET['numberPage_product'])){
                            $page_current = $_GET['numberPage_product'];
                            $product_start = $page_current * 5;
                            $all_product = "SELECT * FROM products LIMIT 5 OFFSET $product_start";
                        }
                        else if(isset($_POST['submit_searchProduct'])){
                            $select_typeSearch = $_POST['select_typeSearch'];
                            $data_search = $_POST['input_searchProduct'];
                            if($select_typeSearch == "gia"){
                                echo "<h1 style='line-height: 20px;' class='title_content'>Thông tin các sản phẩm có giá <= $data_search VNĐ là </h1>";
                                $all_product = "SELECT * FROM products  WHERE $select_typeSearch <= '{$data_search}'";
                            }
                            else if($select_typeSearch == "soLuong"){
                                echo "<h1 style='line-height: 20px;' class='title_content'>Thông tin các sản phẩm có số lượng: $data_search là </h1>";
                                $all_product = "SELECT * FROM products  WHERE $select_typeSearch = '{$data_search}'";
                            }
                            else if($select_typeSearch == "id"){
                                echo "<h1 style='line-height: 20px;' class='title_content'>Thông tin các sản phẩm có mã: $data_search là </h1>";
                                $all_product = "SELECT * FROM products  WHERE $select_typeSearch = '{$data_search}'";
                            }
                            else{
                                if($select_typeSearch == "name"){
                                    echo "<h1 style='line-height: 20px;' class='title_conten t'>Thông tin các sản phẩm có tên: $data_search là </h1>";
                                }
                                else if($select_typeSearch == "type_destiny"){
                                    echo "<h1 style='line-height: 20px;' class='title_content'>Thông tin các sản phẩm có mệnh: $data_search là </h1>";
                                }
                                else {
                                    echo "<h1 style='line-height: 20px;' class='title_content'>Thông tin các sản phẩm loại $data_search là </h1>";
                                }
                                $all_product = "SELECT * FROM products  WHERE $select_typeSearch LIKE '%{$data_search}%'";
                            }
                        }
                        else{
                            $all_product = "SELECT * FROM products LIMIT 5 OFFSET 0";
                            echo "<h1 class='title_content'>Thông tin tất cả các sản phẩm</h1>";
                        }
                        $resultInfo_allProduct = $conn->query($all_product);
                        if($resultInfo_allProduct ->num_rows>0){
                            while($rowInfo_product = $resultInfo_allProduct->fetch_assoc()){
                                echo "<div class='item_info Product'>";
                                    echo "<div class='infoProduct_img'>";
                                        echo "<img src ='../assets/img/img-sp/{$rowInfo_product['image']}'>";
                                    echo "</div>";
                                    echo "<div class='infoProduct-content' style='font-size:2rem'>";
                                        echo "<p><b>ID:</b> {$rowInfo_product['id']}</p>";
                                        echo "<p><b>Tên sản phẩm:</b> {$rowInfo_product['name']}</p>";
                                        echo "<p><span style='margin-right: 5px;'><b>Số lượng:</b> {$rowInfo_product['quantity']}</span>
                                                <i class='fas fa-arrows-alt-h'></i>
                                                <span style='margin-left: 5px;'><b>Giá:</b> {$rowInfo_product['price']} VNĐ</span>
                                            </p>";
                                        echo "<p><b>Mệnh:</b> {$rowInfo_product['type_destiny']}</p>";
                                    echo "</div>";
                                    echo "<div class='btn_UpdateDelete'>";
                                        echo "<a href='./index.php?id={$rowInfo_product['id']}&id_active=3&update_product' class='btn_UpdateDelete-item'>Sửa</a>";
                                        echo "<a href='../Admin/Product/delete_product.php?id={$rowInfo_product['id']}' class='btn_UpdateDelete-item'>Xóa</a>";
                                    echo "</div>";
                                echo "</div>";
                            }
                        }
                        else{
                            echo "<h1 class='title_content'>Không có dữ liệu sản phẩm</h1>";
                        }
                        if(!isset($_POST['submit_searchProduct'])){
                            if(isset($_GET['numberPage_product'])){
                                $page_currentProduct = $_GET['numberPage_product'];
                            }
                            else{
                                $page_currentProduct = 0;
                            }

                            $numberPage_product = "SELECT COUNT(*) as sumProduct FROM products";
                            $sqlSum_Product = $conn->query($numberPage_product);
                            if($sqlSum_Product == TRUE){
                                $rowSum = $sqlSum_Product->fetch_assoc();
                                $sumProduct = $rowSum['sumProduct'];

                                $sumNumber_pageProduct = ceil($sumProduct / 5);
                                echo "<div class='numberPage'>";
                                    for($i = 0; $i <$sumNumber_pageProduct; $i++){
                                        $number = $i +1;
                                        if($i == $page_currentProduct){
                                            echo "<a href='./index.php?numberPage_product=$i&id_active=3'><p class='item_numberPage active_numberPage'>{$number}</p></a>";
                                        }
                                        else{
                                            echo "<a href='./index.php?numberPage_product=$i&id_active=3'><p class='item_numberPage'>{$number}</p></a>";
                                        }
                                    }
                                echo "</div>";
                            }
                        }
                    echo "</div>";

                    echo "<div class='item_aside content_blogWeb'>";
                        ?>
                            <form action="./index.php?id_active=4" method='post' id="formSearch" class="formSearch">
                                <input type="text" class="input_textSearch"  id="inputSearch_blogWeb" name="inputSearch_blogWeb" placeholder="Tìm kiếm bài viết">
                                <select name="Type_search">
                                    <option value="ID_blog">ID Blog</option>
                                    <option value="title">Tên Blog</option>
                                </select>
                                <input type="submit" class='submit_form' name="submitSearch_blogWeb" value="Tìm kiếm">
                            </form>
                            <form action="./index.php?id_active=4" method='post' class="form_addOrShow">
                                <input type="submit"  class='submit_form' name='formAdd_BlogWeb' value='Thêm blog mới'>
                                <input type="submit"  class='submit_form' name='submitShow_allBlog' value='Hiển thị tất cả các blog'>
                            </form>
                        <?php
                            echo "<div class='all_blogWeb'>";
                            if(isset($_GET['numberPage_blogWeb'])){
                                $page_current = $_GET['numberPage_blogWeb'];
                                $blogWeb_start = $page_current * 3;
                                $show_blog = "SELECT * FROM blogs LIMIT 3 OFFSET $blogWeb_start";
                                echo "<h1 class='title_allBlog'>Thông tin tất cả các blog</h1>";
                            }
                            else if(isset($_POST['submitSearch_blogWeb'])){
                                $Type_search = $_POST['Type_search'];
                                $data_search = $_POST['inputSearch_blogWeb'];
                                echo "<h1 class='title_allBlog'>Thông tin tất cả các blog tìm kiếm</h1>";
                                $show_blog = "SELECT * FROM blogs WHERE $Type_search LIKE '%{$data_search}%'" ;
                            }
                            else{
                                echo "<h1 class='title_allBlog'>Thông tin tất cả các blog</h1>";
                                $show_blog = "SELECT * FROM blogs LIMIT 3 OFFSET 0";
                            }
                            $resultInfo_Blog = $conn->query($show_blog);
                            if ($resultInfo_Blog ->num_rows > 0){
                                while ($rowInfo_blog =$resultInfo_Blog -> fetch_assoc()) {
                                    echo "<div class= 'item_infoBlog'>";
                                    echo "<div class= 'item_infoBlog-img col-5'>";
                                        echo "<img src ='../assets/img/img-blog/{$rowInfo_blog['image']}' >";
                                    echo "</div>";

                                    echo "<div class='item_infoBlog-content col-6'>";
                                        echo "<p><b>Tên Blog: </b> {$rowInfo_blog['title']} </p>";
                                        echo "<p><b>Ngày tạo: </b> {$rowInfo_blog['created_at']} </p>";
                                        echo "<p><b>Link ảnh: </b> {$rowInfo_blog['image']} </p>";
                                        echo "<p><b>Link blog: </b> {$rowInfo_blog['name_blog']} </p>";
                                    echo "</div>";

                                    echo "<div class='btn_UpdateDelete'>";
                                        echo "<a href='../Admin/Blog/update_blog.php?id_blog={$rowInfo_blog['id']}' class='btn_UpdateDelete-item'>Sửa</a></br>";
                                        echo "<a href='../Admin/Blog/delete_blog.php?id_blog={$rowInfo_blog['id']}' class='btn_UpdateDelete-item'>Xóa</a>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                                echo "</div>";
                            }
                            else{
                                echo "<script> alert('Không tìm thấy kết quả phù hợp'); </script>";
                            }
                            if(!isset($_POST['submitSearch_blogWeb'])){
                                if(isset($_GET['numberPage_blogWeb'])){
                                    $page_currentBlogWeb = $_GET['numberPage_blogWeb'];
                                }
                                else{
                                    $page_currentBlogWeb = 0;
                                }

                                $numberPage_blogWeb = "SELECT COUNT(*) as sumBlogWeb FROM blogs";
                                $sqlSum_blogWeb = $conn->query($numberPage_blogWeb);
                                if($sqlSum_blogWeb == TRUE){
                                    $rowSum = $sqlSum_blogWeb->fetch_assoc();
                                    $sumBlogWeb = $rowSum['sumBlogWeb'];

                                    $sumNumber_pageBlogWeb = ceil($sumBlogWeb / 3);
                                    echo "<div class='numberPage'>";
                                        for($i = 0; $i <$sumNumber_pageBlogWeb; $i++){
                                            $number = $i +1;
                                            if($i == $page_currentBlogWeb){
                                                echo "<a href='./index.php?numberPage_blogWeb=$i&id_active=4'><p class='item_numberPage active_numberPage'>{$number}</p></a>";
                                            }
                                            else{
                                                echo "<a href='./index.php?numberPage_blogWeb=$i&id_active=4'><p class='item_numberPage'>{$number}</p></a>";
                                            }
                                        }
                                    echo "</div>";
                                }
                            }
                    echo "</div>";

                    echo "<div class='item_aside content_ship'>";
                        echo "<form action='./index.php?id_active=5' class='formSearch' method='post'>";
                            echo "<input type='text' class='input_textSearch' required name='dataSearch' placeholder='Tìm kiếm đơn vị vận chuyển'>";
                            echo "<select name='typeSearch'>";
                                echo "<option value='id'>Mã đơn vị vận chuyển</option>";
                                echo "<option value='name'>Tên đơn vị vận chuyển</option>";
                                echo "<option value='money'>Phí vận chuyển</option>";;
                            echo "</select>";
                            echo "<input type='submit' class='submit_form' name='submit_searchTransport' value='Tìm kiếm'>";
                        echo "</form>";
                        echo "<form action='./index.php?id_active=5' class='form_addOrShow' method='post'>";
                            echo "<a href='../Admin/Transport/add_transport.php' class='submit_form'>Thêm đơn vị vận chuyển mới</a>";
                            echo "<input type='submit' class='submit_form' name='submit_showTransport' value='Hiển thị các đơn vị vận chuyển'>";
                        echo "</form>";
                        //show all transport
                        if(isset($_GET['numberPage_Transport'])){
                           $page_current = $_GET['numberPage_Transport'];
                           $transport_start = $page_current * 3;
                           $sql_infoTransport = "SELECT * FROM transports LIMIT 3 OFFSET $transport_start";
                        }
                        else if(isset($_POST['submit_searchTransport'])) {
                            $dataSearch = $_POST['dataSearch'];
                            $typeSearch = $_POST['typeSearch'];
                            if($typeSearch == 'money') {
                                echo "<h1 class='title_content'>Thông tin đơn vị vận chuyển có phí <= $dataSearch</h1>";
                                $sql_infoTransport = "SELECT * FROM transports WHERE $typeSearch <= '$dataSearch'";
                            }
                            else {
                                if($typeSearch == 'id') {
                                    echo "<h1 class='title_content'>Thông tin đơn vị vận chuyển có ID = $dataSearch</h1>";
                                }
                                else{
                                    echo "<h1 class='title_content'>Thông tin đơn vị vận chuyển có chứa kí tự: '$dataSearch'</h1>";
                                }
                                $sql_infoTransport = "SELECT * FROM transports WHERE $typeSearch LIKE '%{$dataSearch}%'";
                            }
                        }
                        else{
                            $sql_infoTransport = "SELECT * FROM transports LIMIT 3 OFFSET 0";
                            echo "<h1 class='title_content'>Thông tin các đơn vị vận chuyển</h1>";
                        }
                        $resultInfo_allTransport = $conn->query($sql_infoTransport);
                        if($resultInfo_allTransport -> num_rows > 0) {
                            while($row_infoTransport = $resultInfo_allTransport->fetch_assoc()) {
                                echo "<div class='item_infoTransport'>";
                                    echo "<div class='infoTransport-content col-8'>";
                                        echo "<p><b>Mã đơn vị vận chuyển:</b> {$row_infoTransport['id']}</p>";
                                        echo "<p><b>Tên đơn vị vận chuyển:</b> {$row_infoTransport['name']}</p>";
                                        echo "<p><b>Phí vận chuyển:</b> {$row_infoTransport['money']}</p>";
                                        echo "<p><b>Thời gian vận chuyển:</b> {$row_infoTransport['time_ship']}</p>";
                                    echo "</div>";
                                    echo "<div class='btn_UpdateDelete col-4'>";
                                    echo "<a href='../Admin/Transport/update_transport.php?id={$row_infoTransport['id']}' class='btn_UpdateDelete-item'>Sửa</a>";
                                        echo "<a href='../Admin/Transport/delete_transport.php?id={$row_infoTransport['id']}' class='btn_UpdateDelete-item'>Xóa</a>";
                                    echo "</div>";
                                echo "</div>";
                            }
                        }
                        else {
                            echo "<h1 class='title_content'>Không tìm thấy dữ liệu đơn vị vận chuyển</h1>";
                        }
                        if(!isset($_POST['submit_searchTransport'])){
                            if(isset($_GET['numberPage_Transport'])){
                                $page_currentTrans = $_GET['numberPage_Transport'];
                            }
                            else{
                                $page_currentTrans = 0;
                            }

                            $numberPage_transport = "SELECT COUNT(*) as sumTransport FROM transports";
                            $sqlSum_Transport = $conn->query($numberPage_transport);
                            if($sqlSum_Transport == TRUE){
                                $rowSum = $sqlSum_Transport->fetch_assoc();
                                $sumTransport = $rowSum['sumTransport'];

                                $sumNumber_pageTransport = ceil($sumTransport / 3);
                                echo "<div class='numberPage'>";
                                    for($i = 0; $i <$sumNumber_pageTransport; $i++){
                                        $number = $i +1;
                                        if($i == $page_currentTrans){
                                            echo "<a href='./index.php?numberPage_Transport=$i&id_active=5'><p class='item_numberPage active_numberPage'>{$number}</p></a>";
                                        }
                                        else{
                                            echo "<a href='./index.php?numberPage_Transport=$i&id_active=5'><p class='item_numberPage'>{$number}</p></a>";
                                        }
                                    }
                                echo "</div>";
                            }
                        }
                    echo "</div>";
                }
                else{
                    echo "<div class='item_aside content_cart'>";
                        echo "<form action='./index.php?id_active=2' method='post' class='formSearch'>";
                            echo "<input type='text' required class='input_textSearch' name='input_searchCart' placeholder='Tìm kiếm giỏ hàng'>";
                            echo "<select name='select_typeSearch'>";
                                echo "<option value='name'>Tên sản phẩm</option>";
                                echo "<option value='quantity'>Số lượng</option>";
                                echo "<option value='thanhTien'>Thành tiền</option>";
                                echo "<option value='trangThai'>Trạng thái</option>";
                            echo "</select>";
                            echo "<input type='submit' class='submit_form' name='submit_searchCart' value='Tìm kiếm'>";
                        echo "</form>";
                        echo "<form action='./index.php?id_active=2' class='form_addOrShow' method='post'>";
                            echo "<a href='../Home/products.php' class='submit_form'>Thêm giỏ hàng mới</a>";
                            echo "<input type='submit' class = 'submit_form' name='submit_showAllCart' value='Hiển thị tất cả các sản phẩm trong giỏ hàng'>";
                        echo "</form>";

                        if(isset($_GET['numberPage_cart'])){
                            $page_current = $_GET['numberPage_cart'];
                            $cart_start = $page_current * 4;
                            $allInfo_Cart = "SELECT *, 
                                    products.id as product_id,
                                    carts.id as cart_id,
                                    products.quantity as soLuongTon, 
                                    carts.quantity as soLuongMua
                                FROM carts, products 
                                WHERE (user_id = '$ID_userPage' AND products.id = carts.product_id) LIMIT 4 OFFSET $cart_start";
                        }
                        else if(isset($_POST['submit_searchCart'])){
                            $input_searchCart = $_POST['input_searchCart'];
                            $select_typeSearch = $_POST['select_typeSearch'];
                            if($select_typeSearch == "name"){
                                echo "<h1 class='title_content' style='font-size: 2.2rem'>Thông tin các sản phẩm trong giỏ hàng có tên $input_searchCart</h1>";
                                $allInfo_Cart = "SELECT *, 
                                        carts.id as cart_id,
                                        products.id as product_id,
                                        products.quantity as soLuongTon,
                                        carts.quantity as soLuongMua
                                    FROM carts, products 
                                    WHERE (products.{$select_typeSearch} LIKE '%{$input_searchCart}%' 
                                        AND products.id = carts.product_id) 
                                        AND carts.user_id = '{$ID_userPage}'";
                            }
                            else if($select_typeSearch == "thanhTien" || $select_typeSearch == 'quantity'){
                                if($select_typeSearch == "thanhTien"){
                                    echo "<h1 class='title_content' style='font-size: 2.2rem'>Thông tin các sản phẩm trong giỏ hàng có thành tiền = $input_searchCart</h1>";
                                }else{
                                    echo "<h1 class='title_content' style='font-size: 2.2rem'>Thông tin các sản phẩm trong giỏ hàng có số lượng = $input_searchCart</h1>";
                                }
                                $allInfo_Cart = "SELECT *,
                                        products.id as product_id
                                        carts.id as cart_id,
                                        products.quantity as soLuongTon,
                                        carts.quantity as soLuongMua
                                    FROM carts, products
                                    WHERE (carts.{$select_typeSearch} = '$input_searchCart' 
                                        AND products.id = carts.product_id) 
                                        AND carts.user_id = '{$ID_userPage}'";
                            }
                            else{
                                echo "<h1 class='title_content' style='font-size: 2.2rem'>Thông tin các sản phẩm trong giỏ hàng có trạng thái $input_searchCart</h1>";
                                $allInfo_Cart = "SELECT *,
                                        products.id as product_id
                                        carts.id as cart_id,
                                        products.quantity as soLuongTon,
                                        carts.quantity as soLuongMua
                                    FROM carts, products
                                    WHERE (carts.{$select_typeSearch} LIKE '%{$input_searchCart}%' 
                                        AND products.id = carts.product_id) 
                                        AND carts.user_id = '{$ID_userPage}' ";
                            }
                        }
                        else{
                            echo "<h1 class='title_content'>Thông tin các sản phẩm trong giỏ hàng của bạn</h1>";
                            $allInfo_Cart = "SELECT *,
                                    products.id as product_id,
                                    carts.id as cart_id,
                                    products.quantity as soLuongTon,
                                    carts.quantity as soLuongMua
                                FROM carts, products
                                WHERE carts.user_id = '$ID_userPage' 
                                    AND products.id = carts.product_id
                                LIMIT 4 OFFSET 0";
                        }
                        $resultInfo_allCart = $conn->query($allInfo_Cart);
                        if($resultInfo_allCart->num_rows>0){
                            while($rowInfoCart = $resultInfo_allCart->fetch_assoc()){
                                echo "<div class='item_info Cart'>";
                                    echo "<div class='infoCart_img'>";
                                        echo "<img src='../assets/img/img-sp/{$rowInfoCart['image']}'>";
                                    echo "</div>";
                                    echo "<form class='infoCart_content col-7' method='post'>";
                                        echo "<div class='all_infoCart'>";
                                            echo "<h3>{$rowInfoCart['name']}</h3>";
                                            echo "<p>Mã sản phẩm: <b>SP00584-sp-{$rowInfoCart['product_id']}</b></p>";
                                            echo "<p>Đơn giá: <b>{$rowInfoCart['unit_price']} VNĐ</b></p>";
                                            echo "<p>Số lượng sản phẩm: <b>{$rowInfoCart['soLuongMua']}</b></p>";
                                            echo "<p>Thành tiền: <b>{$rowInfoCart['total_price']} VNĐ</b></p>";
                                            echo "<p>Trạng thái: <b>{$rowInfoCart['status']}</b></p>";

                                            echo "<input type='text' class='input_none' name='soLuongTon' value='{$rowInfoCart['soLuongTon']}'>";
                                            echo "<input type='text' class='input_none' name='ID_gioHang' value='{$rowInfoCart['cart_id']}'>";
                                            echo "<input type='text' class='input_none' name='donGia' value='{$rowInfoCart['unit_price']}'>";
                                            echo "<input type='text' class='input_none' name='soLuongMua' value='{$rowInfoCart['soLuongMua']}'>";
                                            echo "<input type='text' class='input_none' name='thanhTien' value='{$rowInfoCart['total_price']}'>";
                                        echo "</div>";
                                        echo "<div class='all_btnCart'>";
                                            echo "<a class='btn_UpdateDelete-item' href='../User/delete_cart.php?id={$rowInfoCart['cart_id']}'>Xóa</a>";
                                            if($rowInfoCart['status'] == 'Đã thanh toán'){
                                                echo "<a class='btn_UpdateDelete-item' href='../Home/details.php?id={$rowInfoCart['product_id']}'>Mua lại</a>";
                                                echo "<a class='btn_UpdateDelete-item' href='../Home/details.php?id={$rowInfoCart['product_id']}&createFeedback'>Đánh giá</a>";
                                            }else{
                                                echo "<input class='btn_UpdateDelete-item' type='submit' name='submit_updateCart' value='Sửa'>";
                                                echo "<a class='btn_UpdateDelete-item' href='#'>Mua ngay</a>";
                                            }
                                        echo "</div>";
                                    echo "</form>";
                                echo "</div>";
                            }
                        }
                        else{
                            echo "<h1 class='title_content'>Không tìm thấy sản phẩm trong giỏ hàng</h1>";
                        }
                        if(!isset($_POST['submit_searchCart'])){
                            if(isset($_GET['numberPage_cart'])){
                                $page_currentCart = $_GET['numberPage_cart'];
                            }
                            else{
                                $page_currentCart = 0;
                            }

                            $numberPage_cart = "SELECT COUNT(*) as sumCart FROM carts WHERE user_id ='$ID_userPage'";
                            $sqlSum_Cart = $conn->query($numberPage_cart);
                            if($sqlSum_Cart == TRUE){
                                $rowSum = $sqlSum_Cart->fetch_assoc();
                                $sumCart = $rowSum['sumCart'];

                                $sumNumber_pageCart = ceil($sumCart / 4);
                                echo "<div class='numberPage'>";
                                    for($i = 0; $i <$sumNumber_pageCart; $i++){
                                        $number = $i +1;
                                        if($i == $page_currentCart){
                                            echo "<a href='./index.php?numberPage_cart=$i&id_active=2'><p class='item_numberPage active_numberPage'>{$number}</p></a>";
                                        }
                                        else{
                                            echo "<a href='./index.php?numberPage_cart=$i&id_active=2'><p class='item_numberPage'>{$number}</p></a>";
                                        }
                                    }
                                echo "</div>";
                            }
                        }
                    echo "</div>";
                }
            ?>
        </aside>
    </div>

    <?php
        // Update Account
        if(isset($_POST['submit_updateAccount'])){
            $idAccount_update = $_POST['getInfo_userID'];
            $getInfo = "SELECT * FROM users WHERE id = '$idAccount_update'";
            $result_getInfo = $conn->query($getInfo);
            if($result_getInfo -> num_rows>0){
                $row_getInfo = $result_getInfo->fetch_assoc();
                echo "<div class='form_onTop'>";
                    echo "<div class='overlay'></div>";
                    echo "<div class='layout' style='min-width:500px;box-shadow:1px 1px 8px 1px black'>";
                        echo "<h1 class='title_content'>Cập nhật tài khoản</h1>";
                        echo "<form enctype='multipart/form-data'  method='post' class='form_updateAccount'>";
                            echo "<input type='text' class='input_none' name='ID_user' value='{$row_getInfo['id']}'>";
                            echo "<p>Cập nhật tên mới</p>";
                            echo "<input type='text' required name='nameUser_news' value='{$row_getInfo['name']}'>";
                            echo "<p>Cập nhật địa chỉ mới</p>";
                            echo "<input type='text' required name='addressUser_news' value='{$row_getInfo['address']}'>";
                            echo "<p>Cập nhật ảnh đại diện mới</p>";
                            echo "<input style='display:none' type='text' name='avatarUser_old' value='{$row_getInfo['avatar']}'>";
                            echo "<input style='background-color:white' type='file' name='avatarUser_news'>";
                            echo "<input type='submit' name='submitForm_updateAccount' class='submit_form'>";
                        echo "</form>";
                        echo "<a href='./index.php'><i style='font-size: 2.1rem' class='fas fa-times icon_close'></i></a>";
                    echo "</div>";
                echo "</div>";
            }
        }
        // submit update acc
        if(isset($_POST['submitForm_updateAccount'])){
            $nameUser_news = $_POST['nameUser_news'];
            $addressUser_news = $_POST['addressUser_news'];
            $id_user = $_POST['ID_user'];

            if($_FILES['avatarUser_news']['size'] == 0 || $_FILES['avatarUser_news']['error'] > 0 ){
                $avatarUser_news = $_POST['avatarUser_old'];
            }
            else {
                $file = $_FILES['avatarUser_news'];
                $avatarUser_news = $file['name'];
                move_uploaded_file($file['tmp_name'],'../assets/img/img-avatar/'.$avatarUser_news);
            }

            $sqlUpdate_account = "UPDATE users SET name ='$nameUser_news' , address = '$addressUser_news', avatar = '$avatarUser_news' WHERE id = '$id_user'";
            $result_updateAccount  = $conn->query($sqlUpdate_account);
            if($result_updateAccount == TRUE){
                $_SESSION['avatar'] = $avatarUser_news;
                echo "<script> alert('Cập nhật tài khoản thành công'); window.location.href='./index.php'; </script>";
            }
            else{
                echo "<script> alert('Lỗi cập nhật. Vui lòng thử lại'); window.location.href='./index.php'; </script>";
            }
        }
        // Change Password
        if(isset($_POST['submit_changePassword'])){
            $ID_userChangePass = $_POST['ID_userChangePass'];
            $passNews = $_POST['pass_news'];

            $sql_changePass = "UPDATE users SET password = '$passNews' WHERE id = '$ID_userChangePass'";
            $result_changePass = $conn->query($sql_changePass);
            if($result_changePass == TRUE){
                echo "<script>alert('Thay đổi mật khẩu thành công');</script>";
            }
        }
        // Update cart
        if(isset($_POST['submit_updateCart'])){
            $ID_gioHang = $_POST['ID_gioHang'];
            $donGia = $_POST['donGia'];
            $soLuong = $_POST['soLuongMua'];
            $thanhTien = $_POST['thanhTien'];
            $soLuongTon = $_POST['soLuongTon'];

            echo "<div class='form_onTop'>";
                echo "<div class='overlay'></div>";
                echo "<div class='layout layout_updateCart'>";
                    echo "<form action='../User/update_cart.php' class='form_updateCart col-12' method='post'>";
                        echo "<h1 style='font-size: 2.3rem;'>Cập nhật số lượng</h1>";
                        echo "<input type='number' min='1' max='{$soLuongTon}' class= 'getNumber_cart' name='numberCart_news' value='{$soLuong}'>";
                        echo "<p style='font-size: 1.8rem;'>Đơn giá: <b>{$donGia} VNĐ</b></p>";
                        echo "<p style='font-size: 1.8rem;'>Thành tiền: <span style='font-weight:bold' class='show_resultPrice'>{$thanhTien} VNĐ</span></p>";
                        echo "<input type='submit' class='submit_form' name='submitForm_updateCart' value='Cập nhật'>";

                        echo "<input type='number' class='input_none' name='cart_id' value='{$ID_gioHang}'>";
                        echo "<input type='number' class='input_none getPrice' value='{$donGia}'>";
                        echo "<input type='number' class='input_none getResult_price' name='resultPrice_news' value='{$thanhTien}'>";
                    echo "</form>";
                    echo "<a href='./index.php?id_active=2'><i style='font-size: 2rem' class='fas fa-times icon_close'></i></a>";
                echo "</div>";
            echo "</div>";
            ?>
                <script>
                    document.addEventListener("DOMContentLoaded",function(){
                        var unitPrice = document.querySelector('.getPrice').value;
                        const inputNumber_cart = document.querySelector('.getNumber_cart');
                        inputNumber_cart.onchange = function(){
                            if(document.querySelector('.getNumber_cart').value == document.querySelector('.getNumber_Cart').getAttribute('max')){
                                alert('Số lượng sản phẩm còn lại đã tối đa');
                            }
                            var resultPrice = unitPrice * document.querySelector('.getNumber_cart').value;
                            document.querySelector('.show_resultPrice').innerHTML = `${resultPrice} VNĐ`;
                            document.querySelector('.getResult_price').value = resultPrice;
                        }
                    });
                </script>
            <?php
        }
        //  Add product
        if(isset($_GET['addProduct'])){
            ?>
                <div class="form_onTop">
                    <div class="overlay"></div>
                    <div class="layout layout_addProduct">
                        <h1>Thêm dữ liệu cho sản phẩm mới</h1>
                        <form enctype="multipart/form-data" action="" class='formAdd formProduct_AddorUpdate' method='post'>
                            <input type="text" required class='name_product checkName_product' name='name_Product' placeholder='Nhập tên cho sản phẩm'>
                            <input type="number" required class='price_product checkPrice_product' name='price_Product' min='1000' placeholder='Nhập giá sản phẩm'>
                            <input type="number" required class='number_product checkNumber_product' name='number_Product' min='1' placeholder='Nhập số lượng sản phẩm'>
                            <input type="text" required name='typeSone_Product' placeholder='Nhập loại đá của sản phẩm'>
                            <div class="typeProduct">
                                <p class="title_inputDestiny">Nhập loại sản phẩm</p>
                                <select name="type_Product" >
                                    <option value="Phong thủy">Phong thủy</option>
                                    <option value="Thời trang">Thời trang</option>
                                </select>
                            </div>
                            <div class="destinyProduct">
                                <p class="title_inputDestiny">Nhập mệnh sản phẩm</p>
                                <select name="destiny_Product" >
                                    <option value="Kim">Kim</option>
                                    <option value="Thủy">Thủy</option>
                                    <option value="Hỏa">Hỏa</option>
                                    <option value="Mộc">Mộc</option>
                                    <option value="Thổ">Thổ</option>
                                </select>
                            </div>
                            <input style='background-color: white' class ='img-product' type="file" required name='img_Product'>
                            <input style='width:50%' type="submit" class='btn_submitAdd addProduct btnFormProduct' name='submit_addProduct' value='Thêm sản phẩm'>
                        </form>
                        <a href='./index.php?id_active=3'><i style='font-size: 23px' class='fas fa-times icon_close'></i></a>
                    </div>
                </div>
            <?php
        }
        // Submit addProduct
        if(isset($_POST['submit_addProduct'])){
            $name_Product = $_POST['name_Product'];
            $price_Product = $_POST['price_Product'];
            $type_Product = $_POST['type_Product'];
            $number_Product = $_POST['number_Product'];
            $typeSone_Product = $_POST['typeSone_Product'];
            $destiny_Product = $_POST['destiny_Product'];

            $img_Product = $_FILES['img_Product'];
            $insert_imgProduct = $img_Product['name'];
            move_uploaded_file($img_Product['tmp_name'],'../assets/img/img-sp/'.$insert_imgProduct);

            $insert_product = "INSERT INTO `products` (`name`,`price`,`quantity`,`type_destiny`,`image`)
                        VALUES ('$name_Product', '$price_Product','$number_Product','$destiny_Product', '$insert_imgProduct')";
            $result_insert = $conn->query($insert_product);
            if($result_insert == TRUE){
                echo "<script> alert('Thêm sản phẩm thành công');
                window.location.href='./index.php?id_active=3'; </script>";
            }
            else{
                echo "<script> alert('Lỗi thêm sản phẩm, vui lòng thử lại sau'); </script>";
            }
        }
        // update product
        if(isset($_GET['update_product'])){
            $id_product = $_GET['id'];
            $getInfo_product = "SELECT * FROM products WHERE id = '$id_product'";
            $reuslt_infoProduct = $conn->query($getInfo_product);
            if($reuslt_infoProduct->num_rows>0){
                $row_infoProduct = $reuslt_infoProduct->fetch_assoc();
            ?>
                <div class="form_onTop">
                    <div class="overlay"></div>
                    <div class="layout layout_updateProduct">
                        <h1>Cập nhật sản phẩm</h1>
                        <form enctype="multipart/form-data" method='post'  class='formUpdateProduct formProduct_AddorUpdate' >
                            <div class="item_formUpdateProduct">
                                <p>Cập nhật tên sản phẩm</p>
                                <input required type="text" name='nameProduct_news' class='checkName_product' value='<?php echo $row_infoProduct['name']; ?>'>
                            </div>
                            <div class="item_formUpdateProduct">
                                <p>Cập nhật giá sản phẩm</p>
                                <input required type="number" class='checkPrice_product' name='priceProduct_news' min='1000' value='<?php echo $row_infoProduct['price']; ?>'>
                            </div>
                            <div class="item_formUpdateProduct">
                                <p>Cập nhật số lượng sản phẩm</p>
                                <input required type="number" class='checkNumber_product' name='numberProduct_news' min='1' value='<?php echo $row_infoProduct['quantity']; ?>'>
                            </div>
                            <div class="item_formUpdateProduct">
                                <p>Cập nhật mệnh</p>
                                <?php
                                    $arr_destiny = array('Kim','Thủy','Hỏa','Mộc','Thổ');
                                    echo "<select name='destinyProduct_news'>";
                                            echo "<option value='{$row_infoProduct['type_destiny']}'>{$row_infoProduct['type_destiny']}</option>";
                                            for($i = 0 ; $i< sizeof($arr_destiny) ;$i = $i+1){
                                                if($arr_destiny[$i] != $row_infoProduct['type_destiny']){
                                                    echo "<option value='$arr_destiny[$i]'>$arr_destiny[$i]</option>";
                                                }
                                            }
                                    echo "</select>";
                                ?>
                            </div>
                            <div class="item_formUpdateProduct">
                                <p>Cập nhật ảnh sản phẩm</p>
                                <input style='display:none'  type="text" name='imgProduct_old' value='<?php echo $row_infoProduct['image']; ?>'>
                                <input style='background-color:white' type="file" name='imgProduct_news' >
                            </div>
                            <input type="submit" class='submit_updateProduct btnFormProduct' name='submit_updateProduct' value='Cập nhật'>
                        </form>
                        <a href='./index.php?id_active=3'><i style='font-size: 25px' class='fas fa-times icon_close'></i></a>
                    </div>
                </div>
            <?php
            }

        }
        if(isset($_POST['submit_updateProduct'])){
            $nameProduct_news = $_POST['nameProduct_news'];
            $priceProduct_news = $_POST['priceProduct_news'];
            $numberProduct_news = $_POST['numberProduct_news'];
            $destinyProduct_news = $_POST['destinyProduct_news'];

            if($_FILES['imgProduct_news']['size'] == 0 || $_FILES['imgProduct_news']['error'] > 0 ){
                $imgProduct_news = $_POST['imgProduct_old'];
            }
            else{
                $img_Product = $_FILES['imgProduct_news'];
                $imgProduct_news = $img_Product['name'];
                move_uploaded_file($img_Product['tmp_name'],'../assets/img/img-sp/'.$imgProduct_news);
            }
            $update_product = "UPDATE `products`
                                SET `name` = '$nameProduct_news', 
                                    `price` = '$priceProduct_news',
                                    `quantity` = '$numberProduct_news',
                                    `type_destiny` = '$destinyProduct_news', 
                                    `image` = '$imgProduct_news'
                                WHERE `id` ='$id_product' ";
            $result_update = $conn->query($update_product);
            if($result_update == TRUE){
                echo "<script> alert('Cập nhật sản phẩm thành công');
                window.location.href='./index.php?id_active=3'; </script>";
            }
            else{
                echo "<script> alert('Lỗi cập nhật. Vui lòng thử lại!!'); </script>";
            }
        }
        // Blog Web
        // Form Add Blog
        if(isset($_POST['formAdd_BlogWeb'])){
            ?>
                <div class="form_onTop">
                    <div class="overlay"></div>
                    <div class="layout layout_addBlogWeb">
                        <form enctype="multipart/form-data" action="" method='post' class='formAdd_BlogWeb'>
                            <h1>Tạo blog mới</h1>
                            <p>Tiêu đề</p>
                            <input type="text" required name='titleBlog_insert' placeholder="Tạo tiêu đề cho blog">
                            <p>Link ảnh</p>
                            <input style='background-color:white' type="file" required name='linkImgBlog_insert'>
                            <p>Link blog</p>
                            <input type="text" required name='linkBlog_insert' placeholder="Nhập link cho blog">
                            <input type='submit' class='submit_addBlog' name='submitAdd_blogWeb' value='Thêm blog'>
                            <a href='./index.php?id_active=4'><i style='font-size: 23px' class='fas fa-times icon_close'></i></a>
                        </form>
                    </div>
                </div>
            <?php
        }
        // submit add blog
        if(isset($_POST['submitAdd_blogWeb'])) {
            $tieuDe = $_POST['titleBlog_insert'];
            $linkBlog = $_POST['linkBlog_insert'];

            $img_Product = $_FILES['linkImgBlog_insert'];
            $image = $img_Product['name'];
            move_uploaded_file($img_Product['tmp_name'],'../assets/img/img-blog/'.$image);

            $additional = "INSERT INTO blogs(title,image,name_blog) VALUES ('$tieuDe', '$image','$name_blog')";

            if(mysqli_query($conn, $additional)){
                    echo " <script> alert ('Thêm Blog thành công');";
                    echo "window.location.href='./index.php?id_active=4' </script>";
                }
        }
        // Script Product add or update
        if(isset($_GET['addProduct']) || isset($_GET['update_product'])){
            ?>
                <script>
                    document.addEventListener('DOMContentLoaded',function(){
                        var btn_addProduct = document.querySelector('.btnFormProduct');
                        var price_product = document.querySelector('.checkPrice_product');
                        var number_product = document.querySelector('.checkNumber_product');
                        var name_product = document.querySelector('.checkName_product');
                        function checkForm_addProduct(){
                            btn_addProduct.disabled = true;
                            price_product.onchange = function(){
                                if(price_product.value <= 1000){
                                    price_product.style.border = '1.5px solid red';
                                    alert('Giá sản phẩm phải lớn hơn 1000');
                                }
                                else{
                                    price_product.style.border = 'none';
                                }
                            }
                            name_product.onchange = function(){
                                if(name_product.value.length < 8){
                                    name_product.style.border = '1.5px solid red';
                                    alert('Tên sản phẩm phải chứa ít nhất 8 kí tự');
                                }
                                else{
                                    name_product.style.border = 'none';
                                }
                            }
                            number_product.onchange = function(){
                                if(number_product.value <= 1){
                                    number_product.style.border = '1.5px solid red';
                                    alert('Số lượng sản phẩm thêm vào phải lớn hơn 1');
                                }
                                else{
                                    number_product.style.border = 'none';
                                }
                            }
                            if(price_product.value >1000 && name_product.value.length>= 8 && number_product.value >1){
                                btn_addProduct.disabled = false;
                            }
                        }
                        document.querySelector('.formProduct_AddorUpdate').onkeyup = checkForm_addProduct;
                    });
                </script>
            <?php
        }
    ?>
    <script>
            document.querySelector('.item_menu.backTo_pageHome').onclick = function(){
                window.location.href = '../index.php';
            };
    </script>
</body>
</html>

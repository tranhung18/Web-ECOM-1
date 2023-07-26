<?php
    require '/XAMPP ver8/htdocs/WABSI-MIA/connect.php';

    if(isset($_POST['submitForm_updateCart'])){
        $id = $_POST['cart_id'];
        $quantity = $_POST['numberCart_news'];
        $total = $_POST['resultPrice_news'];
    
        $sql_update = "UPDATE carts SET `quantity` = '$quantity', `total_price` = '$total' WHERE id = '$id'";
        $result_update = $conn->query($sql_update);
        if($result_update == TRUE) {
            echo "<script> alert('Cập nhật giỏ hàng thành công'); 
                    location.href='../ProfileManager/index.php?id_active=2'; 
                </script>";
        }
        else {
            echo "Vui lòng thử lại sau";
        }
    }
?>

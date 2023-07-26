<?php
    require '/XAMPP ver8/htdocs/WABSI-MIA/connect.php';

    $ID = $_GET['id'];
    $sql_deleteCart = "DELETE FROM carts WHERE carts.id = '$ID'";

    if($conn->query($sql_deleteCart) == TRUE){
        echo "<script> alert('Xóa giỏ hàng thành công'); 
                location.href='../ProfileManager/index.php?id_active=2'
            </script>";
    }
?>

<?php
    require "/XAMPP ver8/htdocs/WABSI-MIA/connect.php";

    $id_product = $_GET['id'];
    $delete_product = "DELETE FROM products WHERE id ='$id_product'";
    $delete_cart = "DELETE FROM carts WHERE product_id = '$id_product' ";
    $delete_feedback = "DELETE FROM feedbacks WHERE product_id = '$id_product'";


    $result_deleteCart = $conn->query($delete_cart);
    if($result_deleteCart === TRUE){
        $result_feedback = $conn->query($delete_feedback);
        if($result_feedback === TRUE) {
            $result_deleteProduct = $conn->query($delete_product);
            if($result_deleteProduct === TRUE){
                echo "<script> alert('Xóa sản phẩm thành công');
                window.location.href='../../ProfileManager/index.php?id_active=3'; </script>";
            }
        }
    }
    else{
        echo "Cannot delete product here. Please try agian";
    }
?>

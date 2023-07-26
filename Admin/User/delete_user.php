<?php
    require "/XAMPP ver8/htdocs/WABSI-MIA/connect.php";

    $id_account = $_GET['id'];

    $delete_cart = "DELETE FROM carts WHERE user_id = '$id_account'"; 
    $delete_feedback = "DELETE FROM feedbacks WHERE user_id = '$id_account'";
    
    $conn->query($delete_cart);
    $conn->query($delete_feedback);

    $delete_account = "DELETE FROM users WHERE id ='$id_account'";
    if($conn->query($delete_account)){
        echo "<script> alert('Xóa tài khoản thành công');
                location.href = '../../ProfileManager/index.php?id_active=2';
        </script>";
    }
  
?>

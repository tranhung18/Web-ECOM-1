<?php
    require "/XAMPP ver8/htdocs/WABSI-MIA/connect.php";

    $get_idProduct = $_GET['id'];
    $get_typeProduct = $_GET['loai'];

    $ID_feedback = $_GET['id_fb'];
    $sql_delete = "DELETE FROM feedbacks WHERE id = '$ID_feedback'";
    $result_deleteFeedback = $conn->query($sql_delete);
    if($result_deleteFeedback == TRUE) {
        echo "<script> alert('Xóa thành công'); 
                window.location.href= '../details.php?id={$get_idProduct}&loai={$get_typeProduct}';
            </script>";
    }
    else {
        echo "Error";
    }
?>

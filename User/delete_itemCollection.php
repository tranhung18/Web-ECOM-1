<?php
    require "/XAMPP ver8/htdocs/WABSI-MIA/connect.php";

    $ID = $_GET['id'];
    $id_user = $_GET['id_user'];
    $sql_delete = "DELETE FROM bosuutap WHERE product_id = '$ID' and user_id = '$id_user'";
    $result_delete = $conn->query($sql_delete);
    if($result_delete == TRUE) {
        echo "<script>alert(`Xóa thành công`);
              window.location.href='../index.php?id_active=4';</script>";
    }
    else {
        echo "<script> alert(` Lỗi khi xóa. Vui lòng thử lại `);</script>";
    }
?>

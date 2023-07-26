<?php
    require '/XAMPP ver8/htdocs/WABSI-MIA/connect.php';

    $id = $_GET['id_blog'];
    $query = "DELETE from blogs where id='$id'";
    if(mysqli_query($conn,$query)){
        echo "<script> alert('Xóa blog thành công'); window.location.href='../../ProfileManager/index.php?id_active=4' </script>";
    }
    else{
        echo "<script> alert('Lỗi xóa blog'); </script>";
    }
?>

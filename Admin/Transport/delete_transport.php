<?php
    require "/XAMPP ver8/htdocs/WABSI-MIA/connect.php";

    $ID = $_GET['id'];
    $sql_deleteTransport = "DELETE FROM transports WHERE id = '$ID'";

    if($conn->query($sql_deleteTransport) == TRUE) {
        echo "<script>alert(`Xóa đơn vị vận chuyển thành công`);
              window.location.href='../../ProfileManager/index.php?id_active=5';</script>";
    }
    else {
        echo "<script> alert(` Lỗi khi xóa. Vui lòng thử lại `);</script>";
    }

?>

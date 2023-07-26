<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel='stylesheet' href='../../../../css/manage_accounT.css'>
    <style>
        body {
            background-color: #ffeaa7;
        }
        .layout {
            width: 30%;
            background-color: #eee;
            border-radius: 15px;
            padding: 20px;
            margin: 100px auto 0;
            border: 1px solid #ccc;
            box-shadow: 1px 1px 4px 2px #888888;
        }
        .form_add{
            display: flex;
            align-items: center;
            flex-direction: column;
        }
        input {
            width: 67%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 17px;
            text-align: center;
            margin-bottom: 15px;
        }
        .btn_submitAdd {
            width: 45%;
            border: 0.5px solid #555;
        }
        .btn_submitAdd:hover {
            background-image: linear-gradient(0,#d68f60,#e28744);
            color: white;
            box-shadow: 1px 1px 4px 2px #888888;
        }
    </style>
  </head>
  <body>
      <?php
          require "/XAMPP ver8/htdocs/WABSI-MIA/connect.php";

              echo "<div class='layout'>";
                  echo "<h3 style='font-size:1.8rem'><center>Thêm đơn vị vận chuyển mới</h3>";
                  echo "<form class='form_add' method='post' action=''>";
                      echo "<input type='text' required name='name_transport' placeholder='Nhập tên đơn vị vận chuyển'>";
                      echo "<input type='number' required name='price_transport' placeholder='Nhập phí vận chuyển'>";
                      echo "<input type='text' required name='time_transport' placeholder='Nhập thời gian vận chuyển'>";
                      echo "<input type='submit' class='btn_submitAdd' name='submitAdd' value='Thêm vận chuyển'>";
                  echo "</form>";
              echo "</div>";


          if(isset($_POST['submitAdd'])) {
              $name_transport = $_POST['name_transport'];
              $price_transport = $_POST['price_transport'];
              $time_transport = $_POST['time_transport'];

              $insert_transport = "INSERT INTO transports (name, money, time_ship) VALUES ('$name_transport', '$price_transport', '$time_transport')";
              $result_addTransport = $conn->query($insert_transport);
              if($result_addTransport == TRUE) {
                  echo "<script> alert(` Thêm thành công `);
                        window.location.href='../../ProfileManager/index.php?id_active=5';</script>";
              }
              else {
                  echo "<script> alert(` Lỗi khi thêm, vui lòng thử lại `);</script>";
              }
          }
      ?>
  </body>
</html>

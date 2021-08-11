
<?php
    session_start();
    $is_admin = false;
    if(isset($_SESSION["admin"])) {
        if($_SESSION["admin"] == md5("khanhdeptrai1")) {
            $is_admin = true;
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Danh sách đăng ký tiêm vaxin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <ul class="navbar-nav">
    <li class="nav-item active">
      <a class="nav-link" href="#">Admin</a>
    </li>
  </ul>
</nav>
<div class="container">
<?php if($is_admin) : ?>
    <h1>Danh sách đăng ký tiêm chủng</h1>
    <table style="margin-top: 20px" border="1" cellspacing="0" cellpadding="0">
            <tr style="font-style: italic">
                <td>User name</td>
                <td>Tên người đăng ký</td>
                <td>Địa chỉ</td>
                <td>Ngày hẹn</td>
                <td>Đối tượng ưu tiên</td>
            </tr>
            <style>
                td {
                    padding: 20px;
                }
            </style>
            <?php
            $conn = new mysqli("localhost", "root", "", "kiemtra1");
            $sql = "SELECT * FROM vaxin_register v join user u on v.user_name = u.user_name join personal_type p on v.personal_type_id = p.personal_type_id ";
            $query=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_array($query)){
                ?>
                <tr>
                    <td><?php echo $row['user_name']; ?></td>
                    <td><?php echo $row['full_name']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['appointment_date']; ?></td>
                    <td><?php echo $row['personal_type_name']; ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    <?php else : ?>
        <h1>Bạn không có quyền truy cập</h1>
    <?php endif; ?>

</div>

</body>
</html>



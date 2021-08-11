
<?php
    session_start();
    $is_login = false;
    if(isset($_SESSION["login_status"])) {
        if($_SESSION["login_status"] == md5("khanhdeptrai")) {
            $is_login = true;
        }
    }

    include_once (__DIR__.'../connect.php');
    $query=mysqli_query($conn,"select * from `personal_type`");
    $rows = mysqli_fetch_all($query);

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Đăng ký tiêm chủng vaxin</title>
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
      <a class="nav-link" href="#">Home</a>
    </li>
    <?php if($is_login) : ?>
        <li class="nav-item">
        <a class="nav-link" href="#"><?php echo $_SESSION["name"] ?></a>
        </li>
        <li class="nav-item ml-auto">
      <a class="nav-link" href="http://localhost/mnm1/logout.php">Đăng xuất</a>
    </li>
    <?php else : ?>
    <li class="nav-item ml-auto">
      <a class="nav-link" href="http://localhost/mnm1/register.php">Đăng ký</a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="http://localhost/mnm1/login.php">Đăng nhập</a>
    </li>
    <?php endif; ?>
    
  </ul>
</nav>
<div class="container">

<?php if($is_login) : ?>
    <form method="post" class="mt-5">
  <div class="form-group">
    <label for="exampleInputPassword1">Địa chỉ</label>
    <input type="text" name="address" class="form-control" id="exampleInputPassword1" placeholder="Nhập địa chỉ">
  </div>
  <div class="form-group">
        <label for="exampleFormControlTextarea1">Ngày giờ hẹn tiêm</label> <br />
        <input type="datetime-local"  name="appointment_date">
    </div>
  <div class="form-group">
        <label for="exampleFormControlSelect1">Đối tượng ưu tiên</label>
        <select class="form-control" name="personal_type_id">
            <?php foreach ($rows AS $row):?>
            <option value="<?php echo $row['0']?>"><?php echo $row['1']?></option>
            <?php endforeach;?>
        </select>
    </div>
  <button type="submit" name="vaxin_register" class="btn btn-primary">Đăng ký tiêm</button>

  <?php
    if (isset($_POST['vaxin_register'])){
        $user_name = $_SESSION['user_name'];
        $address = $_POST['address'];
        $appointment_date = $_POST['appointment_date'];
        $personal_type_id = $_POST['personal_type_id'];
        $conn = new mysqli("localhost", "root", "", "kiemtra1");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "INSERT INTO `vaxin_register` ( address,personal_type_id, appointment_date, user_name ) VALUES('".$address."','".$personal_type_id."','".$appointment_date."', '".$user_name."')";
        
        if ($conn->query($sql) === TRUE) {
            $message = "Đăng ký tiêm thành công";
            echo "<script type='text/javascript'>alert('$message');</script>";
            header('location:index.php');
        } else {
            echo "Đăng ký tiêm không thành công do lỗi -->" . $conn->error;
        }
        $conn->close();
    }
    ?>
</form>
    <?php else : ?>
    <h1>Bạn chưa đăng nhập</h1>
    <?php endif; ?>
</div>

</body>
</html>

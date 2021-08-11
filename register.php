
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Đăng ký tài khoản</title>
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
    <li class="nav-item ml-auto">
      <a class="nav-link" href="http://localhost/mnm1/register.php">Đăng ký</a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="http://localhost/mnm1/login.php">Đăng nhập</a>
    </li>
  </ul>
</nav>
<div class="container">
<form method="post" class="mt-5">
  <div class="form-group">
    <label for="exampleInputEmail1">Họ và tên</label>
    <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Nhập họ tên">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Tên đăng nhập</label>
    <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Nhập tên tài khoản">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Mật khẩu</label>
    <input type="password" name="pass_word" class="form-control" id="exampleInputPassword1" placeholder="Nhập mật khẩu">
  </div>
  <button type="submit" name="register" class="btn btn-primary">Đăng ký</button>

  <?php
    if (isset($_POST['register'])){
        $user_name = $_POST['user_name'];
        $pass_word =md5( $_POST['pass_word']);
        $full_name = $_POST['full_name'];
        $conn = new mysqli("localhost", "root", "", "kiemtra1");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "INSERT INTO `user` ( user_name,pass_word, full_name ) VALUES('".$user_name."','".$pass_word."','".$full_name."')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Thêm tài khoản thành công";
            header('location:login.php');
        } else {
            echo "Thêm tài khoản không thành công do lỗi -->" . $conn->error;
        }
        $conn->close();
    }
    ?>
</form>
</div>

</body>
</html>

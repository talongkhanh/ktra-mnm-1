

<?php 
    session_start();

?>

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
    <label for="exampleInputEmail1">Tên đăng nhập</label>
    <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Nhập tên tài khoản">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Mật khẩu</label>
    <input type="password" name="pass_word" class="form-control" id="exampleInputPassword1" placeholder="Nhập mật khẩu">
  </div>
  <button type="submit" name="login" class="btn btn-primary">Đăng nhập</button>

  <?php
    if (isset($_POST['login'])){
        $user_name = $_POST['user_name'];
        $pass_word = $_POST['pass_word'];
        if($user_name == 'admin' && $pass_word == 'admin'){
            $_SESSION["admin"] = md5("khanhdeptrai1");
            header('location:admin/vaxin_register.php');
        } else {
        $pass_word = md5($pass_word);
        $conn = new mysqli("localhost", "root", "", "kiemtra1");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "select * from user where user_name = '".$user_name."' and pass_word = '".$pass_word."'";
        $query=mysqli_query($conn, $sql);
        $row =mysqli_fetch_array($query);
        if (isset($row['user_name'])) {
            $_SESSION["login_status"] = md5("khanhdeptrai");
            $_SESSION["name"] = $row["full_name"];
            $_SESSION["user_name"] = $row["user_name"];
            header('location:index.php');
        } else {
            echo $conn->error;
        }
        $conn->close();
        }
    }
    ?>
</form>
</div>

</body>
</html>

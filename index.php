<?php
include 'config.php';

session_start();
error_reporting(0);

if(isset($_SESSION['user'])){
  header("Location: profile.php");
}

if(isset($_POST['submit'])){
  $username = $_POST['username'];
  $password = md5($_POST['password']);

  $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  $result = mysqli_query($conn,$sql);

  if($result->num_rows > 0){
    $row = mysqli_fetch_assoc($result);
    $_SESSION['user'] = $row['username'];
    $_SESSION['user_id'] = $row['usr_id'];
    header("Location: profile.php");
  }else{
    echo "<scrpit>alert('Woops! Username or Password is Wrong.')</script>";
  }

}

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <title>Music App</title>
</head>
<body>
  <div class = "formContainer">
    <form action="" method="POST" class="login-email">
      <div class="input-group">
        <input type="text" placeholder="Username" name="username" value="<?php echo $_POST['username']; ?>" required>
      </div>
      <div class="input-group">
        <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
      </div>
      <div class="input-group">
        <button name="submit" class="btn">Login</button>
      </div>
      <p class="login-register-text">Don't have an account? <a href="register.php">Register Here</a>.</p>
    </form>
  </div>
<?php include('templates/footer.php'); ?>
</html>

<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('./db_connect.php');
ob_start();
if(!isset($_SESSION['system'])){
	$system = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
	foreach($system as $k => $v){
		$_SESSION['system'][$k] = $v;
	}
}
ob_end_flush();
?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?php echo $_SESSION['system']['name'] ?></title>
  <?php include('./header.php'); ?>
  <?php
  if(isset($_SESSION['login_id'])) header("location:index.php?page=home");
  ?>
  <!-- Add Font Awesome for the social icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<style>
  body {
    width: 100%;
    height: 100vh;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: white;
  }
  
  .login-container {
    display: flex;
    width: 900px;
    max-width: 90%;
    height: 500px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    border-radius: 15px;
    overflow: hidden;
    background-color: white;
  }
  
  .login-image {
    flex: 1;
    background: url(assets/uploads/<?php echo $_SESSION['system']['cover_img'] ?>);
    background-size: cover;
    background-position: center;
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    color: white;
    text-align: center;
  }
  
  .login-image::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.4);
  }
  
  .login-image h1 {
    position: relative;
    z-index: 1;
    margin: 0;
    font-size: 2.5rem;
    font-weight: bold;
  }
  
  .login-image p {
    position: relative;
    z-index: 1;
    font-size: 1rem;
    margin-top: 5px;
    font-style: italic;
  }
  
  .login-form {
    flex: 1;
    background: white;
    padding: 40px;
    display: flex;
    flex-direction: column;
  }
  
  .welcome-text {
    margin-bottom: 20px;
  }
  
  .welcome-text h2 {
    margin: 0;
    margin-bottom: 5px;
    font-size: 1.5rem;
    font-weight: bold;
    color: #333;
  }
  
  .welcome-text p {
    margin: 0;
    color: #666;
    font-size: 0.9rem;
  }
  
  .form-group {
    margin-bottom: 20px;
  }
  
  .form-group label {
    display: block;
    margin-bottom: 8px;
    font-size: 0.9rem;
    color: #333;
    font-weight: 500;
  }
  
  .form-control {
    width: 100%;
    padding: 10px 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 0.9rem;
  }
  
  .form-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    font-size: 0.85rem;
  }
  
  .remember-me {
    display: flex;
    align-items: center;
  }
  
  .remember-me input {
    margin-right: 5px;
  }
  
  .forgot-password {
    color: #007bff;
    text-decoration: none;
  }
  
  .btn-primary {
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 12px;
    font-size: 0.9rem;
    cursor: pointer;
    width: 100%;
    text-align: center;
    margin-bottom: 10px;
  }
  
  .alt-login {
    text-align: center;
    margin-top: auto;
  }
  
  .login-divider {
    text-align: center;
    margin: 2px 0;
    color: #666;
    font-size: 0.85rem;
  }
  
  .social-login {
    display: flex;
    justify-content: center;
    gap: 2px;
	margin-bottom: 5px;
  }
  
  .social-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 10px 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    cursor: pointer;
    width: 120px;
    background: white;
  }
  
  .social-btn i {
    margin-right: 10px;
    font-size: 18px;
  }
  
  .google-icon {
    color: #DB4437;
  }
  
  .microsoft-icon {
    color: #00A4EF;
  }
  
  .signup-link {
    text-align: center;
    font-size: 0.85rem;
    color: #666;
  }
  
  .signup-link a {
    color: #007bff;
    text-decoration: none;
  }
  
  /* Alert styling */
  .alert-danger {
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
    padding: 10px 15px;
    margin-bottom: 15px;
    border: 1px solid transparent;
    border-radius: 5px;
  }
</style>

<body>
  <div class="login-container">
    <div class="login-image">
      <h1>MemoraBook</h1>
      <p>"Where memories begin"</p>
    </div>
    <div class="login-form">
      <div class="welcome-text">
        <h2>Welcome back!</h2>
        <p>Please sign in to your account</p>
      </div>
      
      <form id="login-form">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username">
        </div>
        
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
        </div>
        
        <div class="form-footer">
          <div class="remember-me">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Remember me</label>
          </div>
          <a href="#" class="forgot-password">Forgot password?</a>
        </div>
        
        <button type="submit" class="btn-primary">Login</button>
      </form>
      
      <div class="login-divider">Or continue with</div>
      
      <div class="social-login">
        <button class="social-btn">
          <i class="fab fa-google google-icon"></i>
        </button>
        <button class="social-btn">
          <i class="fab fa-microsoft microsoft-icon"></i>

        </button>
      </div>
      
      <div class="signup-link">
        Don't have an account? <a href="#">Sign up</a>
      </div>
    </div>
  </div>
  
  <script>
    $('#login-form').submit(function(e){
      e.preventDefault()
      $('#login-form button[type="submit"]').attr('disabled',true).html('Logging in...');
      if($(this).find('.alert-danger').length > 0 )
        $(this).find('.alert-danger').remove();
      $.ajax({
        url:'ajax.php?action=login',
        method:'POST',
        data:$(this).serialize(),
        error:err=>{
          console.log(err)
          $('#login-form button[type="submit"]').removeAttr('disabled').html('Enter the Memories');
        },
        success:function(resp){
          if(resp == 1){
            location.href ='index.php?page=home';
          }else{
            $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
            $('#login-form button[type="submit"]').removeAttr('disabled').html('Enter the Memories');
          }
        }
      })
    })
  </script>
</body>
</html>
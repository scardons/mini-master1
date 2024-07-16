<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - login 002</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel="stylesheet" href="<?php echo URL;?>login/dist/style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="login-container">
  <div class="login-content">
    <div class="login-content_header">
      <span class="logo">
        <box-icon type='solid' name='landscape' color="#87A922"></box-icon> Land Scape
      </span>
      <h2>Welcome back</h2>
    </div>
    <div>
      <form class="login-form" method="post">
        <label for="username">Username</label>
        <input type="text" placeholder="User" name="txtUser">
        <label for="password">Password</label>
        <input type="password" placeholder="Password" name="txtPassword">
        <input type="submit" name="btnLogin"> 
      </form>
      
    </div>
  </div>
  <div class="login-footer">
          <p>Terms of use | Privacy policy</p>
  </div>
</div>
<!-- partial -->
  <script src='https://unpkg.com/boxicons@2.1.4/dist/boxicons.js'></script>
</body>
</html>
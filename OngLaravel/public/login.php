<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>LOG-IN</title>
  <link rel="stylesheet" type="text/css" href="style.css?v=<?php echo time(); ?>">
</head>
<body>
  <div class="header">
  	<h2>L O G - I N</h2>
  </div>
	 
  <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">LOG-IN</button>
  	</div>
  	<p>
  		Not yet registered? <a href="register.php">Sign up</a>
  	</p>
  </form>
</body>
</html>
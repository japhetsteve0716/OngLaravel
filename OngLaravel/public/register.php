<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>REGISTRATION</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>REGISTER</h2>
  </div>
	
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>ID</label>
  	  <input type="text" name="user_id" value="<?php echo $user_id; ?>">
  	</div>
    <div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="input-group">
  	  <label>First Name</label>
  	  <input type="text" name="firstname" value="<?php echo $firstname; ?>">
  	</div>
    <div class="input-group">
  	  <label>Surname</label>
  	  <input type="text" name="surname" value="<?php echo $surname; ?>">
  	</div>
    <div class="input-group">
  	  <label>Middle Initial</label>
  	  <input type="text" name="middle_initial" value="<?php echo $middle_initial; ?>">
  	</div>
    <div class="input-group">
  	  <label>Course</label>
  	  <input type="text" name="course" value="<?php echo $course; ?>">
  	</div>
      <div class="input-group">
  	  <label>Year Level</label>
  	  <input type="text" name="year_level" value="<?php echo $year_level; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">REGISTER</button>
  	</div>
  	<p>
  		Already have an account? <a href="login.php">Sign in!</a>
  	</p>
  </form>
</body>
</html>
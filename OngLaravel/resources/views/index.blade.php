<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<style type="text/css">  
           *{  
                padding: 0;  
                margin: 0;  
                box-sizing: border-box;  
                font-family: 'verdana', sans-serif;  
           }  
           body{  
                display: flex;  
                justify-content: center;  
                align-items: center;  
                width: 100%;  
                height: 100vh;  
                background-color: #00FF7F;  
           }  
           table{  
                border-collapse: collapse;  
           }  
           table th{  
                background-color: #00CED1;  
                padding: 8px 10px;  
                color: #fff;  
           }  
           table td{  
                background-color: #F0E68C;  
                padding: 8px 10px;  
                color: #111;  
           }  
           .opt{  
                background-color: orange;  
                color: #fff;  
                font-size: 1em;  
                padding: 5px;  
                text-decoration: none;  
           }  
      </style>  
	
</head>
<body>

<div class="header">
	
</div>
<div class="content">
<h2>Home Page</h2>
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php 
        $db = mysqli_connect('localhost', 'root', '', 'web_ong');
        $result = mysqli_query($db, "SELECT * FROM user"); 
    ?>

<table border= 1>
	<thead>
		<tr>
			<th>ID</th>
            <th>Username</th>
			<th>First Name</th>
            <th>Surname</th>
            <th>Middle Initial</th>
            <th>Course</th>
            <th>Year Level</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($result)) { ?>
		<tr>
			<td><?php echo $row['user_id']; ?></td>
            <td><?php echo $row['username']; ?></td>
			<td><?php echo $row['firstname']; ?></td>
            <td><?php echo $row['surname']; ?></td>
            <td><?php echo $row['middle_initial']; ?></td>
            <td><?php echo $row['course']; ?></td>
            <td><?php echo $row['year_level']; ?></td>
			<td>
				<a href="register.php?edit=<?php echo $row['user_id']; ?>" class="edit_btn" >Edit </a>
			</td>
			<td>
				<a href="server.php?del=<?php echo $row['user_id']; ?>" class="del_btn"> Delete</a>
			</td>
		</tr>
	<?php } ?>
</table> <br></br>
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>WELCOME <strong><?php echo $_SESSION['username']; ?></strong></p>
    	<p> <a href="index.php?logout='1'" style="color: red;">LOG-OUT</a> </p>
    <?php endif ?>
</div>
		
</body>
</html>
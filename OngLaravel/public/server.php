<?php
session_start();

// initializing variables
$user_id = "";
$username = "";
$firstname = "";
$surname = "";
$middle_initial = "";
$course = "";
$year_level = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'web_ong');


// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $user_id = mysqli_real_escape_string($db, $_POST['user_id']);
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
  $surname = mysqli_real_escape_string($db, $_POST['surname']);
  $middle_initial = mysqli_real_escape_string($db, $_POST['middle_initial']);
  $course = mysqli_real_escape_string($db, $_POST['course']);
  $year_level = mysqli_real_escape_string($db, $_POST['year_level']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($user_id)) { array_push($errors, "ID is required"); }
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($firstname)) { array_push($errors, "Firstname is required"); }
  if (empty($surname)) { array_push($errors, "Surname is required"); }
  if (empty($middle_initial)) { array_push($errors, "Middle Inital is required"); }
  if (empty($course)) { array_push($errors, "Course is required"); }
  if (empty($year_level)) { array_push($errors, "Year Level is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords does not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM user WHERE username='$username' OR user_id='$user_id' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['user_id'] === $user_id) {
      array_push($errors, "ID already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO user (user_id, username, firstname, surname, middle_initial, course, year_level, password) 
  			  VALUES('$user_id', '$username', '$firstname', '$surname', '$middle_initial', '$course', '$year_level', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}
// LOGIN USER
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "YOU HAVE SUCCESSFULLY LOGGED IN!";
          header('location: index.php');
        }else {
            array_push($errors, "Wrong username/password combination");
        }
    }
  }
  if (isset($_GET['del'])) {
	$user_id = $_GET['del'];
	mysqli_query($db, "DELETE FROM user WHERE user_id=$user_id");
	$_SESSION['message'] = "Address deleted!"; 
	header('location: index.php');
}
?>  
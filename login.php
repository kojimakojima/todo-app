<?php
session_start();
include "db_conn.php";

if(isset($_POST['username']) && isset($_POST['password'])) {

  function validate($data) {
    // 'trim' function removes whitespace and other predefined characters from both sides of a string.
    $data = trim($data);
    // 'stripslashes' function removes backslashes from the string.
    $data = stripslashes($data);
    // This prevents attackers from exploiting the code by injecting HTML or JavaScript code (Cross-Site Scripting attacks) in forms.
    $data = htmlspecialchars($data);
    
    return $data;
  }
}

$username = validate($_POST['username']);
$password = validate($_POST['password']);

if(empty($username)) {
  header("Location: index.php?error=username is required");
  exit();
}
else if(empty($password)) {
  header("Location: index.php?error=password is required");
  exit();
}

$sql = "SELECT * FROM users WHERE user_name='$username'";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) === 1) {
  $row = mysqli_fetch_assoc($result);
  if($row['user_name'] === $username && password_verify($password, $row['password'])) {
    echo "Logged in!";
    $_SESSION['user_name'] = $row['user_name'];
    $_SESSION['id'] = $row['id'];
    header("Location: home.php");
    exit();
  }
  else {
    header("Location: index.php?error=incorrect username or password");
    exit();
  }
}
else {
  header("Location: index.php");
  exit();
}

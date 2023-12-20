<?php
include "db_conn.php";

if(isset($_POST['username']) && isset($_POST['password'])) {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  // Hash the password
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  $sql = "INSERT INTO users (user_name, password) VALUES ('$username', '$hashedPassword')";

  try{
    if(mysqli_query($conn, $sql)) {
      echo "<div class='text-center'>
              <h2 class='text-2xl mb-4'>Created a new account!</h2>
              <a href='index.php' class='text-2xl text-blue-500 border-2 p-1'>Go back</a>
            </div>";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }
  catch(mysqli_sql_exception) {
    echo "<div class='text-center'>
            <h2 class='text-2xl mb-4'>That username is taken.</h2>
            <a href='index.php' class='text-2xl text-blue-500 border-2 p-1'>Go back</a>
          </div>";
  }
  
} else {
  echo "Username and password required";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Document</title>
</head>
<body class="w-screen h-screen flex flex-col justify-center items-center gap-20 bg-neutral-900 text-neutral-300">
  
</body>
</html>
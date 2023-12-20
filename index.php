<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Todo - Login</title> 
</head>
<body class="w-screen h-screen flex flex-col justify-center items-center gap-10 bg-neutral-900 text-neutral-300">

  <!-- ERROR MESSAGE -->
  <?php if(isset($_GET['error'])) { ?>
      <p class="text-red-300"><?php echo $_GET['error']; ?></p>
  <?php } ?>


  <!-- LOGIN -->
  <form action="login.php" method="post" class="flex flex-col text-center w-96 p-6 border-2 border-neutral-500 rounded-lg">
    <h2 class="text-2xl">Login</h2>

    <label>Username </label>
    <input type="text" name="username" placeholder="john" class="text-neutral-800">

    <label>Password </label>
    <input type="password" name="password" placeholder="qwerty1234" class="mb-2 text-neutral-800">

    <button type="submit" class="border-2 rounded-lg hover:border-emerald-500">Login</button>
  </form>


  <!-- SIGNUP -->
  <form action="signup.php" method="post" class="flex flex-col text-center w-96 p-6 border-2 border-neutral-500 rounded-lg">
    <h2 class="text-2xl">Sign Up</h2>

    <label for="username">Username</label>
    <input type="text" name="username" id="username" placeholder="new name" required class="text-neutral-800">

    <label for="password">Password</label>
    <input type="password" name="password" id="password" placeholder="some password" required class="mb-2 text-neutral-800">

    <button type="submit" class="border-2 rounded-lg hover:border-emerald-500">Sign Up</button>
  </form>

</body>
</html> 
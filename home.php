<?php
  session_start();
  include "db_conn.php";

  if(isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Todo - Home</title>
  </head>
  <body class="w-screen h-screen bg-neutral-900 text-neutral-300">
    <nav class="bg-neutral-800">
    <ol class="flex justify-between gap-4 p-1 items-center">
      <li class="ml-4 font-bold">Todo App</li>
      <div class="flex items-center gap-4 p-1">
        <li class=""><?php echo $_SESSION['user_name']; ?></li>
        <li class="border-2 p-1 rounded-xl uppercase border-neutral-400 hover:border-red-800"><a href="logout.php">Logout</a></li>
      </div>
    </ol>
  </nav>
    
    <div class="text-center">
      <h1 class="text-2xl my-10 font-bold">Hello, <?php echo $_SESSION['user_name']; ?> </h1>

      <h2 class="text-xl p-4 mx-16 border-t-2 border-neutral-500 uppercase font-bold">Todo List</h2>

      <!-- ERROR MESSAGE -->
      <?php if(isset($_GET['error'])) { ?>
        <p class="text-red-300"><?php echo $_GET['error']; ?></p>
      <?php } ?>
    </div>

    
    <div class="flex flex-col items-center my-10">
      <!-- Add -->
      <form action="add_todo.php" method="post" class="flex flex-col w-96">
        <input type="text" name="todo_title" placeholder="Enter Todo" class="bg-neutral-300 text-neutral-800">
        <button type="submit" class="border-4 border-neutral-800 hover:border-emerald-500">Add</button>
      </form>

      <?php
        // Query to fetch todos
        $userId = $_SESSION['id'];
        $query = "SELECT * FROM todos WHERE user_id = '$userId'";
        $result = mysqli_query($conn, $query);

        echo "<div class='grid grid-cols-3 gap-4 text-center p-10'>"; // Start grid layout

        // Each Card
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
              echo "<div class='border w-48 p-4'>";
              echo "<h3 class='text-xl pb-4 font-bold'>" . $row["title"] . "</h3>";
              echo "<a href='update_todo.php?id=" . $row["id"] . "' class='border-2 rounded-lg p-1 border-neutral-500 hover:border-sky-500'>Update</a> ";
              echo "<a href='delete_todo.php?id=" . $row["id"] . "' class='border-2 rounded-lg p-1 border-neutral-500 hover:border-red-500'>Delete</a>";
              echo "</div>";
            }
        } else {
            echo "<div>No todos found</div>";
        }

        echo "</div>"; // Close grid layout
      ?>

    </div>

  </body>
  </html>

<?php
  } else {
    header("Location: index.php");
    exit();
  }
?>

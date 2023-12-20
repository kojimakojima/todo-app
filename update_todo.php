<?php
session_start();
include "db_conn.php";

if(isset($_GET['id']) && isset($_SESSION['id'])) {
    $todoId = $_GET['id'];
    $userId = $_SESSION['id'];

    // Fetch the current todo
    $query = "SELECT * FROM todos WHERE id = '$todoId' AND user_id = '$userId'";
    $result = mysqli_query($conn, $query);
    if($row = mysqli_fetch_assoc($result)) {
        $currentTodo = $row['title'];
    }

    if(isset($_POST['todo_title'])) {
        $updatedTodo = mysqli_real_escape_string($conn, $_POST['todo_title']);
        
        // Update the todo
        $updateQuery = "UPDATE todos SET title = '$updatedTodo' WHERE id = '$todoId' AND user_id = '$userId'";
        if(mysqli_query($conn, $updateQuery)) {
            header("Location: home.php");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Todo - Edit</title>
</head>
<body class="w-screen h-screen bg-neutral-900 text-neutral-300 flex justify-center items-center">
    <form action="" method="post" class="flex flex-col gap-2">
        <input type="text" name="todo_title" value="<?php echo $currentTodo; ?>" class="text-neutral-800">
        <button type="submit" class="border">Edit</button>
    </form>
</body>
</html>

<?php
} else {
    header("Location: index.php");
    exit();
}
?>

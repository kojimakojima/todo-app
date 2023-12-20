<?php
session_start();
include "db_conn.php";

if(isset($_POST['todo_title'])) {
    $title = mysqli_real_escape_string($conn, $_POST['todo_title']);
    $userId = $_SESSION['id'];

    if(empty($title)) {
        header("Location: home.php?error=Todo cannot be empty");
        exit();
    } else {
        $sql = "INSERT INTO todos (title, user_id) VALUES ('$title', '$userId')";
        if(mysqli_query($conn, $sql)) {
            header("Location: home.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
} else {
    header("Location: home.php?error=Todo is required");
    exit();
}
?>

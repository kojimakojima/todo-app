<?php
session_start();
include "db_conn.php";

if(isset($_GET['id']) && isset($_SESSION['id'])) {
    $todoId = $_GET['id'];
    $userId = $_SESSION['id'];

    $deleteQuery = "DELETE FROM todos WHERE id = '$todoId' AND user_id = '$userId'";
    if(mysqli_query($conn, $deleteQuery)) {
        header("Location: home.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: index.php");
    exit();
}
?>

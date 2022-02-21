<?php
include 'datenbank.php';
if (!empty($_POST["username"]) && !empty($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $sql = "SELECT username, password FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1) {
        $row = $result->fetch_array();
        $hashed_password = $row['password'];
        if (password_verify($password, $hashed_password)) {
            session_start();
            $_SESSION["loggedin"] = true;
            header("location: hauptseite.php");
            exit;
        }
    } else {
        echo "username or password is wrong";
    }
} else {
    echo "username or password empty";
}

<?php
include 'datenbank.php';
if (!empty($_POST["username"]) && !empty($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $userExistsSql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $userExistsSql);
    if (mysqli_num_rows($result) == 1) {
        echo "this user already exists";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
        mysqli_query($conn, $sql);
        echo "user successfully registered";
    }
} else {
    echo "username or password empty";
}

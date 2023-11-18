<?php
session_start();
session_save_path("session");
$_SESSION["error"] = "";

$username = $_POST["username"];
$password = $_POST["password"];

$user_infile = "";
$password_infile = "";

$user_data = file("user_data.txt");

$user_to_match = '';
for ($i = 0; $i < count($user_data); $i++) {
    $user_to_match = strstr($user_data[$i], $username);
    if ($user_to_match !== FALSE) {
        break;
    }
}
$user_to_match = explode(",", $user_to_match);

$user_infile = $user_to_match[0];
$password_infile = $user_to_match[1];

// Check if the provided password matches the hashed password from the file
if (password_verify($password, $password_infile)) {
    $_SESSION["loggedin"] = true;
    $_SESSION["username"] = $username;
    $_SESSION["password"] = $password;
    header('Location: home.php');
    exit();
} else {
    $_SESSION["error"] = "Incorrect Username or Password";
    header('Location: login.php');
    exit();
}
?>

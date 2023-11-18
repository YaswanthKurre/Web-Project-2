<?php
session_start();

$user = array(
    'name' => '',
    'password' => '',
    'amount' => 0
);

$errors = array();

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    $username = test_input($_POST["username"]);
    // Check if the username contains only letters and numbers
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $errors[] = "Only letters and numbers are allowed in the username";
    }
    // Check if the username contains spaces
    elseif (strpos($username, ' ') !== false) {
        $errors[] = "Username should not contain spaces";
    }

    if ($_POST["password1"] != $_POST["password2"]){
        $errors[] = "Password fields do not match";
    }

    // Validate password
    $password = test_input($_POST["password1"]);

    // Check if the password meets the criteria
    if (!preg_match("/^(?=.*[a-z])/", $password)) {
        $errors[] = "Password should contain at least one lowercase letter";
    }
    if (!preg_match("/^(?=.*[A-Z])/", $password)) {
        $errors[] = "Password should contain at least one uppercase letter";
    }
    if (!preg_match("/^(?=.*\d)/", $password)) {
        $errors[] = "Password should contain at least one number";
    }
    if (!preg_match("/^(?=.*[@$!%*?&])/", $password)) {
        $errors[] = "Password should contain at least one special character";
    }
    if (strlen($password) < 6) {
        $errors[] = "Password should be at least 6 characters long";
    }

    // If there are no errors, you can proceed to store the username and password in the database
    if (empty($errors)) {
        if (isset($_POST['username'])) {
            $user['name'] = $username;
        }

        if (isset($_POST['password1'])) {
            $user['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        // Convert user data to a string
        $user_details = implode(",", $user);

        // Open the file in append mode
        $file = fopen('user_data.txt', 'a');

        // Write the user details to the file with a newline character
        fwrite($file, $user_details . PHP_EOL);

        // Close the file
        fclose($file);

        header('Location: login.php');
        exit();
    } else {
        $_SESSION["error"] = $errors;
        header('Location: signup.php');
        exit();
    }
}
?>

<?php session_start();
$logged=true;
if (!isset($_SESSION['loggedin'])) {
    $logged=false;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Who Wants to Be a Millionaire?</title>
    <link rel="stylesheet" href="project2_style.css" type="text/css">
</head>
<body>
    <div class="menu_bar">
        <div class="left_links">
            <div id="casino">
                <?php if ($logged == false) : ?>
                    <a href="index.php">Home</a>
                <?php else : ?>
                    <a href="home.php">Home</a>
                <?php endif; ?>
            </div>
            <div id="games">
                <a href="rules.php"> Rules</a>
            </div>
            <?php if ($logged == true) : ?>
                <div id="games">
                    <a href="quiz.php"> Start Game</a>
                </div>
            <?php endif; ?>
        </div>
        <div class="center_logo">
            <div class="logo">
                <img src="logo.png" class="logo">
            </div>
        </div>
        <?php if ($logged == false) : ?>
            <div class="right_links">
                <div id="login">
                    <a href="login.php">Log In</a>
                </div>
                <div class="join">
                    <a href="signup.php">Join Now</a>
                </div>
            </div>
        <?php else : ?>
            <div class="right_links">
                <div id="login">
                    <a href="leaderboard.php">Leaderboard</a>
                </div>
                <div class="join">
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <br/>
    <img id="background" src="background.jpg" alt="Blurred Background">
    <div id="overlay"></div>
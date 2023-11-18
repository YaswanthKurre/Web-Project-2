 <?php
 session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
} else {
  header('Location: login.php');
  exit();
}

function displayLeaderboard() {
    $userDataFile = 'user_data.txt';
    $users = file($userDataFile, FILE_IGNORE_NEW_LINES);

    usort($users, function ($a, $b) {
        $scoreA = (int)explode(',', $a)[2];
        $scoreB = (int)explode(',', $b)[2];

        return $scoreB - $scoreA;
    });

    echo '<h2><strong><center>Leaderboard</center></strong></h2>';
    echo '<table>';
    echo '<tr><th>Username</th><th>Amount Earned</th></tr>';

    foreach ($users as $user) {
        $userData = explode(',', $user);
        $username = trim($userData[0]);
        $amountEarned = (int)$userData[2];

        echo '<tr>';
        echo '<td>' . $username . '</td>';
        echo '<td>$' . $amountEarned . '</td>';
        echo '</tr>';
    }

    echo '</table>';
}

?>

<?php include("header.php"); ?>
<div id="content">
    <p>Check out the current standings! Here is the leaderboard:</p>
<?php displayLeaderboard(); ?>
</div>
<?php include("footer.html"); ?>

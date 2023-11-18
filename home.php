<?php session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
} else {
	header('Location: login.php');
	exit();
}
?>

<?php include("header.php"); ?>
<div id="content">
	<h2><center>Who Wants to Be a Millionaire?</center></h2> 
	<strong> <center>Free online US version</center></strong>
	<p>Welcome! You have reached the free online game based on the famous TV show “Who Wants to Be a Millionaire?”. We have developed the online game to be very similar to the original TV show. Players have the opportunity to make easy money if they correctly answer some (not always easy) questions.</p>

	<p>To stand the chance of getting rich with this online version of the show that creates instant-millionaires, we recommend that you carefully read the rules of the game. In order to succeed and reach the ultimate 15th question, you’ll need a clear understanding of how the game works. You’ll note that we also give away some fantastic consolation prizes on a weekly basis. </p>

	<p>The game consists of 15 questions. The level of difficulty increases with each question, and so does your potential wealth. For example, if you answer the first set of questions correctly your prize money goes from $100 to $1,000,000. As you work your way through the questions by supplying the correct answers your riches grow exponentially until you reach the final question - and if you answer it correctly you will succeed in making a million dollars!</p>

	<p> Finds interesting then consider starting the quiz <a href="quiz.php" style="color:yellow;"> Now  </a></p>
</div>
<?php include("footer.html"); ?>



<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
	header('Location: home.php');
	exit();
}
$error_message = isset($_SESSION["error"]) ? $_SESSION["error"] : array();
?>

<?php include("header.php"); ?>
<div id="login-content">
	<div class="login-container">
		<section>
			<form action="signup-submit.php" method="post">
				<h1><strong>Register</strong></h1>
				<label for="username">Username:</label>
				<input type="text" id="username" name="username" placeholder="Enter your username" required>
				<label for="password1">Enter Password:</label>
				<input type="password" id="password1" name="password1" placeholder="Enter your password" required>
				<label for="password2">Confirm Password:</label>
				<input type="password" id="password2" name="password2" placeholder="Confirm your password" required>
				<button type="submit">Submit</button>
				<div style="color: red; font-size:16px; margin: 10px;">
					<?php
					if (!empty($error_message)) {
						foreach ($error_message as $error) {
							echo $error."<br>";
						}
					}
					$_SESSION["error"]="";
					?>
				</div>
				<p>Already have an account? <a href="login.php" style="color: yellow;">Login here</a></p>
			</form>
		</section>
	</div>
</div>
<?php include("footer.html"); ?>

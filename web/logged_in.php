<?php
session_start();// Access the existing session.
require_once('../../secure_conn.php');
require 'includes/header.php';
?>
	<main>
	<?php if (isset($_SESSION['firstName'])){ //check for session variable
			$firstname = $_SESSION['firstName'];
			$message = "Welcome back, $firstname.";
			$message2 = "You are now logged in!";
			$message3 = "Use the links in the navbar to continue.";
		} else {
			$message = 'You have reached this page in error';
			$message2 = 'Please use the menu at the right';
		}
	?>
	<div class = "container">
		<?php
			// Print the message:
			echo '<h2>'.$message.'</h2>';
			echo '<h3>'.$message2.'</h3>';
			echo '<h3>'.$message3.'</h3>';
		?>
	</div>

	</main>
	<?php // Include the footer and quit the script:
	include ('includes/footer.php');
	?>

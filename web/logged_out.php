<?php  require_once ('../../reg_conn.php');
session_start();
		if (isset($_SESSION['firstName'])){
			$firstname = $_SESSION['firstName'];
			$_SESSION = array();
			session_destroy();
			setcookie('PHPSESSID', '', time()-3600, '/');
			$message = "You are now logged out, $firstname";
			$message2 = "See you next time";

		} else {
			$message = 'You have reached this page in error';
			$message2 = 'Please use the menu at the right';
		}
		require 'includes/header.php';
		?>
		<main>
			<div class = "container">
				<?php
				echo '<h2>'.$message.'</h2>';
				echo '<h3>'.$message2.'</h3>';
				?>
			</div>
	</main>
	<?php // Include the footer and quit the script:
	include ('./includes/footer.php');
	?>

<?php
/*********************
* Tidey 2016
* logged_out.php provides the user with a response to the authentication of their
* loggout attempt. If the user reaches this page in error it will display a message.
*********************/
require_once ('../../reg_conn.php');
session_start();
		if (isset($_SESSION['firstName'])){
			$firstname = $_SESSION['firstName'];
			$_SESSION = array();
			session_destroy();
			setcookie('PHPSESSID', '', time()-3600, '/');
			$message = "You are now logged out, $firstname";

		} else {
			$message = 'You have reached this page in error';
		}
		require 'includes/header.php';
		?>
		<main>
			<div class = "container">
				<?php
				echo '<h2>'.$message.'</h2>';
				?>
			</div>
	</main>
	<?php // Include the footer and quit the script:
	include ('./includes/footer.php');
	?>

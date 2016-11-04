<?php //Tidey Register User Page [Brandon Harris]
	require_once('../../secure_conn.php');
	require 'includes/header.php';
	if (isset($_POST['send'])) {
	$missing = array();
	$errors = array();

	$firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING)); //returns a string
	if (empty($firstname))
		$missing[]='firstname';

	$lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING)); //returns a string
	if (empty($lastname))
		$missing[]='lastname';

	$valid_email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));	//returns a string or null if empty or false if not valid
	if (trim($_POST['email']==''))
		$missing[] = 'email';
	elseif (!$valid_email)
		$errors[] = 'email';
	else
		$email = $valid_email;

	$password1 = trim(filter_input(INPUT_POST, 'password1', FILTER_SANITIZE_STRING));
	$password2 = trim(filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_STRING));
	// Check for a password:
	if (empty($password1) || empty($password2))
		$missing[]='password';
	elseif ($password1 !== $password2)
			$errors[] = 'password';
	else $password = $password1;

	$zipcode = trim(filter_input(INPUT_POST, 'zipcode', FILTER_SANITIZE_STRING));


	if (!$missing && !$errors) {
		require_once ('../../pdo_config.php'); // Connect to the db.
		$sql = "INSERT into Tidey_reg_users (firstName, lastName, emailAddr, pw, zip) VALUES (:firstName, :lastName, :email, :pw, :zip)";
		$pw =
	$stmt= $conn->prepare($sql);
	$stmt->bindValue(':firstName', $firstname);
	$stmt->bindValue(':lastName', $lastname);
	$stmt->bindValue(':email', $email);
	$stmt->bindValue(':pw', password_hash($password1, PASSWORD_DEFAULT));
	$stmt->bindValue(':zip',$zipcode);
	$success = $stmt->execute();
	$errorInfo = $stmt->errorInfo();
	if (isset($errorInfo[2])) {
		//echo $errorInfo[2];
		echo "Error: Try a different email. Click 'Register' at top of page.";
	}
	else {
		echo '<main><h2>Thank you for registering</h2><h3>We have saved your information</h3></main>';
	}
	include 'includes/footer.php';
	exit;
	}
}?>

	<main>
    <form method="post" action="#">
					<div class = "container">
						<fieldset>
							<legend>Please Register</legend>
							<?php if ($missing || $errors) { ?>
							<p class="warning">Please fix the item(s) indicated.</p>
							<?php } ?>
			            <p>
			                <label for="fn">First Name:
							<?php if ($missing && in_array('firstname', $missing)) { ?>
			                        <span class="warning">Please enter your first name</span>
			                    <?php } ?> </label>
			                <input name="firstname" id="fn" type="text"
							 <?php if (isset($firstname)) {
			                    echo 'value="' . htmlspecialchars($firstname) . '"';
			                } ?>
							>
			            </p>
						<p>
			                <label for="ln">Last Name:
							<?php if ($missing && in_array('lastname', $missing)) { ?>
			                        <span class="warning">Please enter your last name</span>
			                    <?php } ?> </label>
			                <input name="lastname" id="ln" type="text"
							 <?php if (isset($lastname)) {
			                    echo 'value="' . htmlspecialchars($lastname) . '"';
			                } ?>
							>
			            </p>
			            <p>
			                <label for="email">Email:
							<?php if ($missing && in_array('email', $missing)) { ?>
			                        <span class="warning">Please enter your email address</span>
			                    <?php } ?>
							<?php if ($errors && in_array('email', $errors)) { ?>
			                        <span class="warning">The email address you provided is not valid</span>
			                    <?php } ?>
							</label>
			                <input name="email" id="email" type="text"
							<?php if (isset($email) && !$errors['email']) {
			                    echo 'value="' . htmlspecialchars($email) . '"';
			                } ?>>
			            </p>
						<p>
							<?php if ($errors && in_array('password', $errors)) { ?>
			                        <span class="warning">The entered passwords do not match. Please try again.</span>
			                    <?php } ?>
			                <label for="pw1">Password:

							<?php if ($missing && in_array('password', $missing)) { ?>
			                        <span class="warning">Please enter a password</span>
			                    <?php } ?> </label>
			                <input name="password1" id="pw1" type="password">
			            </p>
						<p>
			                <label for="pw2">Confirm Password:
							<?php if ($missing && in_array('password', $missing)) { ?>
			                        <span class="warning">Please confirm the password</span>
			                    <?php } ?> </label>
			                <input name="password2" id="pw2" type="password">
			            </p>
						<p>
											<label for="zipcode">Zipcode (Optional):</label>
											<input name="zipcode" id="zipcode" type="text">
									</p>


			            <p>
			                <input name="send" type="submit" value="Register">
			            </p>
				</fieldset>
			</div>
    </form>
	</main>
<?php include 'includes/footer.php'; ?>

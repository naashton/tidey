<?php //This is the login page for registered users
require_once('../../secure_conn.php');
session_start();
//require 'includes/header.php';
if (isset($_POST['send'])) {
	$missing = array();
	$errors = array();

	$valid_email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));	//returns a string or null if empty or false if not valid
	if (trim($_POST['email']=='')|| (!$valid_email))  //Either empty or invalid email will be considered missing
		$missing[] = 'email';
	else
		$email = $valid_email;

	$password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));

	// Check for a password:
	if (empty($password))
		$missing[]='password';

	if (!$missing && !$errors) {
		require_once ('../../pdo_config.php'); // Connect to the db.
		// Make the query:
		$sql = "SELECT firstName, emailAddr, pw FROM Tidey_reg_users WHERE emailAddr = :email";
		$stmt = $conn->prepare($sql);
		$stmt->bindValue(':email', $email);
		$stmt->execute();
		$errorInfo = $stmt->errorInfo();
		if (isset($errorInfo[2])){
			echo $errorInfo[2];
			exit;
		}
		else {
			$rows = $stmt->rowCount();
			if ($rows==0) { //email not found
				$errors[] = 'email';
			}
			else { // email found, validate password
				$result = $stmt->fetch();
				if ($password == password_verify($password, $result['pw'])) { //passwords match
					$firstName = $result['firstName'];
					session_start();
					$_SESSION['firstName'] = $firstName;
					$_SESSION['email'] = $email;
					header('Location:http://webdev.cislabs.uncw.edu/~bh4560/TideyProject/tidey/web/logged_in.php');
					exit;


				}
				else {
					$errors[]='password';
				}
			}
		} // End of else errors

	}
}
require 'includes/header.php';
?>
	<main>
		<div class = "container">
		<body>
      <form method="post" action="#">
						<fieldset>
							<legend>Registered Users Login</legend>
							<?php if ($missing || $errors) { ?>
							<p class="warning">Please fix the item(s) indicated.</p>
							<?php } ?>
			            <p>
			                <label for="email">Please enter your email address:

							<?php if ($missing && in_array('email', $missing)) { ?>
			                        <span class="warning">An email address is required</span>
			                    <?php } ?>
							<?php if ($errors && in_array('email', $errors)) { ?>
			                        <span class="warning">The email address you provided is not associated with an account</span>
			                    <?php } ?>
							</label>
			                <input name="email" id="email" type="text"
							<?php if (isset($email) && !$errors['email']) {
			                    echo 'value="' . htmlspecialchars($email) . '"';
			                } ?>>
			            </p>
						<p>
							<?php if ($errors && in_array('password', $errors)) { ?>
			                        <span class="warning">The password supplied does not match the password for this email address. Please try again.</span>
			                    <?php } ?>
			                <label for="pw">Password:

							<?php if ($missing && in_array('password', $missing)) { ?>
			                        <span class="warning">Please enter a password</span>
			                    <?php } ?> </label>
			                <input name="password" id="pw" type="password">
			            </p>

			            <p>
			                <input name="send" type="submit" value="Login">
			            </p>
					</fieldset>
        </form>
			</body>
		</div>
	</main>
<?php include 'includes/footer.php'; ?>

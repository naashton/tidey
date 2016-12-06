<?php
  /*********************
	*Tidey 2016
	*admin.php functions as a page for an administrator to easily see database records on users
  *instead of having to login to phpmyadmin or via the terminal. Using mysqli for this particular part.
	*********************/
	require_once('../../mysqli_config.php');
  require_once('../../secure_conn.php');
	require 'includes/header.php';
?>

<?php if ($_SESSION['email'] == 'admin@tidey.com') { ?>
  <main>
  	<div class="container">
      <div class="col-md-6">
        <div class = "titletext">
          <h1>REGISTERED USERS INFO</h1>
          <hr>
        </div>
        <?php
        echo "<table class=\"table\">
          <thead>
              <tr>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email Address</th>
                  <th>Zip Code</th>
                  <th>User Folder</th>
              </tr>
          </thead>";
        $query = "select * from Tidey_reg_users;";
        if ($result = mysqli_query($conn, $query)) {
            while($row = mysqli_fetch_assoc($result)){
        	echo "<tr><td>".$row['firstName']."</td><td>".$row['lastName']."</td><td>".$row['emailAddr']."</td><td>".$row['zip']."</td><td>".$row['folder']."</td></tr>";
            }
        }
        echo "</table>";
        ?>
      </div>
      <div class="col-md-6">
        <div class = "titletext">
          <h1>USER UPLOAD RECORDS</h1>
          <hr>
        </div>
        <?php
        echo "<table class=\"table\">
          <thead>
              <tr>
                  <th>Email Address</th>
                  <th>File Name</th>
                  <th>File Type</th>
              </tr>
          </thead>";
        $query2 = "select * from Tidey_user_images;";
        if ($result2 = mysqli_query($conn, $query2)) {
            while($row2 = mysqli_fetch_assoc($result2)){
          echo "<tr><td>".$row2['emailAddr']."</td><td>".$row2['imageName']."</td><td>".$row2['imageType']."</td></tr>";
            }
        }

        mysqli_close($conn);

        echo "</table>";
        ?>
      </div>
  	</div>
  </main>
  <?php }
  else { ?>
    <div class = "container">
      <h2>You do not have access to this page.</h2>
    </div>
  <?php } ?>

<?php include './includes/footer.php'; ?>

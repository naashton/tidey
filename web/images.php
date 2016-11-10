<?php require 'includes/header.php';
$folder = $_SESSION['folder'];
?>
<div class = "container">
	<?php
	if (isset($_SESSION['firstName'])) {
	?>
		<main>
			<p>Click on an image to view it in a separate window.</p>
			<ul>
			<?php 	// This script lists the images in the uploads directory.
			$dir = "../uploads/{$folder}"; // Define the directory to view.
			$files = scandir($dir); // Read all the images into an array.

			// Display each image caption as a link
			foreach ($files as $image) {
				if (substr($image, 0, 1) != '.') { // Ignore anything starting with a period.
					// Get the image's size in pixels:
					$image_size = getimagesize ("$dir/$image");

					// Make the image's name URL-safe:
					$image_name = urlencode($image);

					// Print the information:
					echo "<li><a href=\"show_image.php?image=".$image."\">".$image."</a></li>\n";

				} // End of the IF.
			} // End of the foreach loop.
			?>
			</ul>
		</main>
	<?php } //end of if isset firstName
	else {
		echo '<h2 class="warning">You must be logged in to access this page.</h2>';
	} ?>
</div>
<?php include './includes/footer.php'; ?>

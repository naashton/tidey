<?php
echo "<table class=\"table\">
        <thead>
	    <tr>
	        <th>DATE</th>
	        <th>HIGH 1</th>
	        <th>LOW 1</th>
	        <th>HIGH 2</th>
	        <th>LOW 2</th>
	    </tr>
	</thead>";

$servername = "127.0.0.1";
$username = "brk3269";
$password = "carkorabi77888";

$conn = mysqli_connect($servername, $username, $password, "brk3269");

if (mysqli_connect_errno()) {
    printf("Connection failed:\n", mysqli_connect_error());
    exit();
}

$query = "select * from tides where location = 'Beaufort' and tdate = curdate();";
if ($result = mysqli_query($conn, $query)) {
    while($row = mysqli_fetch_assoc($result)){
	echo "<tr><td>".$row['tdate']."</td><td>".$row['high1']."</td><td>".$row['low1']."</td><td>".$row['high2']."</td><td>".$row['low2']."</td></tr>";
    }
}

mysqli_close($conn);

echo "</table>";

?>
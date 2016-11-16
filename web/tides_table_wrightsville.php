<?php
echo "<table class=\"table table-hover\">
        <thead>
	    <tr>
	        <th>Date</th>
	        <th>High 1</th>
	        <th>Low 1</th>
	        <th>High 2</th>
	        <th>Low 2</th>
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

$query = "select * from tides where location = 'Wrightsville Beach' and tdate = curdate();";
if ($result = mysqli_query($conn, $query)) {
    while($row = mysqli_fetch_assoc($result)){
	echo "<tr><td>".$row['tdate']."</td><td>".$row['high1']."</td><td>".$row['low1']."</td><td>".$row['high2']."</td><td>".$row['low2']."</td></tr>";
    }
}

mysqli_close($conn);

echo "</table>";

?>

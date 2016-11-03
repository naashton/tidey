<?php
define(DBCONNSTRING,'mysql:host=127.0.0.1;dbname=bh4560');
define(DBUSER, 'bh4560');
define(DBPASS,'bran2854');
try {
$conn= new PDO(DBCONNSTRING, DBUSER, DBPASS);
//echo "Connection successful!!"; //Delete this line later
} catch (PDOException $e) {
echo $e->getMessage();
}
?>

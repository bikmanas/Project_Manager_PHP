<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "sprintas";

$conn = mysqli_connect($servername, $username, $password, $dbname);



echo "<form action='update.php' method='POST'>";
echo "<input type='text' name='names_id' value='{$_POST['names_id']}'>";
echo "<input type='submit' name='update' value='Update'>";
echo "</form>";

<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "sprintas";

$conn = mysqli_connect($servername, $username, $password, $dbname);


echo "<form action='update.php' method='POST'>";
echo "<input type='text' name='name' value='{$_POST['name']}'>";
echo "<input type='hidden' name='id' value='{$_POST['id']}'>";
echo "<input type='hidden' name='path' value='{$_POST['path']}'>";
echo "<input type='submit' name='update' value='Update'>";
echo "</form>";

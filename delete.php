<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "sprintas";

$conn = mysqli_connect($servername, $username, $password, $dbname);
var_dump($_POST);
if (isset($_POST['delete']) and $_POST['path'] == 'employees' and $_POST['delete'] == 'Delete') {
    //Delete option not working TODO;
    $sql = 'DELETE FROM employees_projects WHERE employees_id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('employee_id', $_POST['names_id']);
    $res = $stmt->execute();

    // $sql = 'DELETE FROM Employees WHERE id = ?';
    // $stmt = $conn->prepare($sql);
    // $stmt->bind_param('id', $_POST['name_id']);
    // $res = $stmt->execute();

    $stmt->close();
    mysqli_close($conn);
    // header("Location: index.php");
    // exit();
}

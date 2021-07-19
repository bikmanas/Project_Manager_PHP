<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "sprintas";

$conn = mysqli_connect($servername, $username, $password, $dbname);

//Employee delete logic: 
if (isset($_POST['delete']) and $_POST['path'] == 'employees' and $_POST['delete'] == 'Delete') {
    $sql = 'DELETE FROM employees_projects WHERE employee_id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_POST['names_id']);
    $res = $stmt->execute();

    $sql = 'DELETE FROM employees WHERE id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_POST['names_id']);
    $res = $stmt->execute();

    $stmt->close();
    mysqli_close($conn);
    header("Location: index.php?path=employees");
    exit();
}

//Project delete logic: 

if (isset($_POST['delete']) and $_POST['path'] == 'projects' or $_POST['path'] == '' and $_POST['delete'] == 'Delete') {
    $sql = 'DELETE FROM employees_projects WHERE project_id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_POST['names_id']);
    $res = $stmt->execute();

    $sql = 'DELETE FROM projects WHERE id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_POST['names_id']);
    $res = $stmt->execute();

    $stmt->close();
    mysqli_close($conn);
    header("Location: index.php?path=projects");
    exit();
}

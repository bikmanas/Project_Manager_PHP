<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "sprintas";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (isset($_POST['update']) and $_POST['path'] == 'employees' and $_POST['update'] == 'Update') {

    //Update logic needs to be done;
    $sql = 'UPDATE employees_projects SET employee_name WHERE employee_id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_POST['names_id']);
    $res = $stmt->execute();

    $sql = 'UPDATE employees SET employee_id WHERE id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_POST['names_name']);
    $res = $stmt->execute();

    $stmt->close();
    mysqli_close($conn);
    header("Location: index.php?path=employees");
    exit();
}

//Project delete logic: 

if (isset($_POST['delete']) and $_POST['path'] == 'projects' and $_POST['delete'] == 'Delete') {
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

<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "sprintas";

$conn = mysqli_connect($servername, $username, $password, $dbname);
//Update logic done: employees

if (isset($_POST['create']) and $_POST['path'] == 'employees' and $_POST['create'] == 'Create') {
    $sql = "INSERT into employees (employee_name) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $_POST['name']);
    $res = $stmt->execute();

    $stmt->close();
    mysqli_close($conn);
    header("Location: index.php?path=employees");
    exit();
}

//Update logic done: projects 

if (isset($_POST['create']) and $_POST['path'] == 'projects' and $_POST['create'] == 'Create') {
    $sql = "INSERT into projects (project_name) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $_POST['name']);
    $res = $stmt->execute();

    $stmt->close();
    mysqli_close($conn);
    header("Location: index.php?path=projects");
    exit();
}

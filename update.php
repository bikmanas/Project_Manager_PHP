<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "sprintas";

$conn = mysqli_connect($servername, $username, $password, $dbname);

//Update logic done: employees

if (isset($_POST['update']) and $_POST['path'] == 'employees' and $_POST['update'] == 'Update') {
    $sql = "UPDATE employees SET employee_name = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $_POST['name'], $_POST['id']);
    $res = $stmt->execute();

    $stmt->close();
    mysqli_close($conn);
    header("Location: index.php?path=employees");
    exit();
}

//Update logic done: projects 

if (isset($_POST['update']) and $_POST['path'] == 'projects' or $_POST['path'] == '' and $_POST['update'] == 'Update') {
    $sql = 'UPDATE projects SET project_name = ? WHERE id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $_POST['name'], $_POST['id']);
    $res = $stmt->execute();

    $stmt->close();
    mysqli_close($conn);
    header("Location: index.php?path=projects");
    exit();
}

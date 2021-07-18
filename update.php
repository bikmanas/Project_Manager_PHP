<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "sprintas";

$conn = mysqli_connect($servername, $username, $password, $dbname);

$fName = '';
$id = '';

if (isset($_POST['update']) and $_POST['path'] == 'employees' and $_POST['update'] == 'Update') {

    $id = $_POST['names_id'];
    $queris = "SELECT * FROM employees_projects where id='" . $_POST['names_id'] . "'";
    $result = $conn->query($queris);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $fName = $row['employee_name'];
        }
    }
}

if (isset($_POST['update']) and $_POST['path'] == 'employees' and $_POST['update'] == 'Update') {
    //Update logic needs to be done;
    $sql = "UPDATE employees_projects SET employee_name = '" . $_POST['names_name'] . "' WHERE employee_id = '" . $_POST['names_id'] . "' ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_POST['names_id']);
    $res = $stmt->execute();

    $sql = "UPDATE employees SET employee_name = '" . $_POST['names_name'] . "' WHERE id = '" . $_POST['names_id'] . "' ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_POST['names_id']);
    $res = $stmt->execute();

    $stmt->close();
    mysqli_close($conn);
    header("Location: index.php?path=employees");
    exit();
}

//Project delete logic: 

if (isset($_POST['update']) and $_POST['path'] == 'projects' and $_POST['update'] == 'Update') {
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

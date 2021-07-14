<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sprintas 2</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

    <header>
        <h1>Projekto valdymas</h1>
        <div>
            <a href="?path=projects">Projektai</a>
            <a href="?path=employees">Darbuotojai</a>
        </div>
    </header>
    <div>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "mysql";
        $dbname = "sprintas";
        $title = strtoupper($_GET['path']);
        $paths = array('projects', 'employees');
        if (isset($_GET['path']) and (in_array($_GET['path'], $paths))) {
            $table = $_GET['path'];
        }
        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if (!isset($_GET['path']) or (isset($_GET['path']) and $_GET['path'] == 'projects')) {
            $sql = "SELECT sprintas.projects.id as projects_id, sprintas.projects.project_name as projects_name, GROUP_CONCAT(' ', employees.employee_name) as names FROM projects
            LEFT JOIN employees_projects ON employees_projects.project_id = projects.id
            LEFT JOIN employees ON employees.id = employees_projects.employee_id
            GROUP BY projects.id";
        } elseif (isset($_GET['path']) and $_GET['path'] == 'employees') {
            $sql = "SELECT sprintas.employees.id as employees_id, sprintas.employees.employee_name as employees_name, GROUP_CONCAT(' ', projects.project_name) as names
            FROM employees
            LEFT JOIN employees_projects ON employees_projects.employee_id = employees.id
            LEFT JOIN projects ON projects.id = employees_projects.project_id
            GROUP BY employees.id";
        }


        $result = mysqli_query($conn, $sql);
        echo '<table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>' . $title . '</th>
                        <th>Projects/Employees</th>
                        <th>Actions</th>
                    </tr>
              </thead>';
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if (!isset($table)) {
                    $table = 'projects';
                }
                echo "<tr>
                    <td>{$row["$table" . "_id"]}</td>
                    <td>{$row["$table" . "_name"]}</td>
                    <td>{$row["names"]}</td>
                    <td>
                    <form class='form-group' action='delete.php' method='POST'>
                        <input type='hidden' name='name_id' value='{$row["$table" . "_id"]}'>
                        <input type='hidden' name='path' value='{$_GET['path']}'>
                        <input type='submit' name='delete' value='Delete'>
                    </form>
                    </td>
                  </tr>";
            }
        } else {
            echo "0 results";
        }
        echo ("</table>");
        mysqli_close($conn);
        ?>
    </div>
</body>


</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sprintas 2</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body class="container">
    <header>
        <h1>Projekto valdymas</h1>
        <div>
            <button id="button">
                <a class="button" href="?path=projects">Projektai</a>
            </button>
            <button id="button">
                <a class="button" href="?path=employees">Darbuotojai</a>
            </button>
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
        echo '<table class="table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>ID</th>';
        if (!isset($_GET['path']) or $_GET['path'] == 'projects') {
            $title1 = 'Projektai';
        } else {
            $title1 = 'Darbuotojai';
        }
        echo '<th>' . $title1 . '</th>';
        if (!isset($_GET['path']) or $_GET['path'] == 'projects') {
            $title1 = 'Darbuotojai';
        } else {
            $title1 = 'Projektai';
        }
        echo '<th>' . $title1 . '</th>';
        echo '<th>Actions</th>';
        echo '</tr>';
        echo '</thead>';

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
                    <form class='form-group' action='edit.php' method='POST'>
                          <input type='hidden' name='name' value='{$row["$table" . "_name"]}'>
                          <input type='hidden' name='id' value='{$row["$table" . "_id"]}'>
                          <input type='hidden' name='path' value='{$_GET['path']}'>
                          <input type='submit' name='update' value='Update'>
                    </form>
                    <form class='form-group' action='delete.php' method='POST'>
                          <input type='hidden' name='names_id' value='{$row["$table" . "_id"]}'>
                          <input type='hidden' name='path' value='{$_GET['path']}'>
                          <input type='submit' name='delete' value='Delete'>
                    </form>
                    </td>
                  </tr>";
            }
        } else {
            echo "0 results";
        }
        echo "<form class='form-group' action='create.php' method='POST'>
                    <input type='text' name='name'>
                    <input type='hidden' name='path' value='{$_GET['path']}'>
                    <input type='submit' name='create' value='Create'>
              </form>";
        echo ("</table>");
        mysqli_close($conn);
        ?>
    </div>
</body>


</html>
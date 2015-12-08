<?php
    session_start();
    include ("Layout/header.html");
    include "db.inc.php";
    if (isset($_SESSION['eingeloggt'])){
     if($_SESSION['eingeloggt']==true){
          include ("Layout/nav-loggedin_fh.html");
        }
     else{
         include ("Layout/nav.html");  
        }
    }
    else{
        include ("Layout/nav.html");
    }
?>
    <!-- Main content -->
    <div class = "col-md-7" id="mainBody">
        <h1>Meine Kursliste</h1>
        <p>
            <a href="course/create.php" class="btn btn-default" role="button">neuer Kurs erfassen</a>
        </p>
        <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Kurstitel</th>
                        <th>Durchf&uuml;hrungsort</th>
                        <th>Startdatum</th>
                        <th>Enddatum</th>
                        <th>Type</th>
                        <th>Studiengang</th>
                        <th>Fachbereich</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'database.php';
                    $pdo = Database::connect();
                    $sql = 'SELECT * FROM studiengang ORDER BY id DESC';
                    // PDO-Query (kein Prepared Statement)
                    foreach ($pdo->query($sql) as $row) {
                        echo '<tr>';
                        echo '<td>' . $row['name'] . '</td>';
                        echo '<td>' . $row['location'] . '</td>';
                        echo '<td>' . $row['start'] . '</td>';
                        echo '<td>' . $row['end'] . '</td>';
                        echo '<td>' . $row['type'] . '</td>';
                        echo '<td>' . $row['studiengang'] . '</td>';
                        echo '<td>' . $row['fachbereich'] . '</td>';
                        echo '<td width=250>';
                        echo '<a class="btn" href="course/read.php?id=' . $row['id'] . '">Read</a>';
                        echo '&nbsp;';
                        echo '<a class="btn btn-success" href="course/update.php?id=' . $row['id'] . '">Update</a>';
                        echo '&nbsp;';
                        echo '<a class="btn btn-danger" href="course/delete.php?id=' . $row['id'] . '">Delete</a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    Database::disconnect();
                    ?>
                </tbody>
            </table>
    </div>
<?php
    include ("login/login_error.php");
    include ("Layout/sidebar.html");
    include ("Layout/ads.html");
    include ("Layout/footer.html");
?>
</html>

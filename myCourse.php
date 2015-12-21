<?php
session_start();
include("login/login_pruefen_fh.inc.php");
include("login/header.php");
?>
<!-- Main content -->
<div class = "col-md-10" id="mainBody">
    <!-- alert window for course edit messages-->
    <?php include("alerts/course_alert.php"); ?>
    <h1>Meine Kursliste</h1>
    <p>
        <a href="create_course.php" class="btn btn-success" role="button">Neuen Kurs erfassen</a>
        <a href="buyCourse.php?id=$id" class="btn btn-success" role="button">Kurse kaufen</a>
    </p>
    <table class="table table-striped table-bordered sortable">
        <thead>
            <tr>
                <th>Kurstitel</th>
                <th>Durchf&uuml;hrungsort</th>
                <th>Startdatum</th>
                <th>Enddatum</th>
                <th>Typ</th>
                <th>Studium und Weiterbildung</th>
                <th>Fachbereich</th>
                <th class="sorttable_nosort">Bearbeiten</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'database.php';
            $pdo = Database::connect();
            $sql = 'SELECT * FROM studiengang ORDER BY id DESC';
            
            // damit ä,ö,ü und é richtig dargestellt werden! --> auf utf8 stellen
            $pdo->exec('set names utf8');
            
            // PDO-Query (kein Prepared Statement)
            foreach ($pdo->query($sql) as $row) {
                echo '<tr>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['location'] . '</td>';
                echo '<td>' . $row['start'] . '</td>';
                echo '<td>' . $row['end'] . '</td>';
                echo '<td>' . $row['type'] . '</td>';
                echo '<td>' . $row['degreeprogram'] . '</td>';
                echo '<td>' . $row['category'] . '</td>';
                echo '<td width=250>';
                echo '<a class="btn btn-default" href="read_course.php?id=' . $row['id'] . '">Anzeigen</a>';
                echo '&nbsp;';
                echo '<a class="btn btn-success" href="update_course.php?id=' . $row['id'] . '">Aktualisieren</a>';
                echo '&nbsp;';
                echo '<a class="btn btn-danger" href="delete_course.php?id=' . $row['id'] . '">Löschen</a>';
                echo '</td>';
                echo '</tr>';
            }
            Database::disconnect();
            ?>
        </tbody>
    </table>
</div>
<?php
include ("login/login_alert.php");
include ("Layout/footer.html");
?>
</html>

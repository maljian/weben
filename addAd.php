<?php
session_start();
include("login/login_pruefen_fh.inc.php");
include("login/header.php");
?>
<!-- Main content -->
<div class = "col-md-10" id="mainBody">
    <h1>Werbeanfragen</h1>
    
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Anrede</th>
                <th>Vorname</th>
                <th>Name</th>
                <th>Email</th>
                <th>Startdatum</th>
                <th>Dauer</th>
                <th>Bearbeiten</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'database.php';
                    $pdo = Database::connect();
                    $sql = 'SELECT * FROM ads ORDER BY id DESC';
                    
            // damit ä,ö,ü und é richtig dargestellt werden! --> auf utf8 stellen
            $pdo->exec('set names utf8');
            
           // PDO-Query (kein Prepared Statement)
                    foreach ($pdo->query($sql) as $row) {
                echo '<tr>';
                echo '<td>' . $row['gender'] . '</td>';
                echo '<td>' . $row['firstname'] . '</td>';
                echo '<td>' . $row['lastname'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td>' . $row['start'] . '</td>';
                echo '<td>' . $row['duration'] . '</td>';
                echo '<td width=250>';
                echo '<a class="btn btn-default btn-success" href="pdf/einzahlungsschein.php?id=' . $row['id'] . '">Bestätigen</a> ';
                echo '<a class="btn btn-default btn-danger" href="advertisment/delete.php?id=' . $row['id'] . '">Löschen</a>';
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
//include ("Layout/login.html");
include ("Layout/footer.html");
?>
</html>
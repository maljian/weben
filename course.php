<?php
session_start();
include("login/header.php");
?>
<!-- Main content -->
<div class="col-md-7" id="mainBody">
    <h1>Angebotene Kurse</h1>
    </br>
    <table class="table table-striped table- sortable">
        <thead>
            <tr>
                <th>Kurstitel</th>
                <th>Studienform</th>
                <th>Startdatum</th>
                <th>Enddatum</th>
                <th>Fachhochschule</th>
                <th>Ort</th>
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
                echo '<td>' .'<a href=userRead.php?id='.$row['id'].'>'. $row['name'].'</a>' . '</td>';
                echo '<td>' . $row['type'] . '</td>';
                echo '<td>' . $row['start'] . '</td>';
                echo '<td>' . $row['end'] . '</td>';
                echo '<td>' .'<a href=fhprofilRead.php?id='.$row['id'].'>'. $row['fh'] .'</a>' . '</td>';
                echo '<td>' . $row['location'] . '</td>';
                echo '</td>';
                echo '</tr>';
            }
            Database::disconnect();
            ?> 
        </tbody>
    </table>
</div>
<?php
include("login/login_alert.php");
include ("Layout/login.html");
include ("Layout/ads.html");
include ("Layout/footer.html");
?>
</html>

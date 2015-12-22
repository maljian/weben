<?php
    session_start();
    include("login/header.php");
    include("login/login_pruefen_admin.inc.php");
    include 'database.php';
?>
    <!-- Main content -->
    <div class = "col-md-7" id="mainBody">
    <?php include("alerts/fh_overview_alert.php"); ?>
    <h1>FH Übersicht</h1>
    </br>
    <table class="table table-striped table- sortable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Stadt</th>
                <th>Website</th>
                <th>Kontakt</th>
                <th>Email</th>
                <th class="sorttable_nosort">Bearbeiten</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $pdo = Database::connect();
            $sql = 'SELECT * FROM fh';
            // damit ä,ö,ü und é richtig dargestellt werden! --> auf utf8 stellen
            $pdo->exec('set names utf8');
            
           // PDO-Query (kein Prepared Statement)
                    foreach ($pdo->query($sql) as $row) {
                echo '<tr>';
                echo '<td>'. $row['institution'].'</td>';
                echo '<td>' . $row['city'] . '</td>';
                echo '<td>' . $row['website'] . '</td>';
                echo '<td>' . $row['partner'] . '</td>';
                echo '<td>'. $row['email'] . '</td>';
                echo '<td width=250>';
                echo '<a class="btn btn-default btn-danger" href="delete_fh.php?email=' . $row['email'] . '">Löschen</a>';
                echo '</td>';
                echo '</tr>';
            }
            Database::disconnect();
            ?> 
        </tbody>
    </table>
    
    <?php
        include ("login/login_alert.php");
        include ("Layout/footer.html");
    ?>
</html>

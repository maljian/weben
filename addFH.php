<?php
    session_start();
    include("login/login_pruefen_admin.inc.php");
    include("login/header.php");
?>

<!-- Main content -->
<div class = "col-md-7" id="mainBody">
    <h1>FH Anmeldungen</h1>
    <p><a href="denied_fh.php">Abgelehnte FHs</a></p>
        <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Institution</th>
                <th>Ansprechpartner</th>
                <th>Strasse</th>
                <th>PLZ</th>
                <th>Ort</th>
                <th>Webseite</th>
                <th>Email</th>
                <th>Telefonnummer</th>
                <th>Anmeldedatum</th>
                <th>Bearbeiten</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'database.php';
                    $pdo = Database::connect();
                    $pdo->exec('set names utf8');
                    $sql = 'SELECT * FROM fh_enrolement WHERE `status`="open" ORDER BY date ASC';
                    // PDO-Query (kein Prepared Statement)
                    foreach ($pdo->query($sql) as $row) {
                        echo '<tr>';
                        echo '<td>' . $row['institution'] . '</td>';
                        echo '<td>' . $row['partner'] . '</td>';
                        echo '<td>' . $row['street'] . '</td>';
                        echo '<td>' . $row['postalcode'] . '</td>';
                        echo '<td>' . $row['city'] . '</td>';
                        echo '<td>' . $row['website'] . '</td>';
                        echo '<td>' . $row['email'] . '</td>';
                        echo '<td>' . $row['phonenumber'] . '</td>';
                        echo '<td>' . $row['date'] . '</td>';
                        echo '<td width=250>';
                        echo '<a class="btn btn-default btn-success col-md-12" href="admin/accept_enrolement.php?emailaddress='.$row['email'].'">akzeptieren</a>';
                        echo '<a class="btn btn-default btn-danger col-md-12" href="admin/deny_enrolement.php?emailaddress=' . $row['email'] . '">ablehnen</a>';
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
include ("Layout/login.html");
include ("Layout/footer.html");
?>
</html>

<?php
    session_start();
    include("login/login_pruefen_admin.inc.php");
    include("login/header.php");
?>

<!-- Main content -->
<div class = "col-md-10" id="mainBody">
    <?php include("alerts/addFH_alert.php")?>
    <h1>Abgelehnte FHs</h1>
    <p><a href="addFH.php">Anmeldungsanfragen</a></p>
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
            include 'db.inc.php';
            $link = mysqli_connect("localhost", $benutzer, $passwort) or die("Keine Verbindung zur Datenbank!");
            mysqli_select_db($link, $dbname);

            // damit ä,ö,ü und é richtig dargestellt werden! --> auf utf8 stellen
            mysqli_set_charset($link, 'utf8');
            
            // Quelle: http://www.php-kurs.com/mysql-datenbank-auslesen.htm
            $sql = 'SELECT * FROM fh_enrolement WHERE `status`="denied" ORDER BY date ASC';
            
            $db_erg = mysqli_query($link, $sql);
            if(!$db_erg){
                die('Ungültige Abfrage: ' . mysqli_error());
            }
            
            while ($row=  mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
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
                echo '<td>';
                echo '<a class="btn btn-default btn-success" href="admin/accept_enrolement.php?emailaddress='.$row['email'].'">akzeptieren</a>';
                echo '<a class="btn btn-default btn-danger" href="admin/delete_enrolement.php?emailaddress='.$row['email'].'">löschen</a>';
                echo '</td>';
                echo '</tr>';
            }
                    
            mysqli_free_result($db_erg);
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

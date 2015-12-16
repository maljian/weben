<?php
session_start();
include("login/login_pruefen_fh.inc.php");
include("login/header.php");
?>
<!-- Main content -->
<div class = "col-md-7" id="mainBody">
    <h1>Werbeanfragen</h1>
    <!--
    <p>
        <a href="course/create.php" class="btn btn-success" role="button">neuer Kurs erfassen</a>
    </p> -->
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Anrede</th>
                <th>Vorname</th>
                <th>Name</th>
                <th>Strasse</th>
                <th>PLZ</th>
                <th>Ort</th>
                <th>Email</th>
                <th>Startdatum</th>
                <th>Dauer</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'db.inc.php';
            $link = mysqli_connect("localhost", $benutzer, $passwort) or die("Keine Verbindung zur Datenbank!");
            mysqli_select_db($link, $dbname);

            $sql = 'SELECT * FROM ads ORDER BY id DESC';
            
            $db_erg = mysqli_query($link, $sql);
            if(!$db_erg){
                die('Ungültige Abfrage: ' . mysqli_error());
            }
            
            echo '<table border ="1">';
            while ($row=  mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
                echo '<tr>';
                echo '<td>' . $row['gender'] . '</td>';
                echo '<td>' . $row['firstname'] . '</td>';
                echo '<td>' . $row['lastname'] . '</td>';
                echo '<td>' . $row['street'] . '</td>';
                echo '<td>' . $row['plz'] . '</td>';
                echo '<td>' . $row['city'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td width=250>';
                echo '<a class="btn btn-default" href="course/read.php?id=' . $row['id'] . '">PDF Generieren</a>';
                echo '</td>';
                echo '</tr>';
            }
            echo "</table>";
            
            mysqli_free_result($db_erg);
            ?>
        </tbody>
    </table>
</div>
<?php
include ("login/login_alert.php");
include ("Layout/login.html");
include ("Layout/ads.html");
include ("Layout/footer.html");
?>
</html>

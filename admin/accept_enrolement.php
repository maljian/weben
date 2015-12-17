<?PHP   
        include 'db.inc.php';
        $link = mysqli_connect("localhost", $benutzer, $passwort) or die("Keine Verbindung zur Datenbank!");
        mysqli_select_db($link, $dbname);

        // damit ä,ö,ü und é richtig dargestellt werden! --> auf utf8 stellen
        mysqli_set_charset($link, 'utf8');
            
            // Quelle: http://www.php-kurs.com/mysql-datenbank-auslesen.htm
            $sql = 'SELECT * FROM fh_enrolement WHERE `status`="open" ORDER BY date ASC';
            
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
                echo '<td width=250>';
                echo '<a class="btn btn-default btn-success col-md-12" href="accept_enrolement.php">akzeptieren</a>';
                echo '<a class="btn btn-default btn-danger col-md-12" href="">ablehnen</a>';
                echo '</td>';
                echo '</tr>';
            }
                    
            mysqli_free_result($db_erg);


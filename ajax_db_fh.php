<?php
$q = intval($_GET['q']);
include 'db.inc.php';
$con = mysqli_connect('localhost', $benutzer, $passwort, $dbname);
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con, "ajax_demo");
$sql = "SELECT * FROM fh WHERE region = '" . $q . "'";
$result = mysqli_query($con, $sql);

echo "<table>
                <tr>
                <th>Name</th>
                <th>Stadt</th>
                <th>Website</th>
                <th>Kontkat</th>
                <th>Email</th>
                </tr>";
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['instituion'] . "</td>";
    echo "<td>" . $row['city'] . "</td>";
    echo "<td>" . $row['website'] . "</td>";
    echo "<td>" . $row['partner'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
<!--?php
    header("Content-Type: text/html; charset=utf-8");
   
    include 'db.inc.php';
    $link = mysqli_connect("localhost", $benutzer, $passwort) or die("Keine Verbindung zur Datenbank!");
            mysqli_select_db($link, $dbname) or die("Datenbank nicht gefunden!". mysql_error());
    $query = "SELECT * from fh where email = " . $_POST["inst"];
    $res = mysqli_query($link, $query);
    $dsatz = mysqli_fetch_assoc($res);
    
    echo "<?xml version='1.0' encoding='utf-8'?>\n";
    echo "<daten>\n";
    echo "<pa>" . $dsatz["partner"] . "</pa>\n";
    echo "<em>" . $dsatz["email"] . "</em>\n";
    echo "</daten>\n";
    
?>-->
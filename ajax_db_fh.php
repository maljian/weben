<?php
$q = $_GET['q'];
include 'db.inc.php';
$con = mysqli_connect('localhost', $benutzer, $passwort, $dbname);
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
mysqli_set_charset($con, 'utf8');
//mysqli_select_db($con, "ajax_demo");
$sql = "SELECT * FROM `fh` WHERE `region` = '" . $q . "'";
$result = mysqli_query($con, $sql);

echo "<table class='table table-striped table-bordered'>
                <thead>
                <tr>
                <th>Name</th>
                <th>Stadt</th>
                <th>Website</th>
                <th>Kontakt</th>
                <th>Email</th>
                </tr>
                </thread><tbody>";
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['institution'] . "</td>";
    echo "<td>" . $row['city'] . "</td>";
    echo "<td>" . $row['website'] . "</td>";
    echo "<td>" . $row['partner'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "</tr>";
}
echo "</tbody></table>";
mysqli_close($con);
?>
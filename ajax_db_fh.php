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
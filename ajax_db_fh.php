<?php
$reg = $_GET['reg'];
$fach = $_GET['fach'];
include 'db.inc.php';
$con = mysqli_connect('localhost', $benutzer, $passwort, $dbname);
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$sql = "SELECT * FROM `fh` WHERE `region` = '" . $reg . "' and `college`= '" . $fach ."'";
$result = mysqli_query($con, $sql);

echo "<table class='table table-striped table-bordered'>
                <thead>
                <tr>
                <th>Name</th>
                <th>Stadt</th>
                <th>Website</th>
                <th>Kontkat</th>
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
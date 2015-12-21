<?php
$q = $_GET['q'];
$q2 = $_GET['q2'];
include 'db.inc.php';
$con = mysqli_connect('localhost', $benutzer, $passwort, $dbname);
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
mysqli_set_charset($con, 'utf8');
//mysqli_select_db($con, "ajax_demo");
$sql = "SELECT * FROM `studiengang` WHERE `category` = '" . $q . "' and `degreeprogram` = '".$q2."'";
$result = mysqli_query($con, $sql);

echo "<table class='table table-striped table-bordered'>
                <thead>
                <tr>
                <th>Name</th>
                <th>FH</th>
                <th>Ort</th>
                <th>Start-Datum</th>
                <th>End-Datum</th>
                <th>Studiumsform</th>
                <th>Kosten</th>
                </tr>
                </thread><tbody>";
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['fh'] . "</td>";
    echo "<td>".$row['location']."</td>";
    echo "<td>" . $row['start'] . "</td>";
    echo "<td>" . $row['end'] . "</td>";
    echo "<td>" . $row['type'] . "</td>";
    echo "<td>" . $row['cost'] . "</td>";
    echo "</tr>";
}
echo "</tbody></table>";
mysqli_close($con);
?>
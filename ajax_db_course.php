<?php
$reg = $_GET['reg'];
$col = $_GET['col'];
$deg = $_GET['deg'];
include 'db.inc.php';
$con = mysqli_connect('localhost', $benutzer, $passwort, $dbname);
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
mysqli_set_charset($con, 'utf8');
//mysqli_select_db($con, "ajax_demo");

$sql1 = "SELECT institution FROM `fh` WHERE `region` = '" . $reg . "'";
$res = mysqli_query($con, $sql1);
$i = 0;
while($regi = mysqli_fetch_array($res)){
    $region[$i] = "'". $regi['institution']."'";
    $i++;
}
$result = null;
//$sql = "SELECT * FROM `studiengang` WHERE `category` = '" . $q . "' and `degreeprogram` = '".$q2."' `region` IN (" . implode(',', $reg) . ")";
if(($col != '0') && ($deg !='0')){
    $sql = "SELECT * FROM `studiengang` WHERE `category` = '" . $col . "' and `degreeprogram` = '".$deg."'";
    $result = mysqli_query($con, $sql);
}else if(($col == '0') && ($deg !='0')){
    $sql = "SELECT * FROM `studiengang` WHERE `degreeprogram` = '".$deg."'";
    $result = mysqli_query($con, $sql);
}else if (($col != '0') && ($deg =='0')){
    $sql = "SELECT * FROM `studiengang` WHERE `category` = '" . $col . "'";
    $result = mysqli_query($con, $sql);
}else{
    $sql = "SELECT * FROM `studiengang`";
    $result = mysqli_query($con, $sql);
}

echo "<table class='table table-striped table-bordered'>
                <thead>
                <tr>
                <th>Name</th>
                <th>FH</th>
                <th>Ort</th>
                <th>Start-Datum</th>
                <th>End-Datum</th>
                <th>Studiumsform</th>
                <th>Kosten in CHF</th>
                </tr>
                </thread><tbody>";
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" .'<a href=userRead.php?id='.$row['id'].'>'. $row['name'].'</a>' . "</td>";
    echo "<td>" .'<a href=fhprofilRead.php?id='.$row['id'].'>'. $row['fh'] .'</a>' . "</td>";
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

<?php
session_start();
include("login/header.php");
include("login/login_pruefen_fh.inc.php");

require 'database.php';
$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (null != $id) {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM studiengang where id = ?";

    // damit ä,ö,ü und é richtig dargestellt werden! --> auf utf8 stellen
    $pdo->exec('set names utf8');

    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    // PDO Fetch-Modi
    // PDO::FETCH_BOTH : holt ein assoziatives und ein numerisches Array (ist default)
    // PDO::FETCH_ASSOC : holt nur ein assoziatives Array, Indizes sind Spaltennamen
    // PDO::FETCH_OBJ : holt ein Objekt, Properties sind gleich Spaltennamen
    // PDO::FETCH_INTO : zieht das Result in eine Objektinstanz der Klasse Customer
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
}
?>
<!-- Main content -->
<div class = "col-md-7" id="mainBody">
    <h2>Kurs ansehen</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped" style="width: 80%">
            <tbody>
                <tr>
                    <th style="width: 20%">Kurstitel: </th>
                    <td><?php echo $data['name']; ?></td>
                </tr>
                <tr>
                    <th>Fachbereich: </th>
                    <td><?php echo $data['category']; ?></td>
                </tr>
                <tr>
                    <th>Studiengang: </th>
                    <td><?php echo $data['degreeprogram']; ?></td>
                </tr>
                <tr>
                    <th>Studientyp: </th>
                    <td><?php echo $data['type']; ?></td>
                </tr>
                <tr>
                    <th>Durchführungsort: </th>
                    <td><?php echo $data['location']; ?></td>
                </tr>
                <tr>
                    <th>Durchführungszeit: </th>
                    <td><?php echo $data['start']; ?> bis <?php echo $data['end']; ?></td>
                </tr>
                <tr>
                    <th>Kosten in CHF: </th>
                    <td><?php echo $data['cost']; ?></td>
                </tr>
                <tr>
                    <th>Kontakt E-Mail: </th>
                    <td><?php echo $data['contact_email']; ?></td>
                </tr>
                <tr>
                    <th>Beschreibung: </th>
                    <td><?php echo $data['text']; ?></td>
                </tr>
                <tr>
                    <th>Resultat: </th>
                    <td><?php echo $data['result']; ?></td>
                </tr>
            </tbody>
        </table>
        <div class="form-actions">
                <a class="btn btn-default" href="myCourse.php">Zurück</a>
            </div>
    </div>
</div>
<?php
include ("login/login_alert.php");
include ("Layout/login.html");
include ("Layout/footer.html");
?>
</html>
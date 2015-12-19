<?php
    session_start();
    include("../login/header1.php");
    include("../login/login_pruefen_fh1.inc.php");

    require '../database.php';
    $id = null;
    if (!empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }

    if (null != $id) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM studiengang where id = ?";
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
            <table>
                <tbody>
                    <tr>
                        <th>Kurstitel:</th>
                        <td><?php echo $data['name']; ?></td>
                    </tr>
                    <tr>
                        <th>Fachbereich:</th>
                        <td><?php echo $data['category']; ?></td>
                    </tr>
                    <tr>
                        <th>Studiengang:</th>
                        <td><?php echo $data['degreeprogram']; ?></td>
                    </tr>
                    <tr>
                        <th>Studientyp:</th>
                        <td><?php echo $data['type']; ?></td>
                    </tr>
                    <tr>
                        <th>Durchf&uuml;rungsort:</th>
                        <td><?php echo $data['location']; ?></td>
                    </tr>
                    <tr>
                        <th>Durchf&uuml;rungszeit:</th>
                        <td><?php echo $data['start']; ?> bis <?php echo $data['end']; ?></td>
                    </tr>
                    <tr>
                        <th>Kosten:</th>
                        <td><?php echo $data['cost']; ?></td>
                    </tr>
                    <tr>
                        <th>Kontakt E-Mail:</th>
                        <td><?php echo $data['contact_email']; ?></td>
                    </tr>
                    <tr>
                        <th>Beschreibung:</th>
                        <td><?php echo $data['text']; ?></td>
                    </tr>
                    <tr>
                        <th>Resultat:</th>
                        <td><?php echo $data['result']; ?></td>
                    </tr>
                    <tr>
                        <th>
                            <div class="form-actions">
                                <a class="btn btn-default" href="../myCourse.php">Back</a>
                            </div>
                        </th>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
<?php
        include ("../login/login_alert.php");
        include ("../Layout/login.html");
        include ("../Layout/ads.html");
        include ("../Layout/footer.html");
    ?>
</html>
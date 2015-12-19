<?php
    session_start();
    include("login/login_pruefen_fh.inc.php");
    include("login/header.php");
    $email = $_SESSION['email'];
            
    include 'database.php';
    if ( !empty($_GET['email'])) {
            $email = $_REQUEST['email'];
    }
    
    $pdo = Database::connect();
    $sql = 'SELECT * FROM fh where email = ?';
    $q = $pdo->prepare($sql);
    $q->execute(array($email));
    // PDO Fetch-Modi
    // PDO::FETCH_BOTH : holt ein assoziatives und ein numerisches Array (ist default)
    // PDO::FETCH_ASSOC : holt nur ein assoziatives Array, Indizes sind Spaltennamen
    // PDO::FETCH_OBJ : holt ein Objekt, Properties sind gleich Spaltennamen
    // PDO::FETCH_INTO : zieht das Result in eine Objektinstanz der Klasse Customer
    $data = $q->fetch(PDO::FETCH_ASSOC);

    Database::disconnect();
?>
    <!-- Main content -->
    <div class = "col-md-7" id="mainBody">
        <h1>Mein FH Profil</h1>
        <p>
            <a href="fhInfo_update.php?email=$email" class="btn btn-success" role="button">Infos bearbeiten</a>
        </p>
        <div class="table-responsive">
            <table>
                <tbody>
                    <tr>
                        <th>Name:</th>
                        <td><?php echo $data['institution']; ?></td>
                    </tr>
                    <tr>
                        <th>Standort(e):</th>
                        <td><?php echo $data['site']; ?></td>
                    </tr>
                    <tr>
                        <th>Link:</th>
                        <td><?php echo $data['website']; ?></td>
                    </tr>
                    <tr>
                        <th>Kontaktdaten:</th>
                        <td><?php echo $data['partner']; ?>
                        <br/><?php echo $data['tel']; ?></td>
                        <br/><?php echo $data['email']; ?></td>
                    </tr>
                    <tr>
                        <th>Fachbereiche:</th>
                        <td><?php echo $data['college']; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
<?php
    include ("login/login_alert.php");
    include ("Layout/login.html");
    include ("Layout/ads.html");
    include ("Layout/footer.html");
?>
</html>

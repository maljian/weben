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
    $pdo->exec('set names utf8');
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
        <?php include("success_reset.php"); ?>
        <p>
            <a href="fhInfo_update.php?email=" class="btn btn-success" role="button">Infos bearbeiten</a>
        </p>
        <div class="col-sm-5 table-responsive">
            <table>
                <tbody>
                    <tr>
                        <th valign=top>Name:</th>
                        <td><?php echo $data['institution']; ?></td>
                    </tr>
                    <tr>
                        <th valign=top>Standort(e):</th>
                        <td><?php echo $data['site']; ?></td>
                    </tr>
                    <tr>
                        <th valign=top>Link:</th>
                        <td><?php echo $data['website']; ?></td>
                    </tr>
                    <tr>
                        <th valign=top>Kontaktdaten:</th>
                        <td><?php echo $data['partner']; ?> </td>
                    </tr>
                    <tr>
                        <th valign=top></th>
                        <td><?php echo $data['phonenumber']; ?> </td>
                    </tr>
                    <tr>
                        <th valign=top></th>
                        <td><?php echo $data['email']; ?></td>
                    </tr>
                    <tr>
                        <th valign=top>Fachbereiche:</th>
                        <td><?php echo $data['college']; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p><a href="reset.php">Passwort ändern</a></p>
    </div>
<?php
    include ("login/login_alert.php");
    include ("Layout/login.html");
    include ("Layout/ads.html");
    include ("Layout/footer.html");
?>
</html>

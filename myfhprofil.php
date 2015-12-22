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
    
    $sql= "SELECT * FROM user WHERE Email = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($email));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $boughtCourses = $data['boughtCourses'];
    
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
        <?php include("alerts/reset_fhinfo_alert.php"); ?>
        <h1>Mein FH Profil</h1>
     <div class="col-sm-12 table-responsive">
            <table class="table table-bordered table-striped" style="width:80%">
                <p>
            <a href="fhInfo_update.php?email=" class="btn btn-success" role="button">Infos bearbeiten</a>
            <a href="reset.php" class="btn btn-success" role="button">Passwort ändern</a>
        </p>
        <br/>
                <tbody>
                    <tr>
                        <th style="width:20%">Name:</th>
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
                        <td><?php echo $data['partner']; ?> </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td><?php echo $data['phonenumber']; ?> </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td><?php echo $data['email']; ?></td>
                    </tr>
                    <tr>
                        <th>Fachbereiche:</th>
                        <td><?php echo $data['college']; ?></td>
                    </tr>
                    <tr>
                        <th>Anzahl gekaufte Kurse:</th>
                        <td><?php echo $boughtCourses; ?></td>
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

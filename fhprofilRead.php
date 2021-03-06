<?php
session_start();
include("login/header.php");

require 'database.php';
$email = 0;
if (!empty($_GET['email'])) {
    $email = $_REQUEST['email'];
}

if (null != $email) {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('set names utf8');

    $sql = 'SELECT * FROM fh where email = ?';
    $q = $pdo->prepare($sql);
    $q->execute(array($email));
    $data = $q->fetch(PDO::FETCH_ASSOC);

    Database::disconnect();
}
?>
<!-- Main content -->
<div class = "col-md-7" id="mainBody">
    <h1><?php echo $data['institution']; ?></h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped" style="width:80%">
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
                    <th>Kontaktperson:</th>
                    <td><?php echo $data['partner']; ?> </td>
                </tr>
                <tr>
                    <th>Telefonnummer:</th>
                    <td><?php echo $data['phonenumber']; ?> </td>
                </tr>
                <tr>
                    <th>Emailadresse</th>
                    <td><?php echo $data['email']; ?></td>
                </tr>
                <tr>
                    <th>Fachbereiche:</th>
                    <td><?php echo $data['college']; ?></td>
                </tr>
            </tbody>
        </table>
        <div class="form-actions">
                <a class="btn btn-default" href="index.php">Zurück</a>
            </div>
    </div>
</div>
<?php
include ("login/login_alert.php");
include ("Layout/login.html");
include ("Layout/ads.html");
include ("Layout/footer.html");
?>
</html>

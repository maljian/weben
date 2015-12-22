<?php
    session_start();
    
    require 'database.php';
    $id = 0;

    if (!empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }

    if (!empty($_POST)) {
        // keep track post values
        $id = $_POST['id'];

        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM ads  WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Database::disconnect();
        $_SESSION['deleteAdMessage']='successful';
        header("Location: addAd.php");
    }

    include ("login/header.php");
    include("login/login_pruefen_admin.inc.php");
?>
    <!-- Main content -->
    <div class = "col-md-7" id="mainBody">
        <h3>Werbeanfrage löschen</h3>
        <form class="form-horizontal" action="delete_ad.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            <p class="alert alert-error">Möchten Sie die Werbeanfrage löschen?</p>
            <div class="form-actions">
                <button type="submit" class="btn btn-danger">Ja</button>
                <a class="btn btn-default" href="addAd.php">Nein</a>
            </div>
        </form>
    </div>
    <?php
        include ("login/login_error.php");
        include ("Layout/footer.html");
    ?>
</html>
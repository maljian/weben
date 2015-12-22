<?php
    session_start();
    
    require 'database.php';
    $email = 0;

    if (!empty($_GET['email'])) {
        $email = $_REQUEST['email'];
    }

    if (!empty($_POST)) {
        // keep track post values
        $email = $_POST['email'];

        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'DELETE FROM fh WHERE email= ?';
        $q = $pdo->prepare($sql);
        $q->execute(array($email));
        Database::disconnect();
        $_SESSION['deleteFHMessage']='successful';
        header("Location: fh_overview.php");
    }

    include ("login/header.php");
    include("login/login_pruefen_admin.inc.php");
?>
    <!-- Main content -->
    <div class = "col-md-7" id="mainBody">
        <h3>Fachhochschule löschen</h3>
        <form class="form-horizontal" action="delete_fh.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            <p class="alert alert-error">Möchten Sie die FH wirklich löschen?</p>
            <div class="form-actions">
                <button type="submit" class="btn btn-danger">Ja</button>
                <a class="btn btn-default" href="fh_overview.php">Nein</a>
            </div>
        </form>
    </div>
    <?php
        include ("login/login_error.php");
        include ("Layout/footer.html");
    ?>
</html>
<?php
    require '../database.php';
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
        $sql = "DELETE FROM studiengang  WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Database::disconnect();
        header("Location: ../myCourse.php");
    }
    session_start();
    include ("../Layout/header.html");
    include "../db.inc.php";
    if (isset($_SESSION['eingeloggt'])){
     if($_SESSION['eingeloggt']==true){
            include ("../Layout/nav-loggedin.html");
        }
    }
    else{
        include ("../Layout/nav.html");
    }
?>
    <!-- Main content -->
    <div class = "col-md-7" id="mainBody">
        <h3>Kurslöschen</h3>
        <form class="form-horizontal" action="delete.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            <p class="alert alert-error">Möchten Sie wirklich den Kurs löschen ?</p>
            <div class="form-actions">
                <button type="submit" class="btn btn-danger">Yes</button>
                <a class="btn" href="../myCourse.php">No</a>
            </div>
        </form>
    </div>
    <?php
        include ("../login/login_error.php");
        include ("../Layout/sidebar.html");
        include ("../Layout/ads.html");
        include ("../Layout/footer.html");
    ?>
</html>
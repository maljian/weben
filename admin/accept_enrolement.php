<?PHP 
    require '../database.php';
    $emailaddress = 0;

    if (!empty($_GET['emailaddress'])) {
        $id = $_REQUEST['emailaddress'];
    }

    if (!empty($_POST)) {
        // keep track post values
        $emailaddress = $_POST['emailadress'];
        
        //add FH to db fh
        
        
        //generate password and add to db user
        
        
        //write email to FH
        
        
        // delete data from db fh_enrolement
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM fh_enrolement  WHERE email = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($emailaddress));
        Database::disconnect();
        header("Location: ../addFH.php");
    }
    
?>


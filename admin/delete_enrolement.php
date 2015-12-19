<?PHP 
    require '../database.php';
    $emailaddress = 0;
    if (!empty($_GET['emailaddress'])) {
        $emailaddress = $_REQUEST['emailaddress'];
   
        $pdo = Database::connect();
        $pdo->exec('set names utf8');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // delete data from db fh_enrolement
        $sql = "DELETE FROM fh_enrolement  WHERE email = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($emailaddress));
        Database::disconnect();
        header("Location: ../addFH.php");
    }    
?>
<?PHP 
    require '../database.php';
    $emailaddress = 0;

    if (!empty($_GET['emailaddress'])) {
        $emailaddress = $_REQUEST['emailaddress'];
   
        $pdo = Database::connect();
        $pdo->exec('set names utf8');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //add FH to db fh
        $sql= "SELECT * FROM fh_enrolement WHERE `email`='$emailaddress'";
                    // PDO-Query (kein Prepared Statement)
                    foreach ($pdo->query($sql) as $row) {                       
                        $institution = $row['institution'];
                        $partner = $row['partner'];
                        $street = $row['street'];
                        $postalcode = $row['postalcode'];
                        $city = $row['city'];
                        $website = $row['website'];
                        $email = $row['email'];
                        $phonenumber = $row['phonenumber'];
            }
        $sql = "INSERT INTO fh(`institution`,`partner`,street,`postalcode`,`city`,`website`,`email`,`phonenumber`) VALUES (?,?,?,?,?,?,?,?)";    
        $q = $pdo->prepare($sql);
        $q->execute(array("$institution","$partner","$street","$postalcode","$city","$website","$email","$phonenumber"));
        
        //generate password and add to db user
        $chars = ("abcdefghijklmnopqrstuvwxyz1234567890"); 
        $newpwd = ''; 
        for ($i = 0; $i < 8; $i++) 
        { 
            $newpwd .= $chars{mt_rand (0,strlen($chars))}; 
        } 
        $newpassword = $newpwd;
        $pass = md5($newpassword);
        $type = "fh";
        
        $sql = "INSERT INTO user(`Name`,`Email`,`Passwort`,`Type`) VALUES (?,?,?,?)";    
        $q = $pdo->prepare($sql);
        $q->execute(array("$institution","$email","$pass","$type"));
        
        //write email to FH
        
        
        // delete data from db fh_enrolement
        $sql = "DELETE FROM fh_enrolement  WHERE email = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($emailaddress));
        Database::disconnect();
        header("Location: ../addFH.php");
    }
    
?>
<?php
    session_start();
    require '../database.php';
    if(isset($_POST)){
       $oldPwd = $_POST['oldPwd'];
       $newPwd = $_POST['newPwd'];
       $confirmPwd = $_POST['confirmPwd'];
       $email = $_SESSION['email'];
       
       if(strlen($newPwd)>=8){
            $pdo = Database::connect();
            $pdo->exec('set names utf8');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //check if old password is correct
            $sql= "SELECT * FROM user WHERE Email = '$email'";
            $q = $pdo->prepare($sql);
            $q->execute(array($email));
            $data = $q->fetch(PDO::FETCH_ASSOC);
            $resultPW = $data['Passwort'];
            $oldPwd = md5($oldPwd);
            
            if($resultPW == $oldPwd){
                $sql= "SELECT * FROM user WHERE Email = '$email'";
                $resultUser = $pdo->prepare($sql);
                $resultUser->execute();  
                    //check if new password matches confirm password and update DB 
                    if($newPwd==$confirmPwd){
                        $newPwd = md5($newPwd);
                        $sql = "UPDATE user SET Passwort='$newPwd' WHERE Email='$email'";
                        $q = $pdo->prepare($sql);
                        $q->execute();
                        Database::disconnect();
                        
                        $_SESSION['resetMessage']= 'successful';
                        header("Location: ../myfhprofil.php");
                    }
             }
             else {
                 $_SESSION['resetMessage']= 'wrong password';
                 header("Location: ../reset.php");
             }
        } 
        else {
            $_SESSION['resetMessage'] = 'too short';
            header("Location: ../reset.php");
        }
    }
    else {
    $_SESSION['resetMessage']= 'failed';
    header("Location: ../reset.php");   
    }    
?>


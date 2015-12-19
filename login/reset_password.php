<?php
    session_start();
    require '../database.php';
    if(isset($_POST)){
       $oldPwd = $_POST['oldPwd'];
       $newPwd = $_POST['newPwd'];
       $confirmPwd = $_POST['confirmPwd'];
       $email = $_SESSION['email'];
       
       $pdo = Database::connect();
           $pdo->exec('set names utf8');
           $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       //check if old password is correct
       $sql= "SELECT * FROM user WHERE `email` = '$email'";
       $resultUser = $pdo->prepare($sql);
       echo "$sql";
       if($resultUser->rowCount()==TRUE) {   
            //check if new password matches confirm password and update DB 
            if($newPwd==$confirmPwd){
                $newPwd = md5($newPwd);
                $sql = "UPDATE user SET Passwort='$newPwd' WHERE Email='$email'";
                $q = $pdo->prepare($sql);
                $q->execute();
                Database::disconnect();
                //header("Location: ../myfhprofil.php");
            }
       }
       //header("Location: ../reset.php");
    }
    else {
    //header("Location: ../reset.php");   
    }    
?>


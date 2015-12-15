<?php
        include ("login/login_error.php");
        include ("Layout/header.html");
        include "db.inc.php";
        if (isset($_SESSION['loggedin'])){
         if($_SESSION['loggedin']==true AND $_SESSION['type']=="fh"){
              include ("Layout/nav-loggedin_fh.html");
         }
         else if($_SESSION['loggedin']==true AND $_SESSION['type']=="admin"){
             include("Layout/nav-loggedin_admin.html");
         }    
         else{
             include ("Layout/nav.html");  
            }
        }
        else{
            include ("Layout/nav.html");
        }
        
?>        

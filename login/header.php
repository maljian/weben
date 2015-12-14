<?php
        session_start();
        include ("Layout/header.html");
        include "db.inc.php";
        if (isset($_SESSION['loggedin'])){
         if($_SESSION['loggedin']==true){
              include ("Layout/nav-loggedin_fh.html");
            }
         else{
             include ("Layout/nav.html");  
            }
        }
        else{
            include ("Layout/nav.html");
        }
        
?>        

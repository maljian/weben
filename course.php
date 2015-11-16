<?php
    session_start();
    include ("Layout/header.html");?>
        <!-- Main content -->
        <div class = "col-md-7" id="mainBody">
            <h1>Kurs</h1>
        </div>
    <?php
    
    include "db.inc.php";
    if (isset($_SESSION['eingeloggt'])){
     if($_SESSION['eingeloggt']==true){
          include ("Layout/loginbereich.html"); 
        }
     else{
         include ("Layout/login.html");  
        }
    }
    else{
        include ("Layout/login.html");
    }
    include ("Layout/ads.html");
    include ("Layout/footer.html");?>
</html>

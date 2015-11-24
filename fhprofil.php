    <?php
        session_start();
        include ("Layout/header.html");
        include "db.inc.php";
        if (isset($_SESSION['eingeloggt'])){
         if($_SESSION['eingeloggt']==true){
              include ("Layout/nav-loggedin.html");
            }
         else{
             include ("Layout/nav.html");  
            }
        }
        else{
            include ("Layout/nav.html");
        }
    ?>
    <!-- Main content -->
    <div class = "col-md-7" id="mainBody">
        <h1>FHNW</h1>
    </div>
    <?php
        include ("Layout/sidebar.html");
        include ("Layout/ads.html");
        include ("Layout/footer.html");
    ?>
</html>

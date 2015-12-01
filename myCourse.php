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
            <h1>Meine Kursliste</h1>
            <a href="course_create.php" class="btn btn-default" role="button">neuer Kurs erfassen</a>
        </div>
    <?php
        include ("Layout/sidebar.html");
        include ("Layout/ads.html");
        include ("Layout/footer.html");
    ?>
</html>

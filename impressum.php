<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <?php 
        session_start();
        include ("Layout/header.html");?>
        <!-- Main content -->
        <div class = "col-md-7" id="mainBody">
            <h1>Impressum</h1>
            <br/>
            <p>
                Web-Engineering Projekt<br/>
                S.K&auml;sermann, N.Racine und J.Ruppen <br/>
                BSc Wirtschaftsinformatik (WIVZ 3.51) HS15 <br/>
                FHNW SHochschule f&uuml;r Wirtschaft<br/>
                Riggenbachstrasse 16<br/>
                4600 Olten <br/>
            </p>
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
        }include ("Layout/ads.html");
        include ("Layout/footer.html");
    ?>
</html>

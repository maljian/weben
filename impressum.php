<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <?php
    session_start();
    include ("Layout/header.html");
    include "db.inc.php";
    if (isset($_SESSION['eingeloggt'])) {
        if ($_SESSION['eingeloggt'] == true) {
            include ("Layout/nav-loggedin.html");
        } else {
            include ("Layout/nav.html");
        }
    } else {
        include ("Layout/nav.html");
    }
    ?>

    <!-- Main content -->
    <div class = "col-md-7" id="mainBody">
        <h1>Impressum</h1>
        <br/>
        <p>
            Web-Engineering Projekt<br/>
            S.K&auml;sermann, N.Racine und J.Ruppen <br/>
            BSc Wirtschaftsinformatik (WIVZ 3.51) HS15 <br/>
            FHNW Hochschule f&uuml;r Wirtschaft<br/>
            Riggenbachstrasse 16<br/>
            4600 Olten <br/>
        </p>

        <!-- Kontaktformular für die Webseite -->
        <form class="form-horizontal" role="form">
            <div class="form-group">
                <label class="control-label col-sm-2" for="gender">Anrede:*</label>
                <div class="col-sm-2"> 
                    <select class="form-control text-center" id="gender">
                    <option>Frau</option>
                    <option>Herr</option>
                </select>
                </div>      
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="lastname">Nachname:*</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="lastname" name="lastname" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="firstname">Vorname:*</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="firstname" name="firstname" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Emailadresse:*</label>
                <div class="col-sm-4">
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="phonenumber">Telefonnummer:</label>
                <div class="col-sm-4">
                    <input type="tel" class="form-control" id="phonenumber" name="phonenumber">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="message">Anfrage:*</label>
                <div class="col-sm-6">
                    <textarea class="form-control" rows="10" id="message" name="message" required></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2"></label>
                <div class="col-sm-9">
                    <button type="submit" class="btn btn-default" value="send">Senden</button>
                    <button type="reset" class="btn btn-default" value="reset">Abbrechen</button>
                </div>      
            </div>
        </form>

    </div>

    <?php
    include ("Layout/sidebar.html");
    include ("Layout/ads.html");
    include ("Layout/footer.html");
    ?>
</html>

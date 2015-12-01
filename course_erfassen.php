    <?php
        session_start();
        include ("Layout/header.html");
        include "db.inc.php";
        if (isset($_SESSION['eingeloggt'])){
         if($_SESSION['eingeloggt']==true){
                include ("Layout/nav-loggedin.html");
            }
        }
        else{
            include ("Layout/nav.html");
        }
    ?>
        <!-- Main content -->
        <div class = "col-md-7" id="mainBody">
            <h2>neuer Kurs erfassen</h2>
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4">
                        <label for="name">Kurstitel:</label>
                        <input type="text" class="form-control" id="name">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4">
                        <label for="fachbereich">Fachbereich:</label>
                        <input type="text" class="form-control" id="fachbereich">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4">
                        <label for="studigang">Studiengang:</label>
                        <input type="text" class="form-control" id="studigang">
                    </div>
                </div>               
                <div class="form-group">
                    <div class="radio">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-2">
                            <label><input type="radio" name="studiform" value="presVoll"> Pr&auml;senzstudium Vollzeit</label>
                        </div>
                        <div class="col-sm-2">
                            <label><input type="radio" name="studiform" value="presTeil"> Pr&auml;senzstudium Teilzeit</label>
                        </div>
                        <div class="col-sm-2">
                            <label><input type="radio" name="studiform" value="fernVoll"> Fernstudium Vollzeit</label>
                        </div>
                        <div class="col-sm-2">
                            <label><input type="radio" name="studiform" value="fernTeil"> Fernstudium Teilzeit</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-3">
                        <label for="location">Ort:</label>
                        <input type="text" class="form-control" id="location">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-1"></div>
                    <div class ="col-sm-6">
                        <label for="start">Von:
                            <div class='input-group' id='start'>
                                <input type='text' class="form-control" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </label>
                        <label for="end">bis:
                            <div class='input-group date' id='end'>
                                <input type='text' class="form-control" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </label>
                        <script type="text/javascript">
                            $(function () {
                                $('#start').datetimepicker();
                                $('#end').datetimepicker({
                                    useCurrent: false //Important! See issue #1075
                                });
                                $("#start").on("dp.change", function (e) {
                                    $('#end').data("DateTimePicker").minDate(e.date);
                                });
                                $("#end").on("dp.change", function (e) {
                                    $('#start').data("DateTimePicker").maxDate(e.date);
                                });
                            });
                        </script>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-3">
                        <label for="cost">Kosten:</label>
                        <input type="text" class="form-control" id="cost">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-3">
                        <label for="contact">Kontakt E-Mail:</label>
                        <input type="email" class="form-control" id="contact">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-6">
                        <label for="txt">Beschreibung:</label>
                        <textarea class="form-control" rows="7" id="txt"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-6">
                        <label for="result">Resultat:</label>
                        <textarea class="form-control" rows="7" id="result"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-default">Erfassen</button>
                        <button type="reset" class="btn btn-default">Abbrechen</button>
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

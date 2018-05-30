<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
    integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
    crossorigin="anonymous">
    <script src="http://code.jquery.com/jquery-2.2.3.min.js"
		integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="
		crossorigin="anonymous"></script>
    <title>Etätehtävä 3 - Harjoitus</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Tehtävä 3</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Etusivu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="uusiHarjoitus.php">Uusi harjoitus</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listaa.php">Listaa kaikki</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="haeHarjoitus.php">Hae harjoitus</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="asetukset.php">Asetukset</a>
                </li>
            </ul>
        </div>
    </nav>
    
    &nbsp;
    <div class="container-fluid">
        <h1>Hae harjoitus</h1>
        <form action="haeHarjoitus.php" method="post">
            <div class="form-vertical form-group">
                <label class="control-label col-sm-2">Hae nimellä: </label>
                <div class="form-group col-md-4">
                <input type="text" class="form-control inputstl" name="nimi" id="nimi">
                </div>
                <div class="form-group col-md-4">
                <input type="button" id="hae" name="hae" value="Hae">
                </div>
            </div>
        </form>
        <div id="lista"></div>
    </div>
        <script>
                $(document).on("ready", function() {
                    $("#hae").on("click", function() {
                        $.ajax({
                            url: "harjoitusJSON.php",
                            method: "get",
                            data: {nimi: $("#nimi").val()},
                            dataType: "json",
                            timeout: 5000
                            })
                        .done(function(data) {
                            $("#lista").html("");
                            for(var i=0; i < data.length; i++) {
                                $("#lista").append("<p>Nimi: " + data[i].nimi
                                + "<br>Sukupuoli: "+ data[i].sukupuoli
                                + "<br>Henkilötunnus: " + data[i].hetu
                                + "<br>Päivämäärä: " + data[i].pvm
                                + "<br>Maksukortin tunnus: " + data[i].tunnus
                                + "<br>Osoite: " + data[i].osoite
                                + "<br>Kommentti: " + data[i].kommentti
                                + "</p>");
                                }   
                                if (data.length == 0) {
						            $("#lista").append("<p>Haku ei tuottanut yhtään nimeä</p>")
					            }
				            })
                        .fail(function() {
                            $("#lista").html("<p>Listausta ei voida tehdä</p>");
                        });
                    });
                });
        </script>
        
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
    crossorigin="anonymous"></script>
</body>
</html>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
        crossorigin="anonymous">
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
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Etusivu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="uusiHarjoitus.php">Uusi harjoitus</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listaa.php">Listaa kaikki</a>
                </li>
                <li class="nav-item">
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
        <h1>Etusivu</h1>

    <?php
         if (isset($_COOKIE["kayttaja"]) && isset($_COOKIE["aika"])) {
         print("<p>Tervetuloa " . $_COOKIE["kayttaja"] . "</p>");
        }
    ?>

    </div>

</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
    crossorigin="anonymous"></script>
</body>

</html>
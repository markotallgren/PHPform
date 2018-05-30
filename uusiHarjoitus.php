<?php
require_once "harjoitus.php";
session_start();

if (isset($_POST ["talleta"])) {
  $harjoitus = new Harjoitus( $_POST["nimi"], $_POST["sukupuoli"], $_POST["hetu"], $_POST["pvm"], $_POST["tunnus"], $_POST["osoite"], $_POST["kommentti"]);
  $_SESSION["harjoitus"] = $harjoitus;
  session_write_close();

  $nimiVirhe = $harjoitus->checkNimi();
  $sukupuoliVirhe = $harjoitus->checkSukupuoli();
  $hetuVirhe = $harjoitus->checkHetu();
  $pvmVirhe = $harjoitus->checkPvm();
  $tunnusVirhe = $harjoitus->checkTunnus();
  $osoiteVirhe = $harjoitus->checkOsoite();
  $kommenttiVirhe = $harjoitus->checkKommentti();

  if ($nimiVirhe === 0 && $sukupuoliVirhe === 0 && $hetuVirhe === 0 && $pvmVirhe === 0 && $tunnusVirhe === 0 && $osoiteVirhe === 0 && $kommenttiVirhe === 0) {
    header("location: naytaHarjoitus.php");
    exit();
  }
  try { require_once "harjoitusPDO.php";
    $kantakasittely = new harjoitusPDO();
    $id = $kantakasittely->lisaaHarjoitus($harjoitus);
    } catch (Exception $error) 
    {
    print($error->getMessage());
    }
}
elseif (isset($_POST["peruuta"])) {
  unset($_SESSION["harjoitus"]);
	header("location: index.php");
  exit ();
}
else {

  if (isset($_SESSION["harjoitus"])) {
      $harjoitus = $_SESSION["harjoitus"];
        
      $nimiVirhe = $harjoitus->checkNimi();
      $sukupuoliVirhe = $harjoitus->checkSukupuoli();
      $hetuVirhe = $harjoitus->checkHetu();
      $pvmVirhe = $harjoitus->checkPvm();
      $tunnusVirhe = $harjoitus->checkTunnus();
      $osoiteVirhe = $harjoitus->checkOsoite();
      $kommenttiVirhe = $harjoitus->checkKommentti();
  } 
  else {
    $harjoitus = new Harjoitus();
    $nimiVirhe = 0;
    $sukupuoliVirhe = 0;
    $hetuVirhe = 0;
    $pvmVirhe = 0;
    $tunnusVirhe = 0;
    $osoiteVirhe = 0;
    $kommenttiVirhe = 0;
  }
}

$aika = time();
$pvm = date("j.n.Y", $aika);
?>

  <!doctype html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
      crossorigin="anonymous">
      <link href="harjoitus.css" rel="stylesheet">
    <title>Etätehtävä 3 - Harjoitus</title>
  </head>
  <body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Tehtävä 3</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Etusivu</a>
        </li>
        <li class="nav-item active">
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
  <h1>Uusi harjoitus</h1>
    <form class="form-horizontal" action="uusiHarjoitus.php" method="post">
      <div class="form-group">
        <label class="col-sm-2 control-label">Nimi:</label>
        <div class="col-sm-4">
          <input type="text" class="form-control inputstl" name="nimi" placeholder="Anna nimi"
          value="<?php print(htmlentities($harjoitus->getNimi(), ENT_QUOTES, "UTF-8"))?>">
          <span class="error"><?php print($harjoitus->getError($nimiVirhe)); ?></span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Sukupuoli:</label>
        <div class="col-sm-2">
          <select class="form-control inputstl" name="sukupuoli">
            <option style="display: none" value="">Valitse sukupuoli</option>
            <option value="Mies" <?php if($harjoitus->getSukupuoli() == 'Mies') {echo "selected=selected"; } ?>>Mies</option>
            <option value="Nainen" <?php if($harjoitus->getSukupuoli() == 'Nainen') {echo "selected=selected"; } ?>>Nainen</option>
            <option value="Muu" <?php if($harjoitus->getSukupuoli() == 'Muu') {echo "selected=selected"; } ?>>Muu</option>
          </select>
          <span class="error"><?php print($harjoitus->getError($sukupuoliVirhe)); ?></span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Henkilötunnus:</label>
        <div class="col-sm-4">
          <input type="text" class="form-control inputstl" name="hetu" placeholder="Esim: 131052-308T"
          value="<?php print(htmlentities($harjoitus->getHetu(), ENT_QUOTES, "UTF-8"))?>">
          <span class="error"><?php print($harjoitus->getError($hetuVirhe)); ?></span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Mikä päivä tänään on?</label>
        <div class="col-sm-4">
          <input type="text" class="form-control inputstl" name="pvm" placeholder="pp.kk.yyyy"
          value="<?php print(htmlentities($harjoitus->getPvm(), ENT_QUOTES, "UTF-8"))?>">
          <span class="error"><?php print($harjoitus->getError($pvmVirhe)); ?></span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-4 control-label">Maksukortin tunnus:</label>
        <div class="col-sm-4">
          <input type="text" class="form-control inputstl" name="tunnus" placeholder="xxxx-xxxx-xxxx-xxxx"
          value="<?php print(htmlentities($harjoitus->getTunnus(), ENT_QUOTES, "UTF-8"))?>">
          <span class="error"><?php print($harjoitus->getError($tunnusVirhe)); ?></span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Kotiosoite:</label>
        <div class="col-sm-4">
          <input type="text" class="form-control inputstl" name="osoite" placeholder="Anna kotiosoite"
          value="<?php print(htmlentities($harjoitus->getOsoite(), ENT_QUOTES, "UTF-8"))?>">
          <span class="error"><?php print($harjoitus->getError($osoiteVirhe)); ?></span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Kommentti:</label>
        <div class="col-sm-4">
          <textarea class="form-control inputstl" rows="3" name="kommentti"><?php print(htmlentities($harjoitus->getKommentti(), ENT_QUOTES, "UTF-8"))?></textarea>
          <span class="error"><?php print($harjoitus->getError($kommenttiVirhe)); ?></span>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-6">
          <div class="form-group row">
            <div class="col-md-3">
              <button type="submit" name="talleta" class="btn btn-block">Talleta</button>
            </div>
            <div class="col-md-3">
              <button type="submit" name="peruuta" class="btn btn-block">Peruuta</button>
            </div>
          </div>
        </div>
      </div>
    </form>
</div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
      crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
      crossorigin="anonymous"></script>
  </body>
  </html>
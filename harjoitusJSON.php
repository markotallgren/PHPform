<?php
try {
    require_once "harjoitusPDO.php";
    $kantakasittely = new harjoitusPDO();
    if (isset($_GET["nimi"] )) {
		$tulos = $kantakasittely->etsiHarjoitus($_GET["nimi"]);
		print json_encode($tulos);
	} 	
	else {
		$tulos = $kantakasittely->kaikkiHarjoitukset();
		print json_encode($tulos);
	}
} catch (Exception $error) {
}
?>
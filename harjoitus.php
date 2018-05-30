<?php
class Harjoitus implements JsonSerializable {
    private static $virhelista = array (
        -1 => "Tuntematon virhe",
        0 => "",
        1 => "Kenttä ei voi olla tyhjä",
        2 => "Nimessä voi olla merkkejä enintään 30",
        4 => "Nimessä tulee olla vain kirjaimia",
        5 => "Valitse OIKEA sukupuoli",
        7 => "Sukupuoli täytyy valita",
        8 => "Kentässä ei voi olla kirjaimia",
        9 => "Tunnuksen muoto on virheellinen",
        10 => "Väärin, on tulevaisuudessa",
        11 => "Väärin, on mennyt jo",
        12 => "Päivämäärän muoto on virheellinen",
        13 => "Henkilötunnuksen muoto on virheellinen",
        14 => "Henkilötunnuksen tarkistusmerkki on virheellinen",
        15 => "Kommentin merkkiraja on 200",
        16 => "Osoitteen muoto on virheellinen",
        17 => "Osoitteessa voi olla merkkejä enintään 50",
        18 => "Nimiä on liian monta",
        19 => "Nimen täytyy olla suurempi kuin 1 merkki"
);

public static function getError($virhekoodi) {
    if (isset ( self::$virhelista [$virhekoodi] ))
        return self::$virhelista [$virhekoodi];

    return self::$virhelista [-1];
}

    private $nimi;
    private $sukupuoli;
    private $hetu;
    private $pvm;
    private $tunnus;
    private $osoite;
    private $kommentti;
    private $id;

    public function jsonSerialize() {
        return array ( 
          "nimi" => $this->nimi,
          "sukupuoli" => $this->sukupuoli,
          "hetu" => $this->hetu,
          "pvm" => $this->pvm,
          "tunnus" => $this->tunnus,
          "osoite" => $this->osoite,
          "kommentti" => $this->kommentti,
          "id" => $this->id 
        );
      }
    
    function __construct($nimi = "", $sukupuoli = "", $hetu = "", $pvm = "", $tunnus = "", $osoite = "", $kommentti = "", $id = 0) {
        $this->nimi = trim (mb_convert_case($nimi, MB_CASE_TITLE, "UTF-8"));
        $this->sukupuoli = $sukupuoli;
        $this->hetu = trim ($hetu);
        $this->pvm = trim ($pvm);
        $this->tunnus = trim ($tunnus);
        $this->osoite = trim (mb_convert_case($osoite, MB_CASE_TITLE, "UTF-8"));
		$this->kommentti = trim ($kommentti);
		$this->id = $id;
	}

    public function getNimi()
    {
        return $this->nimi;
    }
    public function setNimi($nimi)
    {
        $this->nimi = $nimi;
        return $this;
    }
    public function checkNimi($min = 2, $max = 30)
    {
        $nimiArray = explode(" ", $this->nimi);
        $nimiLaskuri = sizeof($nimiArray);

        if (strlen ($this->nimi) == 0)
        return 1;

        if (strlen ($this->nimi) > $max)
        return 2;

        if (preg_match ("/[^a-zåäöA-ZÅÄÖ \-]/", $this->nimi))
        return 4;

        if ($nimiLaskuri > 3)
        return 18;

        if (strlen ($this->nimi) < $min)
        return 19;

        return 0;
    }

    public function getSukupuoli()
    {
        return $this->sukupuoli;
    }
    public function setSukupuoli($sukupuoli)
    {
        $this->sukupuoli = $sukupuoli;
        return $this;
    }

    public function checkSukupuoli()
    {
        if (strlen ($this->sukupuoli) == 0)
        return 7;

        if (! in_array($this->sukupuoli, array("Mies", "Nainen")))
        return 5;

        return 0;
    }

    public function getHetu()
    {
        return $this->hetu;
    }
    public function setHetu($hetu)
    {
        $this->hetu = $hetu;
        return $this;
    }
    public function checkHetu()
    {
        $s = substr($this->hetu, 0, 6) . substr($this->hetu, 7, 3);
        $res = intval($s) % 31;
        $merkit = array('0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','H','J','K','L','M','N','P','R','S','T','U','V','W','X','Y');

        if (strlen($this->hetu) == 0)
        return 1;

        if (! preg_match("/\d{6}[+-A]\d{3}[0-9ABCDEFHJKLMNPRSTUVWXY]/", $this->hetu))
        return 13;
      
        if (substr($this->hetu, 10) != $merkit[$res]) {
          return 14;
        }

        return 0;
    }

    public function getPvm()
    {
        return $this->pvm;
    }
    public function setPvm($pvm)
    {
        $this->pvm = $pvm;

        return $this;
    }
    public function checkPvm()
    {
        $aika = time();
        $paivamaara = date("j.n.Y", $aika);
        $paivamaara2 = date("d.m.Y", $aika);

        if (strlen ($this->pvm) == 0)
        return 1;

        if (preg_match("/[a-zåäöA-ZÅÄÖ]/", $this->pvm))
        return 8;

        if (! preg_match("/^([1-9]|[0-2][1-9]|[12](0)|(3)[01])(\.)([1-9]|(1)[0-2])(\.)\d{4}$/", $this->pvm))
        return 12;

        if ($this->pvm > $paivamaara && $this->pvm > $paivamaara2) 
        return 10;
        
        if ($this->pvm < $paivamaara && $this->pvm > $paivamaara2)
        return 11;

        return 0;
    }

    public function getTunnus()
    {
        return $this->tunnus;
    }
    public function setTunnus($tunnus)
    {
        $this->tunnus = $tunnus;
        return $this;
    }
    public function checkTunnus()
    {
        if (strlen($this->tunnus) == 0)
        return 1;

        if (! preg_match("/[0-9]{4}-[0-9]{4}-[0-9]{4}-[0-9]{4}/", $this->tunnus))
        {
            if (preg_match("/[a-zåäöA-ZÅÄÖ]/", $this->tunnus))
            return 8;

            else return 9;
        }

        return 0;
    }

    public function getOsoite()
    {
        return $this->osoite;
    }
    public function setOsoite($osoite)
    {
        $this->osoite = $osoite;
        return $this;
    }
    public function checkOsoite($max = 50)
    {
        if (strlen($this->osoite) == 0)
        return 1;

        if (! preg_match("/^[a-zåäöA-ZÅÄÖ \-]+?\s\d+?(\s[A-Z])?$/", $this->osoite))
        return 16;

        if (strlen ($this->osoite) > $max)
        return 17;

        return 0;
    }

    public function getKommentti()
    {
        return $this->kommentti;
    }
    public function setKommentti($kommentti)
    {
        $this->kommentti = $kommentti;
        return $this;
    }
    public function checkKommentti($max = 200)
    {
        if (strlen($this->kommentti) == 0)
        return 1;

        if (strlen($this->kommentti) > $max)
        return 15;

        return 0;
    }
    
    public function setId($id) {
		$this->id = trim ( $id );
	}

	public function getId() {
		return $this->id;
	}
}

?>
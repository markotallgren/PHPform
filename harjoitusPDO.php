<?php
require_once "harjoitus.php";
class harjoitusPDO{

    private $db;
    private $lkm;

    function __construct($dsn="mysql:host=localhost;dbname=a1600545", $user="root", $password="salainen") {
        $this->db=new PDO($dsn, $user, $password);
        $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $this->lkm = 0;
        }

    public function kaikkiHarjoitukset() {
        $sql="SELECT id, nimi, sukupuoli, hetu, pvm, tunnus, osoite, kommentti FROM harjoitukset";
        if ( ! $stmt=$this->db->prepare($sql)) {
            $virhe=$this->db->errorInfo();
            throw new PDOException($virhe[2], $virhe[1]);
        }
        if ( ! $stmt->execute()) {
            $virhe=$stmt->errorInfo();
            throw new PDOException($virhe[2], $virhe[1]);
        }
        $tulos=array();
        while ($row=$stmt->fetchObject()) {
            $harjoitus=new Harjoitus();
            $harjoitus->setId($row->id);
            $harjoitus->setNimi(utf8_encode($row->nimi));
            $harjoitus->setSukupuoli(utf8_encode($row->sukupuoli));
            $harjoitus->setHetu(utf8_encode($row->hetu));
            $harjoitus->setPvm(utf8_encode($row->pvm));
            $harjoitus->setTunnus(utf8_encode($row->tunnus));
            $harjoitus->setOsoite(utf8_encode($row->osoite));
            $harjoitus->setKommentti(utf8_encode($row->kommentti));
            $tulos[]=$harjoitus;
        }
        $this->lkm=$stmt->rowCount();
        return $tulos;
    }

    public function poistaHarjoitus() {
        $valittuID=$_POST['valittuID'];
        $sql="DELETE FROM harjoitukset where id = $valittuID";
        $stmt=$this->db->prepare($sql);
        $stmt->execute();
    }

    public function haeHarjoitus() {
        $valittuID=$_GET['valittuID'];
        $sql="SELECT id, nimi, sukupuoli, hetu, pvm, tunnus, osoite, kommentti FROM harjoitukset where id = $valittuID";
        if ( ! $stmt=$this->db->prepare($sql)) {
            $virhe=$this->db->errorInfo();
            throw new PDOException($virhe[2], $virhe[1]);
        }
        if ( ! $stmt->execute()) {
            $virhe=$stmt->errorInfo();
            throw new PDOException($virhe[2], $virhe[1]);
        }
        $tulos=array();
        while ($row=$stmt->fetchObject()) {
            $harjoitus=new Harjoitus();
            $harjoitus->setId($row->id);
            $harjoitus->setNimi(utf8_encode($row->nimi));
            $harjoitus->setSukupuoli(utf8_encode($row->sukupuoli));
            $harjoitus->setHetu(utf8_encode($row->hetu));
            $harjoitus->setPvm(utf8_encode($row->pvm));
            $harjoitus->setTunnus(utf8_encode($row->tunnus));
            $harjoitus->setOsoite(utf8_encode($row->osoite));
            $harjoitus->setKommentti(utf8_encode($row->kommentti));
            $tulos[]=$harjoitus;
        }
        $this->lkm=$stmt->rowCount();
        return $tulos;
    }

    public function etsiHarjoitus($nimi) {
        $sql="SELECT id, nimi, sukupuoli, hetu, pvm, tunnus, osoite, kommentti FROM harjoitukset WHERE nimi like :nimi";
        if ( ! $stmt=$this->db->prepare($sql)) {
            $virhe=$this->db->errorInfo();
            throw new PDOException ($virhe[2], $virhe[1]);
        }
        $ni="%" . utf8_decode($nimi) . "%";
        $stmt->bindValue (":nimi", $ni, PDO::PARAM_STR);

        if ( ! $stmt->execute()) {
            $virhe=$stmt->errorInfo();
            if ($virhe [0]=="HY093") {
                $virhe [2]="Invalid parameter";
            }
            throw new PDOException ($virhe[2], $virhe[1]);
        }
        $tulos=array();
        while ($row=$stmt->fetchObject()) {
            $harjoitus=new Harjoitus();
            $harjoitus->setId($row->id);
            $harjoitus->setNimi(utf8_encode($row->nimi));
            $harjoitus->setSukupuoli(utf8_encode($row->sukupuoli));
            $harjoitus->setHetu(utf8_encode($row->hetu));
            $harjoitus->setPvm(utf8_encode($row->pvm));
            $harjoitus->setTunnus(utf8_encode($row->tunnus));
            $harjoitus->setOsoite(utf8_encode($row->osoite));
            $harjoitus->setKommentti(utf8_encode($row->kommentti));
            $tulos[]=$harjoitus;
        }
        $this->lkm=$stmt->rowCount();
        return $tulos;
    }

    function lisaaHarjoitus($harjoitus) {
        $sql="insert into harjoitukset (nimi, sukupuoli, hetu, pvm, tunnus, osoite, kommentti)
                values (:nimi, :sukupuoli, :hetu, :pvm, :tunnus, :osoite, :kommentti)";

     if ( ! $stmt=$this->db->prepare($sql)) {
            $virhe=$this->db->errorInfo();
            throw new PDOException($virhe[2], $virhe[1]);
            }
        $stmt->bindValue(":nimi", utf8_encode($harjoitus->getNimi()), PDO::PARAM_STR);
        $stmt->bindValue(":sukupuoli", utf8_encode($harjoitus->getSukupuoli()), PDO::PARAM_STR);
        $stmt->bindValue(":hetu", utf8_encode($harjoitus->getHetu()), PDO::PARAM_STR);
        $stmt->bindValue(":pvm", utf8_encode($harjoitus->getPvm()), PDO::PARAM_STR);
        $stmt->bindValue(":tunnus", utf8_encode($harjoitus->getTunnus()), PDO::PARAM_STR);
        $stmt->bindValue(":osoite", utf8_encode($harjoitus->getOsoite()), PDO::PARAM_STR);
        $stmt->bindValue(":kommentti", utf8_encode($harjoitus->getKommentti()), PDO::PARAM_STR);

        if ( ! $stmt->execute()) {
            $virhe=$stmt->errorInfo();
            if ($virhe[0]=="HY093") {
                $virhe[2]="Invalid parameter";
            }
            throw new PDOException($virhe[2], $virhe[1]);
        }
        $this->lkm=1;
        return $this->db->lastInsertId();
    }
    }
    ?>
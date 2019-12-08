<?php
    include("phpIncludes/konekcija.php");
    if(isset($_GET['poslato'])){
        $imeKontakt = $_GET['ime'];
        $emailKontakt = $_GET['email'];
        $porukaKontakt = $_GET['poruka'];

        $regImeKontakt="/^[A-ZČĆŠĐŽ][a-zčćšđž]{2,12}(\s[A-ZČĆŠĐŽ][a-zčćšđž]{2,15})+$/";
        $regEmailKontakt="/^[a-zA-Z0-9-_.]+@[a-zA-Z0-9]+(?:\.[a-zA-Z0-9]+)*$/";

        $kontaktGreske=[];
        $kontaktIspravno=[];

        if(preg_match($regImeKontakt, $imeKontakt)){
            array_push($kontaktIspravno,$imeKontakt);
        }
        else{
            arrat_push($kontaktGreske,"Ime nije dobro");
        }

        if(preg_match($regEmailKontakt, $emailKontakt)){
            array_push($kontaktIspravno,$emailKontakt);
        }
        else{
            arrat_push($kontaktGreske,"Email nije dobro");
        }

        if(count($kontaktGreske)==0){
            $upit="INSERT INTO kontakt VALUES ('',:ime,:email,:poruka,0)";

            $priprema=$konekcija->prepare($upit);
            $priprema->bindParam(':ime',$imeKontakt);
            $priprema->bindParam(':email',$emailKontakt);
            $priprema->bindParam(':poruka',$porukaKontakt);
            $priprema->execute();
            
        }
    }
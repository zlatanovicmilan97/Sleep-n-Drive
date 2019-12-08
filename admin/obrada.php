<?php
include("../phpIncludes/konekcija.php");
    if(isset($_POST['formaPotvrdi'])){
        $imePrezime=$_POST['imePrezime'];
        $email=$_POST['email'];
        $korisnickoIme=$_POST['korIme'];
        $password=md5($_POST['pasvord']);
        $passwordPotvrdi=md5($_POST['pasvord2']);
        $ddlDrzava=$_POST['ddlDrzavaPolje'];
        $ddlUloga=$_POST['ddlUloga'];

        $regImePrezime="/^[A-ZČĆŠĐŽ][a-zčćšđž]{2,12}(\s[A-ZČĆŠĐŽ][a-zčćšđž]{2,15})+$/";
        $regEmail = "/^[a-zA-Z0-9-_.]+@[a-zA-Z0-9]+(?:\.[a-zA-Z0-9]+)*$/";
		$regKorIme = "/^[A-ZČĆŠĐŽa-zčćšđž0-9]{7,20}$/";
        
        $nizIspravno = [];
        $nizGreske = [];

        if(preg_match($regImePrezime,$imePrezime)){
            array_push($nizIspravno, $imePrezime);
        }
        else{
            array_push($nizGreske,"Ime");
        }

        if(preg_match($regEmail,$email)){
            array_push($nizIspravno, $email);
        }
        else{
            array_push($nizGreske,"email");
        }

        if(preg_match($regKorIme,$korisnickoIme)){
            array_push($nizIspravno, $korisnickoIme);
        }
        else{
            array_push($nizGreske,"korIme");
        }


        if($password==$passwordPotvrdi){
            array_push($nizIspravno, $password);
        }
        else{
            array_push($nizGreske,"pass");
        }
        if($ddlDrzava == "0"){
			array_push($nizGreske,"drzava");
		}
		else{
			array_push($nizIspravno, $ddlDrzava);
        }
        
        if($ddlUloga == "0"){
			array_push($nizGreske,"uloga");
		}
		else{
			array_push($nizIspravno, $ddlUloga);
		}



        if(count($nizGreske)==0){
            $upit="INSERT INTO korisnici VALUES('',:imePrezime,:email,:korisnickoIme,:passwordPodatak,:ddlDrzava,:ddlUloga)";
			$priprema = $konekcija->prepare($upit);
            $priprema->bindParam(':imePrezime', $imePrezime);   
            $priprema->bindParam(':email', $email);  
            $priprema->bindParam(':korisnickoIme', $korisnickoIme);  
            $priprema->bindParam(':passwordPodatak', $password); 
            $priprema->bindParam(':ddlDrzava', $ddlDrzava);  
            $priprema->bindParam(':ddlUloga', $ddlUloga);   
            $priprema->execute();
            header("Location:../admin/korisnici.php?strana=1");
        }
        else{
            foreach($nizGreske as $x){
                echo $x;
            }
        }

    }

 ?>
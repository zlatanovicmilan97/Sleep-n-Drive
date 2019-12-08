<?php
include("../phpIncludes/konekcija.php");
    if(isset($_POST['poruka'])){
        $id=$_POST['id'];
        $imePrezime=$_POST['ime'];
        $email=$_POST['email'];
        $korIme=$_POST['korIme'];
        $pass=$_POST['pass'];
        $drzava=$_POST['drzava'];
        $uloga=$_POST['uloga'];


        $upit="UPDATE korisnici SET korisnikID=:id,imePrezime=:ime,email=:email,username=:user,lozinka=:pass,drzava=:drzava WHERE korisnikID=:id";
        try{
        $priprema=$konekcija->prepare($upit);
        $priprema->bindParam(':id',$id);
        $priprema->bindParam(':ime',$imePrezime);
        $priprema->bindParam(':email',$email);
        $priprema->bindParam(':user',$korIme);
        $priprema->bindParam(':pass',$pass);
        $priprema->bindParam(':drzava',$drzava);
        // $priprema->bindParam(':uloga',$uloga);
        $priprema->execute();

        header('Location:korisnici.php?strana=1#ispisKorisnika');
        }
        catch(PDOException $e){
            echo $e -> getMessage();
        }
    }
<html>
    <head>
        <title>SnD  | ADMIN</title>
        <meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="../assets/css/main.css" />
        <link rel="shortcut icon" href="../images/ikonica.ico"/>
    </head>
    <body>
        <div id="adminOkvir">
            <div id="adminHeader">
                <div id="adminLogo">
                    <a href="admin.php"><img src="slike/adminLogo.png" alt="adminLogo"/></a>
                </div>
                <div id="adminPovratak">
                     <a href="../index.php">&#8594; Povratak na sajt</a>
                </div>
            </div>
            <div id="adminLinkovi">
            <ul id='adminIspisLink'>
                    <li><a href="admin.php">admin.php</a></li>
                    <li><a href="kontakt.php">kontakt.php</a></li>
                    <li><a href="korisnici.php?strana=1&&id=1">korisnici.php</a></li>
                    <li><a href="smestajParagraf.php">smestaj.php</a></li>
                    <li><a href="galerija.php"/>galerija.php</a></li>
                    <li><a href="anketa.php">anketa.php</a></li>
                    <li><a href="../index.php?stranica=recenzije&&strana=1">recenzije.php</a></li>
                    
                    </ul>
            </div>
            <div id="adminSadrzaj">
                <div id="korisniciPodaci">
                    <?php
                        $upit2="SELECT COUNT(*) FROM korisnici";
                        include("../phpIncludes/konekcija.php");
                        $rezultat=$konekcija->query($upit2);

                        if($rezultat){
                            $podaci=$rezultat->fetch();
                            foreach($podaci as $podatak){
                                $ispis="<span>Ukupan broj registrovanih korisnika:</br> <span id='brKorisnikaSpan'>".$podatak."</span></span>";
                            }
                            echo $ispis;
                        }
                    ?>
                </div>  
                <div id="ispisKorisnika">
                    <p>Tabelarni prikaz registrovanih korisnika:</p>
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>IME I PREZIME</th>
                            <th>EMAIL</th>
                            <th>KORISNICKO IME</th>
                            <th>LOZINKA</th>
                            <th>DRZAVA</th>
                            <th>ULOGA</th>
                        </tr>

                        <?php
                            $upitStranicenje="SELECT COUNT(*) FROM korisnici";
                            $rezultat=$konekcija->query($upitStranicenje)->fetchColumn();
            
                            $brojPoStr=5;
                            
                            $brojStranica=ceil((int)$rezultat / $brojPoStr);
                            
            
                            $strana=(int)$_GET['strana'];
                            $offset=$strana*5-$brojPoStr;
            
                            $upit2="SELECT * FROM korisnici k INNER JOIN uloga u ON k.ulogaID=u.ulogaID ORDER BY naziv, korisnikID DESC LIMIT $brojPoStr OFFSET $offset";

                            
                            $rezultat2=$konekcija->query($upit2);
                            

                            if($rezultat2){
                                $podaci=$rezultat2->fetchAll();

                                foreach($podaci as $podatak){
                                    if($podatak->korisnikID==23){
                                        $dugmeObrisi="";
                                    }
                                    else{
                                        $dugmeObrisi="<a class='tabelaLink' href='brisanjeKorisnika.php?id=".$podatak->korisnikID."'>Obrisi</a>";
                                    }
                                    $ispis="<tr>
                                                <td>".$podatak->korisnikID."</td>
                                                <td>".$podatak->imePrezime."</td>
                                                <td>".$podatak->email."</td>
                                                <td>".$podatak->username."</td>
                                                <td>".$podatak->lozinka."</td>
                                                <td>".$podatak->drzava."</td>
                                                <td>".$podatak->naziv."</td>
                                                <td><a href='korisnici.php?strana=1&&id=".$podatak->korisnikID."#izmenaKorisnika' class='tabelaLink' id='linkIzmeni'>Izmeni</a></td>
                                                <td>".$dugmeObrisi."</td>
                                            </tr>";
                                    echo $ispis;
                                }
                            }
                            
                        ?>

                   

                    </table>
                    <ul  class="stranicenjeKorisnici" id="stranicenje">
				<?php 

					
					$brojac=1;
					for($i=0; $i<$brojStranica; $i++)
					{
						echo "<li><a href='korisnici.php?strana=".$brojac."' class='".$brojac."'>".$brojac++."</a></li>";
					}
				?>
				</ul>



                </div>
                <div id="dodavanjeKorisnika">
                        <input type="button" id="dodavanjeKorisnikaPrikaz" value="Dodaj korisnika"/>
                        <form action="obrada.php" id="formaDodavanjeKorisnika" method="POST" name="registracija" onSubmit="return proveraAdmin()" >
                                <p>Ime i prezime:</p>
                                <input class="main-registracija-formular" type="text" id="imePrezime" name="imePrezime" placeholder="Veliko početno slovo, min.3, max.12, max.15(prezime)." autocomplete="on"/> <br/>
                                <p>E-mail:</p>
                                <input class="main-registracija-formular" type="text" id="eMail" name="email" placeholder="E-mail adresa u važećem formatu." autocomplete="on"/> <br/>
                                <p>Korisničko ime:</p>
                                <input class="main-registracija-formular" type="text" id="korisnickoIme" name="korIme" placeholder="Mala i velika slova, min.7, max.20, bez razmaka." autocomplete="on" /> <br/>
                                <p>Lozinka:<p>
                                <input class="main-registracija-formular" type="password" id="pasvord" name="pasvord" placeholder="Min.8 karaktera, min.1 slovo i broj."/>
                                <p>Potvrdite lozinku:<p>
                                <input class="main-registracija-formular" type="password" id="pasvord2" name="pasvord2" placeholder="Potvrdite lozinku" />
                                <p>Država:</p>
                                <select class="main-registracija-formular" id="ddlDrzava" name="ddlDrzavaPolje">
                                    <?php
                                        $upit="SELECT * FROM country";
                                        $rezultat = $konekcija->query($upit);
                                        $ispis="<option value='0'>Izaberite</option>";

                                        if($rezultat){
                                            $podaci = $rezultat->fetchAll();
                                            foreach($podaci as $podatak){
                                                $ispis.="<option value='".$podatak->countryname."' class='main-registracija-formular-option'>".$podatak->countryname."</option>";
                                            }
                                            echo $ispis;
                                        }
                                    ?>
                                </select>
                                </br>
                                <p>Uloga:</p>
                                <select id='ddlUloga' name='ddlUloga'>
                                    <option value='0'>Izaberite</option>
                                    <option value='1'>admin</option>
                                    <option value='2'>korisnik</option>
                                </select>
                                 <br/>
                                <input class="main-registracija-formular-dugme" id="main-kontakt-formular-dugme" type="submit" name="formaPotvrdi" value="Potvrdi"/> 
                                <input class="main-registracija-formular-reset" id="main-kontakt-formular-reset" type="reset" id="formaPonisti" name="formaPonisti" value="Poništi"/> 
                            </form>
                </div>
                <div id="izmenaKorisnika">
                    <form action="#" method="POST" id="formaIzmenaKorisnika">
                        <?php
                            if(isset($_GET['id'])){
                                $korID=$_GET['id'];
                                
                                $upitIzmena="SELECT * FROM korisnici k INNER JOIN uloga u ON k.ulogaID=u.ulogaID WHERE k.korisnikID=$korID";

                                $rezultatIzmena=$konekcija->query($upitIzmena);
                                
                                if($rezultatIzmena){
                                    $podaci2=$rezultatIzmena->fetchAll();
                                    foreach($podaci2 as $podatak2){
                                        $ispis="<span>Ime i prezime:</span><input type='text' id='imePrezimeIzmena' name='imePrezimeIzmena' placeholder='Pera Peric' value='".$podatak2->imePrezime."'/>
                                        <span>email:</span><input type='text' id='emailIzmena' name='emailIzmena' placeholder='pera_peric@nesto.com' value='".$podatak2->email."'/>
                                        <span>Korisnicko ime:</span><input type='text' id='korImeIzmena' name='korImeIzmena' placeholder='pera123' value='".$podatak2->username."'/>
                                        <span>Lozinka:</span><input type='password' id='passIzmena' name='passIzmena' placeholder='peraperic1' value='".$podatak2->lozinka."'/>
                                        <span>Lozinka potvrdi:</span><input type='password' id='passPotIzmena' name='passPotIzmena' placeholder='peraperic1' value='".$podatak2->lozinka."'/>
                                        <span>Drzava:</span><select id='ddlDrzavaIzmena' name='ddlDrzavaIzmena'><option value='".$podatak2->drzava."'>".$podatak2->drzava."</option>";
                                                        $upitDrzave="SELECT * FROM country";
                                                        $rezultatDrzave=$konekcija->query($upitDrzave);

                                                        if($rezultatDrzave){
                                                            $podaciDrzave=$rezultatDrzave->fetchAll();
                                                            foreach($podaciDrzave as $x){
                                                                $ispis.="<option value='".$x->countryname."'>".$x->countryname."</option>";
                                                            }
                                                        }
                                                        if($podatak2->ulogaID==1){
                                                            $ulogaIspis="admin";
                                                        }
                                                        else
                                                        {
                                                            $ulogaIspis="korisnik";
                                                        }
                                       $ispis.=" </select>
                                        <span>Uloga:</span><select id='ddlUlogaIzmena' name='ddlUlogaIzmena'>
                                                    <option value='".$ulogaIspis."'>".$ulogaIspis."</option>
                                                    <option value='1'>admin</option>
                                                    <option value='2'>korisnik</option>
                                        </select>
                                        <input type='button' onclick='korisnikIzmeni();' id='dugmeIzmenaKorisnika' name='dugmeIzmenaKorisnika' value='Izmeni'/>";
                                    }
                                    echo $ispis;
                                }
                                


                            }  
                            
                        ?>
                        
                    </form>
                </div>
                
                
            </div>
        </div>



        <footer>

        </footer>
            <script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/jquery.scrolly.min.js"></script>
			<script src="../assets/js/jquery.scrollex.min.js"></script>
			<script src="../assets/js/skel.min.js"></script>
			<script src="../assets/js/util.js"></script>
            <script src="../assets/js/main.js"></script>
            
            <script type=text/javascript>

                $('#dodavanjeKorisnikaPrikaz').click(function(){
					$('#formaDodavanjeKorisnika').slideToggle("slow");
				});


                function korisnikIzmeni(){
                    var korID=<?php echo $_GET['id']; ?>;
                    var ime=$('#imePrezimeIzmena').val();
                    var mail=$('#emailIzmena').val();
                    var korisnicko=$('#korImeIzmena').val();
                    var pass=$('#passIzmena').val();
                    var drzava=$('#ddlDrzavaIzmena option').val();
                    var uloga=$('#ddlUlogaIzmena option').val();
    
                    $.ajax({
                        url:'korisnikIzmena.php',
                        type:'POST',
                        dataType:'json',
                        data:{
                            id:korID,
                            ime:ime,
                            email:mail,
                            korIme:korisnicko,
                            pass:pass,
                            drzava:drzava,
                            uloga:uloga,
                            poruka:'poslato'
                        }
                    });
                }




                 function proveraAdmin(){
                    var imePrezime=document.querySelector("#imePrezime").value.trim();
					var email = document.querySelector('#eMail').value;
					var korIme = document.querySelector('#korisnickoIme').value;
					var lozinka = document.querySelector('#pasvord').value;
					var lozinkaPotvrda = document.querySelector('#pasvord2').value;
					var ddlDrzava = document.querySelector("#ddlDrzava").value;
                    var ddlUloga = document.querySelector("#ddlUloga").value;
					
					var regImePrezime = /^[A-ZČĆŠĐŽ][a-zčćšđž]{2,12}(\s[A-ZČĆŠĐŽ][a-zčćšđž]{2,15})+$/;
					var regEmail = /^[a-zA-Z0-9-_.]+@[a-zA-Z0-9]+(?:\.[a-zA-Z0-9]+)*$/;
					var regKorIme = /^[A-ZČĆŠĐŽa-zčćšđž0-9]{7,20}$/;
					var regLozinka = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;

					var nizGreske=[];
					var nizIspravno=[];

					

					if(regImePrezime.test(imePrezime)){
						nizIspravno.push(imePrezime);
						document.querySelector("#imePrezime").style.borderColor="#90909040";
					}
					else{
						nizGreske.push("Nepravilno ime i prezime.");
						document.querySelector("#imePrezime").style.borderColor="#F64747";
					}

					if(regEmail.test(email)){
						nizIspravno.push(email);
						document.querySelector("#eMail").style.borderColor="#90909040";
					}
					else{
						nizGreske.push("Nepravilan format email-a.");
						document.querySelector("#eMail").style.borderColor="#F64747";
					}

					if(regKorIme.test(korIme)){
						nizIspravno.push(korIme);
						document.querySelector("#korisnickoIme").style.borderColor="#90909040";
					}
					else{
						nizGreske.push("Nepravilno korisnicko ime.");
						document.querySelector("#korisnickoIme").style.borderColor="#F64747";
					}

					if(regLozinka.test(lozinka)){
						nizIspravno.push(lozinka);
						document.querySelector("#pasvord").style.borderColor="#90909040";
					}
					else{
						nizGreske.push("Nepravilna lozinka.");
						document.querySelector("#pasvord").style.borderColor="#F64747";
					}

					if(lozinka==lozinkaPotvrda){
						nizIspravno.push(lozinkaPotvrda);
						document.querySelector("#pasvord2").style.borderColor="#90909040";
					}
					else{
						nizGreske.push("Potvrdite ispravnu lozinku.");
						document.querySelector("#pasvord2").style.borderColor="#F64747";
					}

					if(ddlDrzava == "0"){
						nizGreske.push("Izaberite drzavu.");
						document.querySelector("#ddlDrzava").style.borderColor="#F64747";
					}
					else
					{
						nizIspravno.push(ddlDrzava);
						document.querySelector("#ddlDrzava").style.borderColor="#90909040";
					}

                    if(ddlUloga == "0"){
						nizGreske.push("Izaberite ulogu.");
						document.querySelector("#ddlUloga").style.borderColor="#F64747";
					}
					else
					{
						nizIspravno.push(ddlUloga);
						document.querySelector("#ddlUloga").style.borderColor="#90909040";
					}
	

					if(nizGreske.length>0){
							console.log(nizGreske);
							return false;
					}
					
					if(nizGreske.length==0){
						return true;
					}

				}
            </script>
    </body>
</html>
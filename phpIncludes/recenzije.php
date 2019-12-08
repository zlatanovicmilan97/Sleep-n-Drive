<?php
	if(isset($_SESSION['korisnik'])){
		$user=$_SESSION['korisnik']->korisnikID;
		if(isset($_POST['ocenaDugme'])){
			$ocena = $_POST['ddlOcena'];
			$komentar = $_POST['taKomentar'];
			$datum = date('d-m-Y', time());

			if($ocena == "0"){
				echo "Greska!";
			}
			else{
				$upit="INSERT INTO recenzije VALUES ('', '$datum', '$komentar', '$user', '$ocena')";
				$priprema = $konekcija->prepare($upit);
				$priprema -> execute();

			}
	}
}
else
{
	echo "<script>
		window.onload=function(){var promenljiva=document.querySelector('#dugmeSmanji');
			promenljiva.style.display='none';};
		
	</script>";
}


?>


<section id="post" class="wrapper bg-img" data-bg="3.jpg">
            <div class="inner">

				<form action="index.php?stranica=recenzije&strana=1" method="POST" id="formaUnosRecenzije" name="formaRecenzija" onSubmit="return recenzijaProvera()" >
						<?php 
						
						$upit="SELECT AVG(ocena) FROM recenzije";
						$rezultat = $konekcija->query($upit);
	
						if($rezultat){
							$podaci = $rezultat->fetch();
							foreach($podaci as $podatak){
							echo "<div id='divUmanjen'>Prosečna ocena koju su dodeli naši gosti: <span id='spanOcena'>".round($podatak,1)."</span>
									<input type='button' id='dugmeSmanji' value='OCENITE I VI &#8681;'/></div>";
							}
						}


						
						?>
				
					<div id="recenzijePolja">
					<select id="ddlOcena" name="ddlOcena">
						<option value="0">Ocenite posetu(1-5)</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select><p id="ocenaGreska">Unesite ocenu!</p><br/>
					Komentar:
					<textarea rows="5" id="taOcena" name="taKomentar">
					</textarea>
					<input type="submit" value="Oceni" id="komentarDugme" name="ocenaDugme"/>
					</div>
				</form>


				<?php
				$upitStranicenje="SELECT COUNT(*) FROM recenzije";
				$rezultat=$konekcija->query($upitStranicenje)->fetchColumn();


				$brojPoStr=10;
				
				$brojStranica=ceil((int)$rezultat / $brojPoStr);
				

				$strana=(int)$_GET['strana'];
				$offset=$strana*10-$brojPoStr;









				$upit="SELECT * FROM recenzije r INNER JOIN korisnici k ON r.korisnikID = k.korisnikID ORDER BY recenzijaID DESC LIMIT $brojPoStr OFFSET $offset";
				$rezultat = $konekcija->query($upit);

				if($rezultat){
					$podaci=$rezultat->fetchAll();
					/*$upit2="SELECT r.korisnikID FROM korisnici k INNER JOIN recenzije r ON k.korisnikID=r.korisnikID";
								$rezultat2=$konekcija->query($upit2)->fetchAll();*/

					foreach($podaci as $podatak){
						$date = new DateTime($podatak->recenzijaDatum);
						$ispis="<table class='tabelaRecenzije'>
									<tr>
										<th>".$podatak->imePrezime." (ocena: ".$podatak->ocena.")
										<p class='tabelaRecenzijeDatum'>".$date->format('d.m.Y')."</p></th>
									</tr>
									<tr>
										<td>".$podatak->drzava."</td>
									</tr>
									<tr>
										<td>".$podatak->recenzijaOpis."</td>
									</tr>
								</table>";

								if(isset($_SESSION['korisnik'])){
								if($podatak->korisnikID==$_SESSION['korisnik']->korisnikID&&$podatak->ulogaID!=1){
									$ispis.="<span class='recenzijaIzbrisi'><a href='brisanje.php?id=".$podatak->recenzijaID."' class='recenzijaIzbrisiA'>Izbrisi</a></span>";
								}
								else if($_SESSION['korisnik']->ulogaID==1){
									$ispis.="<span class='recenzijaIzbrisi'><a href='brisanje.php?id=".$podatak->recenzijaID."' class='recenzijaIzbrisiA'>Izbrisi</a></span>";
								}
								/*if($rezultat2){
									
									foreach($rezultat2 as $podatak2){
										if(isset($_SESSION['korisnik'])){
											if($_SESSION['korisnik']->korisnikID==$podatak2->korisnikID){
												$ispis2="<a>Izbrisi</a>";
											}
										}
									}
									echo $ispis2;
								}*/
							}
							echo $ispis;
					}
					
				}
				?>
				<ul id="stranicenje">
				<?php 

					
					$brojac=1;
					for($i=0; $i<$brojStranica; $i++)
					{
						echo "<li><a href='index.php?stranica=recenzije&strana=".$brojac."' class='".$brojac."'>".$brojac++."</a></li>";
					}
					


					

					// $offset = ($stranica - 1)  * $brojPoStr;
					
					// $pocetak = $offset + 1;
					// $kraj = min(($offset + $brojPoStr), $brojStranica);
					// var_dump($pocetak);
					// var_dump($kraj);

		// 			include("connection.php");
        // $upit = "SELECT COUNT() FROM proizvodi";
        // $brStr = $conn->query($upit)->fetchColumn();
        // $brStr = (int)$brStr;
        // $prPoStrani = 5;
        // $ukupno = ceil($brStr / $prPoStrani);

        // $strana = (int)$_GET["strid"];
        // $offset = $strana5-$prPoStrani;

        // $upit1 = "SELECT p.id, p.naziv, p.tezina, p.cena, s.src, s.alt, p.id_kat FROM proizvodi p INNER JOIN slike s ON p.id_slika = s.id LIMIT 5 OFFSET $offset";

        // $rez = $conn->query($upit1);
        // $nesto = $rez->fetchAll();



					// <li><a>1</a></li>
					// <li><a>2</a></li>
					// <li><a>3</a></li>
					// <li><a>4</a></li>
				?>
				</ul>
            </div>
        </section>
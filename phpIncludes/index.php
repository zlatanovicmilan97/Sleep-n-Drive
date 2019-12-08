<?php
    if(isset($_POST['formaPotvrdi'])){
        $imePrezime=$_POST['imePrezime'];
        $email=$_POST['email'];
        $korisnickoIme=$_POST['korIme'];
        $password=md5($_POST['pasvord']);
		$passwordPotvrdi=md5($_POST['pasvord2']);
		$ddlDrzava=$_POST['ddlDrzavaPolje'];

        $regImePrezime="/^[A-ZČĆŠĐŽ][a-zčćšđž]{2,12}(\s[A-ZČĆŠĐŽ][a-zčćšđž]{2,15})+$/";
        $regEmail = "/^[a-zA-Z0-9-_.]+@[a-zA-Z0-9]+(?:\.[a-zA-Z0-9]+)*$/";
		$regKorIme = "/^[A-ZČĆŠĐŽa-zčćšđž0-9]{7,20}$/";
        $regLozinka = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/";
        
        $nizIspravno = [];
        $nizGreske = [];

        if(preg_match($regImePrezime,$imePrezime)){
            array_push($nizIspravno, $imePrezime);
        }
        else{
            array_push($nizGreske,"nijeOK");
        }

        if(preg_match($regEmail,$email)){
            array_push($nizIspravno, $email);
        }
        else{
            array_push($nizGreske,"nijeOK");
        }

        if(preg_match($regKorIme,$korisnickoIme)){
            array_push($nizIspravno, $korisnickoIme);
        }
        else{
            array_push($nizGreske,"nijeOK");
        }

        if(preg_match($regLozinka,$password)){
            array_push($nizIspravno, $password);
        }
        else{
            array_push($nizGreske,"nijeOK");
        }

        if($password==$passwordPotvrdi){
            array_push($nizIspravno, $password);
        }
        else{
            array_push($nizGreske,"nijeOK");
		}
		
		if($ddlDrzava == "0"){
			array_push($nizGreske,"nijeOK");
		}
		else{
			array_push($nizIspravno, $ddlDrzava);
		}


        if(count($nizGreske)==0){
			$upit="INSERT INTO korisnici VALUES('','$imePrezime','$email','$korisnickoIme','$password','$ddlDrzava','2')";
			$priprema = $konekcija->prepare($upit);
			$priprema->execute();
				
		}
		
		else{
			echo "Registracija neuspesna";
		}

    }

 ?>







<!-- Banner -->
		<!--
			Note: To show a background image, set the "data-bg" attribute below
			to the full filename of your image. This is used in each section to set
			the background image.
		-->
        
		<section id="banner" class="bg-img" data-bg="1.jpg">
				<div class="inner">
					<header>
						<h1>Sleep'n Drive</h1>
					</header>
				</div>
				<a href="#one" class="more">Learn More</a>
			</section>

		<!-- One -->
			<section id="one" class="wrapper post bg-img" data-bg="9.jpg">
				<div class="inner">
					<article class="box">
						<header>
							<h2>Smeštaj</h2>
						</header>
						<div class="content">
							<p>Apartman Sleep'n Drive se nalazi u Beogradu. Hram Svetog Save udaljen je 900 metara od objekta. Besplatan bežični internet dostupan je u celom objektu. Parking u okviru objekta može se besplatno koristiti.</p>
						</div>
						<footer>
							<a  href="index.php?stranica=smestaj" class="button alt">Pročitaj više</a>
						</footer>
					</article>
				</div>
				<a href="#two" class="more">Learn More</a>
			</section>

		<!-- Two -->
			<section id="two" class="wrapper post bg-img" data-bg="4.jpg">
				<div class="inner">
					<article class="box">
						<header>
							<h2>Anketa</h2>
							
						</header>
						<div class="content">
								<div id="anketaBlok">
									<p>Kako nam je bitno da želja svakog gosta bude uslišena, molimo vas da popunite našu anketu.</p>

									<!-- Trigger/Open The Modal -->
									

									<!-- The Modal -->
									<div id="myModal" class="modal">

									<!-- Modal content -->
									<div class="modal-content">
										<span class="close">&times;</span>
										<div id='anketa'>
										<p>ANKETA</p>
										<p>Da li ste se registrovan korisnik na nasem sajtu?</br>
										<input type='radio' name='rbAnketa' value='da' class='rbAnketa'/>Da</br>
										<input type='radio' name='rbAnketa' value='ne' class='rbAnketa'/>Ne</p>
										<p>Koji od ponudjenih noviteta bi Vas najvise obradovao?</br>
										<input type='checkbox' name='chbAnketa' value='bazen' class='chbAnketa'/>Bazen</br>
										<input type='checkbox' name='chbAnketa' value='teren' class='chbAnketa'/>Sportski teren</br>
										<input type='checkbox' name='chbAnketa' value='restoran' class='chbAnketa'/>Restoran</p>
										<p><input type='button' id='anketaDugme' value='Posalji' name='anketaDugme' onclick='obradaAnketa();'/></p>
										<span id="anketaGreske"></span>
									</div>
									</div>

								</div>
								
						</div>
						<footer>
						<button id="myBtn">Popunite anketu</button>
						</footer>
					</article>
				</div>
				<a href="#three" class="more">Learn More</a>
			</section>

		
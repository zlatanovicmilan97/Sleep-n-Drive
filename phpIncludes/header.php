<!DOCTYPE HTML>
<!--
	Road Trip by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->

<html>
	<head>
		<title>
            <?php
                if(isset($_GET['stranica'])){
                    $stranica = $_GET['stranica'];
                    if($stranica=='index'){
                        echo "Sleep'n Drive";
                    } 
                    else if ($stranica == 'smestaj') {
                        echo "SnD  | Smeštaj";
                    }
                    else if ($stranica == 'registracija') {
                        echo "SnD  | Registracija";
					}
					else if ($stranica == 'rececnzije') {
                        echo "SnD  | Recenzije";
					}
					else if ($stranica == 'kontakt') {
                        echo "SnD  | Kontakt";
					}  
					else if ($stranica == 'autor') {
                        echo "SnD  | Autor";
                    }  
                }
                else {
                    echo "Sleep 'n Drive";
                }
            ?>
        </title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <link rel="shortcut icon" href="images/ikonica.ico"/>
	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<div class="logo"><a href="index.php?stranica=index">APARTMENTS <span>Sleep'n Drive</span></a></div>
				<?php
					if(isset($_POST['dugmeLogovanje'])){
						$user = $_POST['korImeLog'];
						$pass = md5($_POST['lozinkaLog']);

						$upit = "SELECT * FROM korisnici WHERE username = :username AND lozinka = :lozinka";

						$priprema = $konekcija->prepare($upit);
						$priprema->bindParam(':username',$user);
						$priprema->bindParam(':lozinka',$pass);
						try{
							$rezultat=$priprema->execute();

							if($rezultat){
								if($priprema->rowCount()==1){
									$korisnik=$priprema->fetch();
									
									$_SESSION['korisnik']=$korisnik;
									if(isset($_SESSION['korisnik'])){
										echo "Dobor došli!";
									}
								}
								else{
								echo "Pogresni podaci, ili mozda niste registrovani?";}
							}
						}
						catch(PDOException $e){
							echo $e -> getMessage();
						}
					}


				?>
				<a href="#menu"><span>Menu</span></a>
				
			</header>

		<!-- Nav -->
			<nav id="menu">
				<?php
					$upit="SELECT * FROM meni";
					$rezultat=$konekcija->query($upit);
					if($rezultat){
						$podaci=$rezultat->fetchAll();
						$ispis="<ul class='links'>";


						foreach($podaci as $podatak){

								$ispis.="<li id='".$podatak->idLI."'>
											<a href='".$podatak->link_putanja."'>".$podatak->link_naziv."</a>
										</li>";
													
						}
						
						if(isset($_SESSION['korisnik'])){
							if($_SESSION['korisnik']->ulogaID==1){
								$ispis.="<li><a href='admin/admin.php' target='blank'>ADMIN</a></li>";
								$ispis.="</ul>";
								echo $ispis;
							}
							else
							{
								$ispis.="</ul>";
								echo $ispis;
							}
						
						}
						else
						{
							$ispis.="</ul>";
							echo $ispis;
						}


					}
				?>
				
				
				
					<?php if(isset($_SESSION['korisnik'])):
						echo "<div id='odjavaDiv'>
								<span>".$_SESSION['korisnik']->imePrezime."</span></br>
								<span>".$_SESSION['korisnik']->username."</span></br>
								<a id='odjava' href='logout.php'>Odjavi se</a></div>";
						
					else:
						
							?> 
								<form id="logovanje" action="<?php echo $_SERVER['PHP_SELF']."?stranica=index"; ?>" method="POST">
									<p>Prijavite se</p>
									<input type="text" id="korIme" placeholder="Korisničko ime" name="korImeLog"/>
									<input type="password" id="lozinka" placeholder="Lozinka" name="lozinkaLog"/>
									<input type="submit" id="dugme" value="Potvrdi" name="dugmeLogovanje"/>
									<a href="index.php?stranica=registracija">Registracija</a>
								</form>
				<?php endif; ?>
					
			</nav>
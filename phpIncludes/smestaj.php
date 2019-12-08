
<!-- Content -->
		<!--
			Note: To show a background image, set the "data-bg" attribute below
			to the full filename of your image. This is used in each section to set
			the background image.
		-->
        <section id="post" class="wrapper bg-img" data-bg="4.jpg">
				<div class="inner">
					<article id="smestajBox" class="box">
						<header>
							<h2>Smeštaj</h2>
						</header>
						<div class="content">
							<?php 
							$upit="SELECT * FROM smestaj_paragraf";
							$rezultat=$konekcija->query($upit);
							if($rezultat){
								$podaci=$rezultat->fetchAll();
								foreach($podaci as $podatak){
									$ispis="<p id='paragraf".$podatak->paragrafID."'>".$podatak->paragrafText."</p>";
									echo $ispis;
								}
							}
							?>
							<!-- <p id="prviP">Apartman Sleep'n Drive se nalazi u Beogradu i nudi terasu. Hram Svetog Save udaljen je 900 metara od objekta. Besplatan bežični internet dostupan je u celom objektu. Parking u okviru objekta može se besplatno koristiti.</p>

							<p>Sve jedinice sadrže flat-screen TV sa kablovskim kanalima, a pojedine imaju i prostor za sedenje i/ili terasu. Frižider i električno kuvalo su takođe dostupni. Neke jedinice takođe poseduju kuhinju opremljenu rernom, mikrotalasnom pećnicom i frižiderom. Svaka jedinica sadrži kupatilo sa tušem, a u ponudi su takođe peškiri i posteljina.</p>

							<p>Apartman Sleep'n Drive udaljen je 3 km od Trga republike u Beogradu. Najbliži aerodrom je Aerodrom Nikola Tesla, udaljen 18 km od apartmana Sleep'n Drive, a smeštajni objekat nudi uslugu aerodromskog prevoza uz nadoknadu.</p>

							<p>Prema nezavisnim recenzijama, naši gosti obožavaju ovaj deo destinacije Beograd.</p>
                            
							<p>Govorimo vaš jezik!</p> -->
							
							<p id="pPoslednji">Rezervisite odmah:<br/><a target="blank" href="https://www.booking.com/hotel/rs/sleep-39-n-drive.sr.html"><img id="bookingSlika"src="images/BookingLogo.png" alt="Booking.com"/></a></p>
                        </div>

						<h3 id="galerijaNaslov">Fotografije</h3>
						<div id="galerija">
							<?php
								$upit="SELECT * FROM galerija WHERE vidljivost='1'";
								$rezultat=$konekcija->query($upit);
								
								if($rezultat){
									$podaci=$rezultat->fetchAll();
									$ispis="";
									foreach($podaci as $podatak){
										$ispis.="<a href='".$podatak->link_putanja."' class='fancyboxs' rel='galerija'><img src='".$podatak->slika_putanja."'/></a>";
									}
									echo $ispis;
								}
							?>
						</div>
						<div id="galerijaNevidljivo">
							<?php
								$upit="SELECT * FROM galerija WHERE vidljivost='0'";
								$rezultat=$konekcija->query($upit);
								
								if($rezultat){
									$podaci=$rezultat->fetchAll();
									$ispis="";
									foreach($podaci as $podatak){
										$ispis.="<a href='".$podatak->link_putanja."' class='fancyboxs' rel='galerija'><img src='".$podatak->slika_putanja."'/></a>";
									}
									echo $ispis;
								}
							?>	
							
						</div>
					</article>
				</div>
			</section>

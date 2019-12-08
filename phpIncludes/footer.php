<!-- Footer -->
<footer id="footer">
				<div class="inner">

					<h2>Kontaktirajte nas</h2>

						<?php
						if(isset($_SESSION['korisnik'])):
						?>
						<div class="field half first">
							<!-- <label for="name">Ime i prezime</label> -->
							<input name="name" id="nameKontakt" type="text" placeholder="Ime i prezime" value="<?php echo $_SESSION['korisnik']->imePrezime ?>" disabled>
							<span id="imeGreska">Unesite ime u ispravnom formatu (Veliko početno slovo, min.3, max.12, max.15(prezime).</span>
						</div>
						<div class="field half">
							<!-- <label for="email">Email</label> -->
							<input name="email" id="emailKontakt" type="email" placeholder="Email" value="<?php echo $_SESSION['korisnik']->email ?>" disabled>
							<span id="emailGreska">Unesite email u ispravnom formatu.</span>
						</div>
						<div class="field">
							<!-- <label for="message">Poruka</label> -->
							<textarea name="message" id="messageKontakt" rows="6" placeholder="Poruka"></textarea>
						</div>
						<ul class="actions">
							<li><input value="Pošalji poruku" class="button alt" type="button" id="kontaktPosalji" name="kontaktPosalji" onclick='obradaKontakt()'></li>
						</ul>






						<?php else: ?>
						<div class="field half first">
							<!-- <label for="name">Ime i prezime</label> -->
							<input name="name" id="nameKontakt" type="text" placeholder="Ime i prezime">
							<span id="imeGreska">Unesite ime u ispravnom formatu (Veliko početno slovo, min.3, max.12, max.15(prezime).</span>
						</div>
						<div class="field half">
							<!-- <label for="email">Email</label> -->
							<input name="email" id="emailKontakt" type="email" placeholder="Email">
							<span id="emailGreska">Unesite email u ispravnom formatu.</span>
						</div>
						<div class="field">
							<!-- <label for="message">Poruka</label> -->
							<textarea name="message" id="messageKontakt" rows="6" placeholder="Poruka"></textarea>
						</div>
						<ul class="actions">
							<li><input value="Pošalji poruku" class="button alt" type="button" id="kontaktPosalji" name="kontaktPosalji" onclick='obradaKontakt()'></li>
						</ul>
						<?php endif; ?>

					<ul class="icons">
						<li><a href="#" class="icon round fa-twitter"><span class="label">O autoru</span></a></li>
						<li><a href="#" class="icon round fa-facebook"><span class="label">Dokumentacija</span></a></li>
						<li><a href="#" class="icon round fa-instagram"><span class="label">Instagram</span></a></li>
					</ul>
					<ul id="linkoviKraj">
						<li><a href="index.php?stranica=autor">Autor</a></li>
						<li><a href="">Dokumentacija</a></li>
					</ul>

				</div>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

			<!--plugin-->
			<script type="text/javascript" src="fancybox-2.1.7/lib/jquery-1.10.2.min.js"></script>
        	<script type="text/javascript" src="fancybox-2.1.7/lib/jquery.mousewheel.pack.js"></script>
        	<link href="fancybox-2.1.7/source/jquery.fancybox.css" rel="stylesheet"/>
       		<script type="text/javascript" src="fancybox-2.1.7/source/jquery.fancybox.pack.js" ></script> 

			<script type="text/javascript">


				$(".fancyboxs").fancybox();
				$("#galerijaNevidljivo").hide();


				$('#dugmeSmanji').click(function(){
					$('#recenzijePolja').slideToggle("slow");
				});

				
				$(document).ready(function(){
					$('#kontakt').click(function(){
						$(document).scrollTop(1000);
					});
				});

				// $('#prviP').click(function(){
				// 	var x=$(this).text();
				// 	alert(x);
				// });




				// // Get the modal
				// var modal = document.getElementById('myModal');

				// // Get the button that opens the modal
				// var btn = document.getElementById("myBtn");

				// // Get the <span> element that closes the modal
				// var span = document.getElementsByClassName("close")[0];

				// // When the user clicks on the button, open the modal 
				// btn.onclick = function() {
				// modal.style.display = "block";
				// }

				// // When the user clicks on <span> (x), close the modal
				// span.onclick = function() {
				// modal.style.display = "none";
				// }

				// // When the user clicks anywhere outside of the modal, close it
				// window.onclick = function(event) {
				// if (event.target == modal) {
				// 	modal.style.display = "none";
				// }
				// }





				// window.onload=function(){
				// 	document.querySelector('#kontaktPosalji').addEventListener('click', obradaKontakt);
						
				// }





				function obradaKontakt(){
					
					var imeKontakt=document.querySelector('#nameKontakt').value.trim();
						var emailKontakt=document.querySelector('#emailKontakt').value;
						var porukaKontakt=document.querySelector('#messageKontakt').value.trim();

						var regImeKontakt = /^[A-ZČĆŠĐŽ][a-zčćšđž]{2,12}(\s[A-ZČĆŠĐŽ][a-zčćšđž]{2,15})+$/;
						var regEmailKontakt = /^[a-zA-Z0-9-_.]+@[a-zA-Z0-9]+(?:\.[a-zA-Z0-9]+)*$/;

						var kontaktGreske=[];						
						var kontaktIspravno=[];

						if(regImeKontakt.test(imeKontakt)){
							document.querySelector('#imeGreska').style.display="none";
							kontaktIspravno.push(imeKontakt);
							
						}
						else{
							kontaktGreske.push("Nepravilno ime");
							document.querySelector('#imeGreska').style.display="block";
						}

						if(regEmailKontakt.test(emailKontakt)){
							document.querySelector('#emailGreska').style.display="none";
							kontaktIspravno.push(emailKontakt);
						}
						else{
							kontaktGreske.push("Unesite email u ispravnom formatu.");
							document.querySelector('#emailGreska').style.display="block";
						}

						if(kontaktGreske==0){

							
							$.ajax({
								url:"kontaktObrada.php",
								type:"GET",
								dataType:"json",
								data:{
									ime:imeKontakt,
									email:emailKontakt,
									poruka:porukaKontakt,
									poslato:"poslati podaci"
								},
								success: function(){
									
								}
								
							});
						}
						else{
							
						}
				}


				function obradaAnketa(){
					var rbAnketa=$('.rbAnketa:checked').val();
					var chbAnketa=$('.chbAnketa:checked');
					var chbNiz=[];

					chbAnketa.each(function(){
						chbNiz.push($(this).val());
					});

					console.log(chbNiz);
					console.log(rbAnketa);

					if(rbAnketa==null||chbAnketa.length==0){
						$('#anketaGreske').html('Minimum jedno polje mora biti cekirano.');
					}
					else{
							$.ajax({
								urlPoslati:"anketaObrada.php",
								type:"GET",
								dataType:"json",
								// processData: false,
								data:{
									rb:rbAnketa,
									chb:chbNiz,
									porukaAnketa:" podaci"
								},
								success: function(){

								}
							});
			
					}

				
				
					

					// else
					// {
					// 	$.ajax({
					// 		url:"anketaObrada.php",
					// 		type:"GET",
					// 		dataType:"json",
					// 		data:{
					// 			rb:rbAnketa.value;
					// 			chb:chbAnketa.
					// 		},
					// 	});
					// }
				}

				


				 function provera(){
                    var imePrezime=document.querySelector("#imePrezime").value.trim();
					var email = document.querySelector('#eMail').value;
					var korIme = document.querySelector('#korisnickoIme').value;
					var lozinka = document.querySelector('#pasvord').value;
					var lozinkaPotvrda = document.querySelector('#pasvord2').value;
					var ddlDrzava = document.querySelector("#ddlDrzava").value;
					
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
	

					if(nizGreske.length>0){
							console.log(nizGreske);
							return false;
					}
					
					if(nizGreske.length==0){
						return true;
					}

				}

				function recenzijaProvera(){
					var ddlOcena = document.querySelector("#ddlOcena").value;
					var komentar = document.querySelector("#taOcena").value.trim();

					if(ddlOcena == "0"){
							document.querySelector("#ocenaGreska").style.display="block";
							return false;
					}
					else{
						document.querySelector("#formaUnosRecenzije").style.display="none";
						return true;
					}
				}

				// function obrisi(id){

					
				// 	$.ajax({
				// 		url:"brisanje.php",
				// 		type:"get",
				// 		dataType:"json",
				// 		data:{
				// 			id:id
						
				// 		},
				// 		success:function(data){

				// 		},
				// 		error: function(){

				// 		}
				// 	});
				// }

				


			</script>

	</body>
</html>
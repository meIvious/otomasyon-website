<?php 
include("vt.php"); // veritabanı bağlantımızı sayfamıza ekliyoruz. 
include("fonksiyon.php");
$aracdetay=new iskelet;
?>
<!DOCTYPE HTML>
<html lang="tr">
	<head>
		<title>Eser Hayvancılık</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		  <!-- Favicons --> 
		  <link rel="icon" type="image/png" href="images/e.jpg"/>
		  
		  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/4.0.0/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js'></script><script  src="./script.js"></script>

<script language="javascript">
function mesaj() {
alert ("Mesajınız gönderildi!")
}
</script>




	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<?php include("includes/menu.php"); ?>

				<!-- Banner -->
					<section id="banner" class="major">
						<div class="inner">
							<header class="major">
								<h1>Eser Hayvancılık ve Kurbancılık</h1>
							</header>
							<div class="content">
								<p>Büyük baş kurbanlık ve hisse bulunur&nbsp;&nbsp;&nbsp;&nbsp;</p>
								<ul class="actions">
									<li><a href="#one" class="button next scrolly">Başla !</a></li>
								</ul>
							</div>
						</div>
					</section>

				<!-- Main -->
					<div id="main">
					
                  <div class="major">
			          <?php
			            $aracdetay->araclaricek($db);
			          ?>
			      </div>
						<!-- One -->
							<section id="one" class="tiles">
							
						
							
								
							</section>

						<!-- Two -->
							<section id="two">
								<div class="inner">
									<header class="major">
										<h2>Hakkımızda</h2>
									</header>
									<p>Siz değerli müşterilerimiz için kaliteli yemlerle veteriner kontrolünde özenle beslediğimiz büyükbaş kurbanlıklarımız satışa sunulmuştur.</p>
									<ul class="actions">
										<li><a href="about.php" class="button next">Daha Fazla</a></li>
									</ul>
								</div>
							</section>

					</div>

				<!-- inquiry -->
					<section id="contact">
						<div class="inner">
							<section>
								<header class="major">
									<h2>Bilgi Formu</h2>
								</header>

								<form action="index.php" method="POST">
									<div class="fields">
										<div class="field half">
											
										</div>
                                        
										<div class="field">
											<label for="name">Ad-Soyad</label>
											<input type="text" name="adsoyad" id="name" />
										</div>

										<div class="field half">
											<label for="email">E-Posta</label>
											<input type="text" name="eposta" id="email" />
										</div>

										<div class="field half">
											<label for="phone">Telefon Numarası</label>
											<input type="text" maxlength="11" name="telno" id="phone" />
										</div>

										<div class="field">
											<label for="message">Mesaj</label>
											<textarea name="mesaj" id="message" rows="3"></textarea>
										</div>
										<div class="text-right" style="padding:30px;">
											<label>&nbsp;</label>
											<p style="color:yellow">* Lütfen Tüm Bilgileri Doldurduğunuzdan Emin Olun.</p>
											<ul class="actions">
											<li onclick="mesaj()"><input type="submit"  value="🚀 Gönder" class="primary" /></li>			
											</ul>													
										</div>

										
									</div>
									
<?php
									if ($_POST) { // Sayfada post olup olmadığını kontrol ediyoruz.

// Sayfa yenilendikten sonra post edilen değerleri değişkenlere atıyoruz
$adsoyad = $_POST['adsoyad'];
$eposta = $_POST['eposta'];
$telno = $_POST['telno'];
$mesaj = $_POST['mesaj'];

if ( $adsoyad<>"" && $eposta<>"" && $telno<>"") { 
// Veri alanlarının boş olmadığını kontrol ettiriyoruz. Başka kontrollerde yapabilirsiniz.
	
	 // Veri ekleme sorgumuzu yazıyoruz.
	if ($baglanti->query("INSERT INTO iletisim(adsoyad,eposta,telno,mesaj) VALUES ('$adsoyad','$eposta','$telno','$mesaj')")) 
	{
				 // Eğer veri eklendiyse eklendi yazmasını sağlıyoruz.
				 echo "Mesajınız Gönderildi";
	}

	else
	{
		echo "Hata oluştu";
	}

}

}

?>
								</form>
							</section>
							<section class="split">
								<section>
									<div class="contact-method">
										<span class="icon alt fa-envelope"></span>
										<h3>E-Posta</h3>
										<p><a href="mailto:bilgi@demirpolatrenty.com">ferdi.eser@icloud.com</a></p>
									</div>
								</section>
								<section>
									<div class="contact-method">
										<span class="icon alt fa-phone"></span>
										<h3>Telefon</h3>
										<p><a href="tel:+(05XX) XXX XX XX">(0538) 738 78 14</a> - (Ferdi ESER)</p>
										<br>
									</div>
								</section>
								<section>
									<div class="contact-method">
										<span class="icon alt fa-home"></span>
										<h3>Adres</h3>
										<span>Aşçıoğlu kır et lokantası karşısı <br />
										Abdiağa köyü <br />
										Biga/Çanakkale
										17200</span>
									</div>
								</section>
							</section>
						</div>
					
					</section>
				<!-- Footer -->
				</br>
					<center><footer id="footer">
						<div class="inner">
							<ul class="icons">
								<li><a href="https://www.facebook.com/profile.php?id=100008167359129" class="icon alt fa-facebook"><span class="label">Facebook</span></a></li>
								<li><a href="https://www.instagram.com/ferdiberkecan/" class="icon alt fa-instagram"><span class="label">Instagram</span></a></li>
							</ul>
							<ul class="copyright">
								<li>Designed By&nbsp;&nbsp;<a href="https://www.instagram.com/berkaykuru17/">Berkay KURU  </a> |  <a href="https://www.instagram.com/kerem_kacak/">Kerem KAÇAK</a> |   &nbsp;&nbsp; &nbsp;&copy; 2020 Tüm Hakları Saklıdır.</li>
							</ul>
						</div>
					</footer></center>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>

</html>







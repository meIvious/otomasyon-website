<?php 
include("vt.php"); // veritabanı bağlantımızı sayfamıza ekliyoruz. 
?>


<!DOCTYPE HTML>
<!--
	Forty by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Eser Hayvancılık | İletişim</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		  <!-- Favicons --> 
		  <link rel="icon" type="image/png" href="images/e.jpg"/>

<script language="javascript">
function mesaj() {
alert ("Mesajınız gönderildi!")
}
</script>


	</head>
	<body class="is-preload">

<!--End of Tawk.to Script-->

		<!-- Wrapper -->
			<div id="wrapper">

				<?php include("includes/menu.php"); ?>

				<!-- Main -->
					<div id="main" class="alt">

						<!-- One -->
							<section id="one">
								<div class="inner">
									<header class="major">
										<h1>İletişim</h1>
									</header>
									<span class="image main"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24991.968477021295!2d27.241765864619957!3d40.212823892150126!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDDCsDEyJzQ0LjgiTiAyN8KwMTUnMTEuOSJF!5e1!3m2!1str!2str!4v1614416725385!5m2!1str!2str" width="600" height="450" frameborder="0"  class="image main" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe></span>
									<center><p>Çanakkale şehir merkezine yaklaşık 100 km. ve Biga ilçe merkezine bağlı Abdiağa Köyü'nde Aşçıoğlu Kır Et Lokantası karşısında bulunmaktayız.</p></center>
								</div>
							</section>

					</div>

				<!-- Contact -->
					<section id="contact">
						<div class="inner">
							<section>
								<header class="major">
									<h2>İletişim Formu</h2>
								</header>

								<form method="post" action="contact.php">
									<div class="fields">
										<div class="field">
											<label for="name">Ad-Soyad</label>
											<input type="text" name="adsad" id="name" />
										</div>
										<div class="field half">
											<label for="email">E-Posta</label>
											<input type="text" name="e_posta" id="email" />
										</div>
										<div class="field half">
											<label for="phone">Telefon Numarası</label>
											<input type="text"  maxlength="11" name="telefon" id="phone" />
										</div>

										<div class="field">
											<label for="message">Mesaj</label>
											<textarea name="mesajil" id="message"  rows="6"></textarea>
										</div>

										<div class="field text-right">
											<label>&nbsp;</label>
											<p style="color:yellow">* Lütfen Tüm Bilgileri Doldurduğunuzdan Emin Olun.</p>
											<ul class="actions">
												<li onclick="mesaj()"><input type="submit" value="🚀 Gönder " class="primary" /></li>
											</ul>
										</div>
									</div>
									<?php
									if ($_POST) { // Sayfada post olup olmadığını kontrol ediyoruz.

// Sayfa yenilendikten sonra post edilen değerleri değişkenlere atıyoruz
$adsad = $_POST['adsad'];
$e_posta = $_POST['e_posta'];
$telefon = $_POST['telefon'];
$mesajil = $_POST['mesajil'];

if ($adsad<>"" && $e_posta<>"" && $telefon<>"") { 
// Veri alanlarının boş olmadığını kontrol ettiriyoruz. Başka kontrollerde yapabilirsiniz.
	
	 // Veri ekleme sorgumuzu yazıyoruz.
	if ($baglanti->query("INSERT INTO iletisim(adsoyad,eposta,telno,mesaj) VALUES ('$adsad','$e_posta','$telefon','$mesajil')"))
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
							<class="icons">
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
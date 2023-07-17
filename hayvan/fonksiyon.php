<?php
$db = new mysqli("localhost", "root", "", "eser")or die ("Bağlanamadı");
$db->set_charset("utf8");
?>
<html>
<head>
		<title>EserHayvancılık</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		 <!-- Favicons --> 
		 <link rel="icon" type="image/png" href="images/e.jpg"/>
	</head>
<?php

class iskelet{

    public function sorgum($vt,$sorgu,$tercih) {
      $a=$sorgu;
      $b=$vt->prepare($a);//yazılmış olan sorguyu ön belleğe atar,güvenlik içinde kullanılır
      $b->execute();//sorguyu calıstır
      if($tercih==1): //eger tercih eşitse 1 bana getresultu ver
      return	$c=$b->get_result();//sonucu aktarma
      endif;
    }     //ilk sorgum
	public function sorgum2($vt,$sorgu,$tercih) {
	$a=$sorgu;
	$b=$vt->prepare($a);
	$b->execute();
	if($tercih==1):
	return	$c=$b->get_result();
	endif;
}

    //masalaricek.....................................................................
    function araclaricek($dv) {
    $araclar="select * from tip";
    $sonuc=$this->sorgum($dv,$araclar,1);
 ?>  
<section id="one" class="tiles"><?php
    while($aracsonuc=$sonuc->fetch_assoc())://masasonuc verisini aktar veri oldukça bu divden oluştur.

      echo ' 
	  	
	  <article>
									<span class="image">
										<img src="'.$aracsonuc["resimyolu"].'" alt="" />
									</span>
									<header class="major">
										<h3><center>'.$aracsonuc["kategori"].'</center></h3>
<div class="p-1 align-center text-white" id="id"><strong>Yaş:&nbsp'.$aracsonuc["marka"].'</br> Hastalık Durumu:&nbsp'.$aracsonuc["model"].'</br> Aşı Durumu:&nbsp'.$aracsonuc["plaka"].'</br> Kurbanlık Durumu:&nbsp'.$aracsonuc["kurban"].'</strong><p></strong></p></div>
										<div class="major-actions">
											<a href="#contact" class="button small next scrolly">İletişime Geç&nbsp</a>
										</div>
									</header>
								</article>
									
            
			
			
			
			';
		
    endwhile;
	?>	</section>
		<?php
  
  }
}
?>
<html>

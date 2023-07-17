<?php
	include("yonetimfonk.php");
	$yonetimclas=new yonetici;
	$yonetimclas->cookcon($vt,false);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" type="image/png" href="images/e.jpg"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script src="../dosyalar/jquery.js"></script>
<link rel="stylesheet" href="../dosyalar/bootstrap.css" >
<link rel="stylesheet" href="../dosyalar/style.css" >
 <link href="../dosyalar/font-awesome/css/all.css" rel="stylesheet">
 <link href="../dosyalar/font-awesome/webfonts" rel="stylesheet">

<title>EserHayvancılık | Admin Panel</title>
</head>
<style>

	.container-fluid,
	.row-fluid{
		height: inherit;
	}
	a:link, a:visited, a:active {
	font-family:Comic Sans MS;
	font-size: 18px;
	color :#000000;
	text-decoration : none;
	}

#btnyonetim2:hover a{
	color:		#FF3D00;
}
#btnyonetim2:hover {
	background-color:#EEEEEE;
}
#div1{
		background-color:#fff;
		border:1px; solid #F1F1F1;
		border-radius: 15px;
			min-height: 100%;
}
#div3{
		height:80px;
		font-size:20px;
			border-radius:10px;
		font-family:Comic Sans MS;
		background-color: #fff;

}

#div4{
	background-color:#fff;
	min-height:133px;
}

h4{
		color:#5e72e4;
}


</style>
<body>
	<div class="container-fluid ">
  <div class="row row-fluid">
  <div class="col-md-2  border-right">
		<div class="row" >
			<div class="col-md-12  p-4 mx-auto text-center weight-bold"><br>
			<?php 
			$kul1=$_COOKIE["kul"];
			echo '<h4><i class="fas fa-user" style="color:#000"></i> ADMIN<hr color="#0000F8"/>'.$kul1.'<h4>'
			?>
		</div>
	</div><br>
	<div class="row" >
	<div class="col-md-12 p-3 pl-3 border-top" id="btnyonetim2">
		 <a href="index.php"> <i class="fas fa-home" style="color:#black"></i>  Anasayfa</a>
		</div>
		 <div class="col-md-12 p-3 pl-3 border-top" id="btnyonetim2">
		 <a href="ayarlar.php?islem=kulyonetimi"> <i class="fas fa-users" style="color:#2E7D32"></i>  Kullanıcı Yönetimi</a>
		</div>
		<div class="col-md-12  p-3 pl-3 border-top border-top "id="btnyonetim2">
		<a href="ayarlar.php?islem=iletisimyonetimi" ><i class="fas fa-clipboard-list"style="color:	#800080"></i> İletişim  Bilgileri</a>
		</div>
		<div class="col-md-12 p-3 pl-3 border-top" id="btnyonetim2">
		 <a href="ayarlar.php?islem=aracyon"> <i class="fas fa-democrat" style="black"></i>  Hayvan Bilgileri</a>
		</div>
		<div class="col-md-12 p-3 pl-3 border-top" id="btnyonetim2">
		 <a href="ayarlar.php?islem=resimyon"> <i class="fas fa-images" style="color:#ff7f00"></i>  Resim Ayarları</a>
		</div>
		<div class="col-md-12  p-3 pl-3 border-top "id="btnyonetim2">
		<a href="ayarlar.php?islem=sifredegistir" ><i class="fas fa-lock"style="color:#DD2C00"></i> Şifre Değişikliği</a>
		</div>
		<div class="col-md-12  p-3 pl-3 border-top border-bottom "id="btnyonetim2">
		<a href="ayarlar.php?islem=cikis" ><i class="fas fa-door-open"style="color:	#0D47A1"></i> Çıkış</a>
		</div>
</div>
		</div>

  <div class="col-md-10 ">
		<div class="row">
		<div class="col-md-12">
			<div class="row " id="div4">
			<div id="clock"></div> <script type="text/javascript">
function refrClock()
{
var d=new Date();
var s=d.getSeconds();
var m=d.getMinutes();
var h=d.getHours();
var day=d.getDay();
var date=d.getDate();
var month=d.getMonth();
var year=d.getFullYear();
var days=new Array("Pazar","Pazartesi","Salı","Çarşamba","Perşembe","Cuma","Cumartesi");
var months=new Array("Ocak","Şubat","Mart","Nisan","Mayıs","Haziran","Temmuz","Ağustos","Eylül","Ekim","Kasım","Aralık");
if (s<10) {s="0" + s}
if (m<10) {m="0" + m}
document.getElementById("clock").innerHTML= "&nbsp<b>Tarih:</b> " + date + " " + months[month] + " " + year + "  <b></b> " + days[day] + " | <b>Saat:</b> " + h + ":" + m + ":" + s + " "
setTimeout("refrClock()",1000);
}
refrClock();
</script>
		</div>

	<div class="col-md-12" id="div1">

	<div class="col-md-12 mt-4" id="div1">

	  <?php
	  @$islem=$_GET["islem"];
	  switch ($islem) :
///////////////////////////// YÖNETİM///////////////////////

      case "iletisimyonetimi":
	    $yonetimclas->iletisimyonetimi($vt);
	    break;
	   
	  case "iletisimsil":
		$yonetimclas->iletisimsil($vt);
		break;

	  case "kulyonetimi":
		$yonetimclas->kulyonetimi($vt);
		break;

		case "kullanıcınekle":
			$yonetimclas->kullanıcınekle($vt);
			break;

      case "kulsil":
		$yonetimclas->kulsil($vt);
		break;

      case "odaguncelle":
		$yonetimclas->odaguncelle($vt);
		break;

	  case "odaekle":
		$yonetimclas->odaekle($vt);
		break;
////////////////////////////////////////////////////////////////
	  case "aracyon":
		$yonetimclas->aracyon($vt);
		break;

      case "aracsil":
		$yonetimclas->aracsil($vt);
		break;

      case "aracguncelle":
		$yonetimclas->aracguncelle($vt);
		break;

	  case "aracekle":
		$yonetimclas->aracekle($vt);
		break;


		case "konumyon":
			$yonetimclas->konumyon($vt);
			break;
	
		  case "konumsil":
			$yonetimclas->konumsil($vt);
			break;
	
		  case "konumguncelle":
			$yonetimclas->konumguncelle($vt);
			break;
	
		  case "konumekle":
			$yonetimclas->konumekle($vt);
			break;
////////////////////////////////////////////////////////////////
	  case "resimyon":
		$yonetimclas->resimyon($vt);
		break;

      case "resimsil":
		$yonetimclas->resimsil($vt);
		break;
		
	  case "resimekle":
		$yonetimclas->resimekle($vt);
		break;

	  case "resimgüncelle":
		$yonetimclas->resimgüncelle($vt);
		break;
		
////////////////////////////////////////////////////////////////

		case "rezervasyonyonetimi":
      $yonetimclas->rezervasyonyonetimi($vt);
        break;
				case "rezervasyonsil":
			$yonetimclas->rezervasyonsil($vt);
			break;
			////////////////////////////////////////////////////////////////

					case "uyeyonetimi":
			      $yonetimclas->uyeyonetimi($vt);
			        break;
							case "uyesil":
						$yonetimclas->uyesil($vt);
						break;


///////////////////////////////////////////////////////////////////
		case "rapor":
      $yonetimclas->rapor($vt);
        break;
///////////////////////////////////////////////////////////////////
			case "sifredegistir":
        $yonetimclas->sifredegistir($vt);
          break;
///////////////////////////////////////////////////////////////////
	  case "cikis":
	  $yonetimclas->cikis($yonetimclas->kulad($vt));
	  break;
	  endswitch;
	  ?>

	 		</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
</body>
</html>

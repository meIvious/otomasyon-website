<?php
ob_start();
$vt=new mysqli("localhost", "root", "", "eser") or die ("Baglanamadı");
$vt->set_charset("utf8")
?>
<html>
<head>
<script>
$(function () {
    $("#btn-load").click(function () {
      var btn = $(this);
      btn.button('loading');
      var resetButton = function () {
        btn.button('reset');
      };
      window.setTimeout(resetButton, 2000);
    });
  });
<script>
</head>
<html>
<?php
class yonetici {
    protected  $toplamsayi,$toplamSayfamiz,$limitimiz,$gosAdet;

    function sayfalama ($deger1,$deger2) {
	
		$this->toplamsayi=$deger1; //**
		$this->gosAdet=$deger2; //**
			
		$this->toplamSayfamiz=ceil($deger1 / $this->gosAdet) + 1;			
		
			  						
		$sayfa=isset($_GET["hareket"]) ? (int) $_GET["hareket"] : 1;		
		if ($sayfa<1) $sayfa=1;				
		if ($sayfa > $this->toplamSayfamiz) $sayfa = $this->toplamSayfamiz;		
		$this->limitimiz=($sayfa - 1 ) * $this->gosAdet;	 //**	
	
	
	
}


  private function sorgum3 ($dv,$sorgu){
		$sorgum=$dv->prepare($sorgu);
		$sorgum->execute();
		return $sorguson=$sorgum->get_result();
	}


  private function uyari($tip,$metin,$sayfa){
		echo '<div class="alert alert-'.$tip.'">'.$metin.'</div>';
		header('refresh:2,url='.$sayfa.'');
    }
    
    


  //////////////////////// Oda yönetimi ve listeleme fonksiyonu///////////////////
    public function kulbilgi ($vt) {
        $so=$this->sorgum3($vt, "select * from eser");

        echo '<table class="table text-center table-striped table-bordered mx-auto col-md-10 mt-4">
        <thead>
            <tr>
                <th scope="col">KONUM</th>
                <th scope="col">TİP</th>
                <th scope="col">BAŞLANGIÇ TARİHİ</th>
                <th scope="col">BİTİŞ TARİHİ</th>
                <th scope="col">AD-SOYAD</th>
                <th scope="col">E-POSTA</th>
                <th scope="col">TELEFON NUMARASI</th>
                <th scope="col">MESAJ</th>
                <th scope="col">SİL</th>
            </tr>
        </thead>
        <tbody>';

        while ($sonuc=$so->fetch_assoc()):
            echo    '<tr>
                        <td>'.$sonuc["konum"].'</td>
                        <td>'.$sonuc["tip"].'</td>
                        <td>'.$sonuc["bastar"].'</td>
                        <td>'.$sonuc["bittar"].'</td>
                        <td>'.$sonuc["adsoyad"].'</td>
                        <td>'.$sonuc["eposta"].'</td>
                        <td>'.$sonuc["telno"].'</td>
                        <td>'.$sonuc["mesaj"].'</td>
                        <td><a href = "ayarlar.php?islem=kulsil&kulid='.$sonuc["id"].'" class="btn btn-danger" data-confirm="Odayı silmek istediğinize emin misiniz?"</a>Sil</td>
                    </tr>';

        endwhile;

        echo '</tbody>
            </table>';

    }


  public function kulyonetimi ($vt) {
    $this->sayfalama($this->sorgum3($vt,"select * from yonetici")->num_rows,3);
    $so=$this->sorgum3($vt, "select * from yonetici LIMIT ".$this->limitimiz.",".$this->gosAdet."");

      echo '<table class="table text-center table-striped table-bordered mx-auto col-md-12 mt-4">
      <thead>
      <p class="card-text text-center text-danger border-bottom">
      * Sadece yönetici eklemek ve silmek için kullanınız. <br/>
      </p>
      <th scope="col"><a href = "ayarlar.php?islem=kullanıcınekle" class="btn btn-success text-white">+</a>&nbsp KULLANICI ADI</th>
      <th scope="col">SİL</th>
      </thead>
      <tbody>';

      while ($sonuc=$so->fetch_assoc()):
          echo    '<tr>
          <td>'.$sonuc["kulad"].'</td>
        <td><a href = "ayarlar.php?islem=kulsil&id='.$sonuc["id"].'" class="btn btn-danger text-white"</a>Sil</td>
                  </tr>';

      endwhile;

      echo '</tbody>

      <tr>		
      <td colspan="5">
      <nav aria-label="Page navigation example">
      
              <ul class="pagination mx-auto">';
                          
              $link="ayarlar.php?islem=kulyonetimi";
              
          
                  for ($s=1; $s<$this->toplamSayfamiz; $s++) :
                      
                      echo '<li class="page-item">
                      
                      <a class="page-link" href="'.$link.'&hareket='.$s.'">'.$s.'</a>					
                      
                      </li>';
                      
                      endfor;
  
              
              echo '</ul></nav>
      
      
      </td>
  
      </tr>
  
          </table>';

  }


  public function kullanıcınekle($vt) {
    @$buton=$_POST["buton"];
    echo '<div class="col-md-3 text-center mx-auto mt-5 table-bordered">';
    if($buton):
            @$kulad=htmlspecialchars($_POST["kulad"]);
            @$kulsifre=htmlspecialchars($_POST["kulsifre"]);
            $kulsifre1=md5(sha1(md5($kulsifre)));

            if($kulad=="" || $kulsifre1=="") :
                $this->uyari("danger","bilgiler boş olamaz","ayarlar.php?islem=kulyonetimi");
            else:
                $this->sorgum3($vt,"insert into yonetici (kulad,sifre) VALUES ('$kulad','$kulsifre1')");
                $this->uyari("success","Kullanıcı Eklendi","ayarlar.php?islem=kulyonetimi");
            endif;

    else:
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
    <?php
    echo'
<div class="col-md-12 table-light border-bottom"><h4>Kullanıcı Ekle</h4></div>
<div class="col-md-12 table-light">Kullanıcı Adı<input type="text" name="kulad" class="form-control mt-3" require /></div>
<div class="col-md-12 table-light">Şifresi<input type="text" name="kulsifre" class="form-control mt-3" require /></div>
<div class="col-md-12 table-light"><input name="buton" type="submit" class="btn btn-success mt-3 mb-3" /></div>
</form>
';
endif;
echo'</div>';
}




  public function kulsil ($vt) {
     $kulid= $_GET["id"];

     if ($kulid != "" && is_numeric($kulid)):
         $this->sorgum3($vt, "delete from yonetici where id=$kulid");
         $this->uyari("success", "Kullanıcı Silindi", "ayarlar.php?islem=kulyonetimi");
     else:
         $this->uyari("danger", "Hata Oluştu", "ayarlar.php?islem=kulyonetimi");

     endif;
 }




 public function iletisimbilgi ($vt) {
     $this->sayfalama($this->sorgum3($vt,"select * from iletisim")->num_rows,3);
    $so=$this->sorgum3($vt, "select * from iletisim LIMIT".$this->limitimiz.",".$this->gosAdet."");

    echo '<table class="table text-center table-striped table-bordered mx-auto col-md-10 mt-4">
    <thead>
        <tr>
            <th scope="col">AD-SOYAD</th>
            <th scope="col">E-POSTA</th>
            <th scope="col">TELEFON NUMARASI</th>
            <th scope="col">MESAJ</th>
            <th scope="col">SİL</th>
        </tr>
    </thead>
    <tbody>';

    while ($sonuc=$so->fetch_assoc()):
        echo    '<tr>
                    <td>'.$sonuc["adsoyad"].'</td>
                    <td>'.$sonuc["eposta"].'</td>
                    <td>'.$sonuc["telno"].'</td>
                    <td>'.$sonuc["mesaj"].'</td>
                    <td><a href = "ayarlar.php?islem=iletisimsil&kulid='.$sonuc["id"].'"</a>Sil</td>
                </tr>';

    endwhile;

    echo '</tbody>

    <tr>		
    <td colspan="5">
    <nav aria-label="Page navigation example">
    
            <ul class="pagination mx-auto">';
                        
            $link="ayarlar.php?islem=iletisimyonetimi";
            
        
                for ($s=1; $s<$this->toplamSayfamiz; $s++) :
                    
                    echo '<li class="page-item">
                    
                    <a class="page-link" href="'.$link.'&hareket='.$s.'">'.$s.'</a>					
                    
                    </li>';
                    
                    endfor;

            
            echo '</ul></nav>
    
    
    </td>

    </tr>

        </table>';

}


public function iletisimyonetimi ($vt) {
    $this->sayfalama($this->sorgum3($vt,"select * from iletisim")->num_rows,5);
    $so=$this->sorgum3($vt, "select * from iletisim LIMIT ".$this->limitimiz.",".$this->gosAdet."");
  echo '<table class="table text-center table-striped table-bordered mx-auto col-md-12 mt-4">
  <thead>
  <th scope="col">AD-SOYAD</th>
  <th scope="col">E-POSTA</th>
  <th scope="col">TELEFON NUMARASI</th>
  <th scope="col">MESAJ</th>
  <th scope="col">SİL</th>
  </thead>
  <tbody>';

  while ($sonuc=$so->fetch_assoc()):
      echo    '<tr>
      <td>'.$sonuc["adsoyad"].'</td>
      <td>'.$sonuc["eposta"].'</td>
      <td>'.$sonuc["telno"].'</td>
      <td>'.$sonuc["mesaj"].'</td>
    <td><a href = "ayarlar.php?islem=iletisimsil&id='.$sonuc["id"].'" class="btn btn-danger text-white"</a>Sil</td>
              </tr>';

  endwhile;

  echo '</tbody>

  <tr>		
  <td colspan="5">
  <nav aria-label="Page navigation example">
  
          <ul class="pagination mx-auto">';
                      
          $link="ayarlar.php?islem=iletisimyonetimi";
          
      
              for ($s=1; $s<$this->toplamSayfamiz; $s++) :
                  
                  echo '<li class="page-item">
                  
                  <a class="page-link" href="'.$link.'&hareket='.$s.'">'.$s.'</a>					
                  
                  </li>';
                  
                  endfor;

          
          echo '</ul></nav>
  
  
  </td>

  </tr>



      </table>';

}



public function iletisimsil ($vt) {
 $kulid= $_GET["id"];

 if ($kulid != "" && is_numeric($kulid)):
     $this->sorgum3($vt, "delete from iletisim where id=$kulid");
     $this->uyari("success", "Mesaj Silindi", "ayarlar.php?islem=iletisimyonetimi");
 else:
     $this->uyari("danger", "Hata Oluştu", "ayarlar.php?islem=iletisimyonetimi");

 endif;
}





  function kulad($db){
    $deger=$_COOKIE["kul"];  
    $sorgu="select * from yonetici where kulad='$deger'";
    $gelensonuc=$this->sorgum3($db,$sorgu);
    $b=$gelensonuc->fetch_assoc();
    return $b["kulad"];
  }

  function cikis ($deger) {
    $deger=md5(sha1(md5($deger)));
    setcookie("kul",$deger, time() - 10);
    $this->uyari("success","Çıkış yapılıyor","index.php");
  }


  public   function giriskontrolu($r,$k,$s){
      $sonhal=md5(sha1(md5($s)));
      $sorgu="select * from yonetici where kulad='$k' and sifre='$sonhal'";
      $sor=$r->prepare($sorgu);
      $sor->execute();
      $sonbilgi=$sor->get_result();

      if($sonbilgi->num_rows==0):

        $this->uyari("danger","Bilgiler Hatalı","index.php");
        else:
        $this->uyari("success","Giriş Yapılıyor","ayarlar.php");

      $kulson=$k;
      setcookie("kul",$kulson,time() + 60*60*24);
      endif;
    }

    public  function cookcon($d,$durum=false) {
  		if(isset($_COOKIE["kul"])) :

  		 $deger=$_COOKIE["kul"];

       $sorgu="select * from yonetici where kulad='$deger'";
  		 $sor=$d->prepare($sorgu);
  		 $sor->execute();
  		 $sonbilgi=$sor->get_result();
       $veri=$sonbilgi->fetch_assoc();
       $sonhal=$veri["kulad"];
  		 if ($sonhal!=$_COOKIE["kul"]):
  		setcookie("kul",$deger, time() - 10);
  		  header("Location:index.php");
      else:
       if ($durum==true) : header("Location:ayarlar.php"); endif;
     endif;

   else:
   if($durum==false) : header("Location:index.php");
  	endif;
  	endif;
  }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function sifredegistir ($vt) {

            @$buton = $_POST["buton"];

            if ($buton) :
                    // db işlemleri
                    @$eskisifre = htmlspecialchars($_POST["eskisifre"]);
                    @$yeni1 = htmlspecialchars($_POST["yeni1"]);
                    @$yeni2 = htmlspecialchars($_POST["yeni2"]);

                    if ($eskisifre == "" || $yeni1 == "" || $yeni2 == "") :
                        $this->uyari("danger", "Bilgiler boş olamaz", "ayarlar.php?islem=sifredegistir");

                    else:
                        $eskisifreson=md5(sha1(md5($eskisifre)));
                        $deger=$_COOKIE["kul"];
                        if($this->sorgum3($vt, "select * from yonetici where sifre = '$eskisifreson' and kulad='$deger'")->num_rows == 0) :
                            //Kayıt yoksa eski şifre hatalı
                            $this->uyari("danger", "Eski şifre hatalı", "ayarlar.php?islem=sifredegistir");

                        elseif($yeni1 != $yeni2):
                            $this->uyari("danger", "Yeni şifreler aynı değil", "ayarlar.php?islem=sifredegistir");

                        else:
                            $yenisifre=md5(sha1(md5($yeni1)));
                            $deger=$_COOKIE["kul"];
                            $this->sorgum3($vt, "update yonetici set sifre = '$yenisifre' where kulad='$deger' ");
                            $this->uyari("success", "Şifre Değiştirildi", "ayarlar.php");

                        endif;

                    endif;

            else:
                ?>

                <div class="col-md-3 text-center mx-auto mt-5 table-bordered">
                        <form action = "<?php $_SERVER['PHP_SELF'] ?>" method = "post">
                <?php
                        echo '<div class="col-md-12 table-light border-bottom"><h4>ŞİFRE DEĞİŞTİR</h4></div>
                            <div class="col-md-12 table-light"><input type = "text" name = "eskisifre" class = "form-control mt-3" require placeholder="Eski Şifreniz"/></div>
                            <div class="col-md-12 table-light"><input type = "text" name = "yeni1" class = "form-control mt-3" require placeholder="Yeni Şifreniz"/></div>
                            <div class="col-md-12 table-light"><input type = "text" name = "yeni2" class = "form-control mt-3" require placeholder="Yeni Şifreniz Tekrar"/></div>
                            <div class="col-md-12 table-light"><input name = "buton" value = "Değiştir" type = "submit" class = "btn btn-success mt-3 mb-3"/></div>

                        </form>
                    </div>';

            endif;
        }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		public function aracyon ($vt) {
        $this->sayfalama($this->sorgum3($vt,"select * from tip")->num_rows,4);
        $so=$this->sorgum3($vt, "select * from tip LIMIT ".$this->limitimiz.",".$this->gosAdet."");

        echo '<table class="table text-center table-striped table-bordered mx-auto col-md-12 mt-4">
        <thead>
            <tr>
                <th scope="col">CİNS <a href = "ayarlar.php?islem=aracekle" class="btn btn-success">+</a></th>
				<th scope="col">YAŞ</th>
				<th scope="col">HASTALIK DURUMU</th>
                <th scope="col">AŞI DURUMU</th>
                <th scope="col">KURBANLIK DURUMU</th>
				<th scope="col">KÜPE NO</th>
                <th scope="col">MUAYENE TARİHİ</th>
				<th scope="col">GÜNCELLE</th>
                <th scope="col">SİL</th>
            </tr>
        </thead>
        <tbody>';

        while ($sonuc=$so->fetch_assoc()):
            echo    '<tr>
                        <td>'.$sonuc["kategori"].'</td>
						<td>'.$sonuc["marka"].'&nbspyaşında</td>
						<td>'.$sonuc["model"].'</td>
                        <td>'.$sonuc["plaka"].'</td>
                        <td>'.$sonuc["kurban"].'</td>
						<td>'.$sonuc["saseno"].'</td>
                        <td>'.$sonuc["muayene"].'</td>
                        <td><a href = "ayarlar.php?islem=aracguncelle&aracid='.$sonuc["id"].'" class="btn btn-warning"</a>Güncelle</td>
                        <td><a href = "ayarlar.php?islem=aracsil&aracid='.$sonuc["id"].'" class="btn btn-danger"</a>Sil</td>
                    </tr>';

        endwhile;

        echo '</tbody>

        <tr>		
		<td colspan="9">
		<nav aria-label="Page navigation example">
		
				<ul class="pagination mx-auto">';
							
				$link="ayarlar.php?islem=aracyon";
				
			
					for ($s=1; $s<$this->toplamSayfamiz; $s++) :
						
						echo '<li class="page-item">
						
						<a class="page-link" href="'.$link.'&hareket='.$s.'">'.$s.'</a>					
						
						</li>';
						
						endfor;

				
				echo '</ul></nav>
		
		
		</td>
	
		</tr>



            </table>';

    }

////////////////////////// Yönetici masa sil fonksiyonu///////////////////
    public function aracsil ($vt) {
        $aracid = $_GET["aracid"];

        if ($aracid != "" && is_numeric($aracid)):
            $this->sorgum3($vt, "delete from tip where id=$aracid");
            $this->uyari("success", "Hayvan Silindi", "ayarlar.php?islem=aracyon");
        else:
            $this->uyari("danger", "Hata Oluştu", "ayarlar.php?islem=aracyon");

        endif;
    }

/////////////////////// Yönetici masa güncelle fonksiyonu/////////////////
    public function aracguncelle($vt) {

        @$buton = $_POST["buton"];

        echo '<div class="col-md-3 text-center mx-auto mt-5 table-bordered">';

        if ($buton) :
                // db işlemleri
                @$kategori = htmlspecialchars($_POST["kategori"]);
				@$marka = htmlspecialchars($_POST["marka"]);
				@$model = htmlspecialchars($_POST["model"]);
                @$plaka = htmlspecialchars($_POST["plaka"]);
                @$kurban = htmlspecialchars($_POST["kurban"]);
				@$saseno = htmlspecialchars($_POST["saseno"]);
                @$muayene = htmlspecialchars($_POST["muayene"]);
                @$aracid = htmlspecialchars($_POST["aracid"]);

                if ($kategori == "" || $marka == "" || $model == "" || $aracid == "" || $plaka == "" || $kurban == ""|| $saseno == "" || $muayene == "" ) :
                    $this->uyari("danger","Bilgiler boş olamaz","ayarlar.php?islem=aracyon");

                else:
                    $this->sorgum3($vt, "update tip set kategori = '$kategori', marka = '$marka', model = '$model', plaka = '$plaka', kurban = '$kurban', saseno = '$saseno', muayene = '$muayene'  where id = $aracid");
                    $this->uyari("success","Hayvan Güncellendi","ayarlar.php?islem=aracyon");

                endif;
        else:
            $aracid = $_GET["aracid"];
            $aktar = $this->sorgum3($vt, "select * from tip where id = $aracid")->fetch_assoc();

            echo '
                    <form action = "" method = "post">

                        <div class="col-md-12 table-light border-bottom"><h4>HAYVAN GÜNCELLE</h4></div>
                        <div class="col-md-12 table-light">Cins<input type = "text" maxlength="30" name = "kategori" class = "form-control mt-3" value = "'.$aktar["kategori"].'"/></div>
						<div class="col-md-12 table-light">Yaş<input type = "text" maxlength="2" name = "marka" class = "form-control mt-3" value = "'.$aktar["marka"].'"/></div>
                        <div class="col-md-12 table-light">Hastalık Durumu<select name = "model" class = "form-control mt-3" value = "'.$aktar["model"].'"/>
                        <option value="Var" value = "'.$aktar["model"].'">Var</option>
                        <option value="Yok" value = "'.$aktar["model"].'">Yok</option></select></div>
                        <div class="col-md-12 table-light">Aşı Durumu<select  name = "plaka" class = "form-control mt-3" value = "'.$aktar["plaka"].'"/>
                        <option value="Yapıldı" value = "'.$aktar["plaka"].'">Yapıldı</option>
                        <option value="Yapılmadı" value = "'.$aktar["plaka"].'">Yapılmadı</option></select></div>
                        <div class="col-md-12 table-light">Kurbanlık Durumu<select  name = "kurban" class = "form-control mt-3" value = "'.$aktar["kurban"].'"/>
                        <option value="Uygun" value = "'.$aktar["kurban"].'">Uygun</option>
                        <option value="Uygun Değil" value = "'.$aktar["kurban"].'">Uygun Değil</option></select></div>
						<div class="col-md-12 table-light">Küpe no<input type = "text" maxlength="14" name = "saseno" class = "form-control mt-3" value = "'.$aktar["saseno"].'"/></div>
                        <div class="col-md-12 table-light">muayene tarihi<input type = "date" name = "muayene" class = "form-control mt-3" value = "'.$aktar["muayene"].'"/></div>
                        <div class="col-md-12 table-light"><input name = "buton" value = "Güncelle" type = "submit" class = "btn btn-success mt-3 mb-3"/></div>

                        <input type = "hidden" name = "aracid" value = "'.$aktar["id"].'"/>
                    </form>
                ';

        endif;

        echo '</div>';

    }

////////////////////////////// Yönetici masa ekle fonksiyonu//////////////////////////////
    public function aracekle ($vt) {

        @$buton = $_POST["buton"];

        if ($buton) :
                // db işlemleri
                @$kategori = htmlspecialchars($_POST["kategori"]);
				@$marka = htmlspecialchars($_POST["marka"]);
				@$model = htmlspecialchars($_POST["model"]);
                @$plaka = htmlspecialchars($_POST["plaka"]);
                @$kurban = htmlspecialchars($_POST["kurban"]);
				@$saseno = htmlspecialchars($_POST["saseno"]);
                @$muayene = htmlspecialchars($_POST["muayene"]);
				

                if ($kategori == "" || $marka == "" || $model == "" || $plaka == "" || $kurban == "" || $saseno == "" || $muayene == "" )  :
                    $this->uyari("danger", "* İşaretli Veriler Boş Olamaz.", "ayarlar.php?islem=aracyon");

                else:
                    $this->sorgum3($vt, "insert into tip (kategori,marka,model,plaka,kurban,saseno,muayene) values ('$kategori','$marka','$model','$plaka','$kurban','$saseno','$muayene')");
                    $this->uyari("success", "Hayvan Eklendi", "ayarlar.php?islem=aracyon");

                endif;

        else:

            echo '<div class="col-md-3 text-center mx-auto mt-5 table-bordered">
                    <form action = "" method = "post">

                        <div class="col-md-12 table-light border-bottom"><h4>HAYVAN EKLE</h4></div>
                        <div class="col-md-12 table-light">Cins *<input placeholder="Örn. Simantal,Holstein." type = "text" maxlength="30" name = "kategori" class = "form-control mt-3" required /></div>
						<div class="col-md-12 table-light">Yaş *<input  placeholder="Sadece Sayı Girin Örn. 2." type = "text" maxlength="2" name = "marka" class = "form-control mt-3" required /></div>
                        <div class="col-md-12 table-light">Hastalık Durumu *<select name = "model" class = "form-control mt-3" require /></div>
                        <option  name = "model" value="Var">Var</option>
                        <option  name = "model" value="Yok">Yok</option>
                        </select></div>
						<div class="col-md-12 table-light">Aşı Durumu *<select name = "plaka" class = "form-control mt-3" required />>
                        <option name = "plaka" value="Yapıldı">Yapıldı</option>
                        <option name = "plaka" value="Yapılmadı">Yapılmadı</option>
                        </select> </div>
                        <div class="col-md-12 table-light">Kurbanlık Durumu *<select name = "kurban" class = "form-control mt-3" required /></div>
                        <option  name = "kurban" value="Uygun">Uygun</option>
                        <option  name = "kurban" value="Uygun Değil">Uygun Değil</option>
                        </select></div>
						<div class="col-md-12 table-light">Küpe no *<input type = "text" maxlength="14" name = "saseno" class = "form-control mt-3" required /></div>
                        <div class="col-md-12 table-light">muayene tarihi *<input type = "date" name = "muayene" class = "form-control mt-3" required /></div>
                        <div class="col-md-12 table-light"><input name = "buton" value = "Ekle" type = "submit" class = "btn btn-success mt-3 mb-3"/></div>
                        <p class="card-text text-left text-danger border-top">
                        * Bulunan Kısımlara Veri Girişi Yapılması Zorunludur. <br/>
                        </p>
                    </form>
                </div>';

        endif;
    }
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
public function resimyon ($vt) {
    $this->sayfalama($this->sorgum3($vt,"select * from resim")->num_rows,3);
    $so=$this->sorgum3($vt, "select * from resim LIMIT ".$this->limitimiz.",".$this->gosAdet."");
        echo'
        <div class="col-md-16 text-center mx-auto mt-12 table-bordered row text-center">

<div class="col-lg-12"><a href="ayarlar.php?islem=resimekle" class="btn btn-success text-light"><i style="font-size:24px" class="fa">&#xf1c5;</i>&nbsp; YENİ RESİM EKLE</a></div>';
        while ($sonbilgi=$so->fetch_assoc()):
            echo'			
<div class="" style="margin:auto"><br><br><br>&nbsp&nbsp
<img src="../../'.$sonbilgi["resimyol"].'" width="200" height="200">
<br></br>
<br>&nbsp&nbsp Küpe No -> '.$sonbilgi["kupeno"].'<br>
<br></br>
<a href="ayarlar.php?islem=resimgüncelle&resimid='.$sonbilgi["id"].'" class="btn btn-info text-light">Güncelle</a>
<a href="ayarlar.php?islem=resimsil&resimid='.$sonbilgi["id"].'" class="btn btn-danger text-light">Sil</a>
</div>
';
endwhile;

echo '</tbody>
<tr>		
<td colspan="5">
<nav aria-label="Page navigation example" style="margin:auto">

        <ul class="pagination mx-auto">';
                    
        $link="ayarlar.php?islem=resimyon";
        
    
            for ($s=1; $s<$this->toplamSayfamiz; $s++) :
                
                echo '<li class="page-item">
                
                <a class="page-link" href="'.$link.'&hareket='.$s.'">'.$s.'</a>					
                
                </li>';
                
                endfor;
        echo '</ul></nav>
</td>

</tr>

    </table>
   ';

}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

public function resimsil ($vt) {
        $resimid=$_GET["resimid"];
		
		$so=$this->sorgum3($vt, "select * from resim where id=$resimid");
		$sonuc=$so->fetch_assoc();
		unlink("../../".$sonuc["resimyol"]);

		if ($resimid != "" && is_numeric($resimid)):
            $this->sorgum3($vt, "delete from resim where id=$resimid");
            $this->uyari("success", "Resim Silindi", "ayarlar.php?islem=resimyon");
        else:
            $this->uyari("danger", "Hata Oluştu", "ayarlar.php?islem=resimyon");

        endif;
		
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

public function resimekle ($vt) {
    echo '<div class="row text-center">
<div class="col-lg-12">
  ';
  echo '<div class="row tect-center">';
if($_POST):




if( $_FILES["dosya"]["name"]==""):

echo '<div class="alert alert-danger mt-1">Dosya Yüklenmedi.Boş olamaz</div>';
header("refresh:2,url=ayarlar.php?islem=resimekle");
else:

if( $_FILES["dosya"]["size"]>(1024*1024*5)):

echo '<div class="alert alert-danger mt-1">Dosya boyutu çok fazla.<div>';
header("refresh:2,url=ayarlar.php?islem=resimekle");



else:



$izinverilen=array("image/png","image/jpeg");


if(!in_array( $_FILES["dosya"]["type"],$izinverilen)):

echo '<div class="alert alert-danger mt-1">İzin verilen uzantı değil.</div>';
header("refresh:2,url=ayarlar.php?islem=resimekle");

else:

$dosyaminyolu='../../resim/'.$_FILES["dosya"]["name"];

move_uploaded_file($_FILES["dosya"]["tmp_name"],$dosyaminyolu);
echo '<div style="margin:auto" class="alert alert-success mt-1">DOSYA BAŞARIYLA YÜKLENDİ.</div>';
header("refresh:2,url=ayarlar.php?islem=resimyon");
$dosyaminyolu2=str_replace('../../','',$dosyaminyolu);
$tip = $_POST['tip'];
$this->sorgum3($vt,"insert into resim (resimyol,kupeno) VALUES('$dosyaminyolu2','$tip')");
$this->sorgum3($vt,"update tip set resimyolu='$dosyaminyolu2' where saseno='$tip'");

endif;
endif;
endif;


else:
?>

<div class="col-lg-4 mx-auto mt-2">
<div class="card card-bordered">
<div class="card-body">
<h5 class="title border-bottom">Resim Yükleme Formu</h5>
<form action="" method="post" enctype="multipart/form-data">
<p class="card-text"><input class="col-lg-12" type="file" name="dosya" /></p>

Küpe No -> <select name="tip" >
<?php
$baglanti=mysqli_connect("localhost", "root", "", "eser");
$sql=mysqli_query($baglanti,"select*from tip");
while($row=mysqli_fetch_assoc($sql)) {
$ID=$row["id"];
echo "<option name=$tip value=$ID>".$row["saseno"]."</option>";  
}						
?>
</select>
<br><br>


<script type="text/javascript">
/*
   Replacing Submit Button with 'Loading' Image
   Version 2.0
   December 18, 2012

   Will Bontrager Software, LLC
   https://www.willmaster.com/
   Copyright 2012 Will Bontrager Software, LLC

   This software is provided "AS IS," without 
   any warranty of any kind, without even any 
   implied warranty such as merchantability 
   or fitness for a particular purpose.
   Will Bontrager Software, LLC grants 
   you a royalty free license to use or 
   modify this software provided this 
   notice appears on all copies. 
*/
function ButtonClicked()
{
   document.getElementById("formsubmitbutton").style.display = "none"; // to undisplay
   document.getElementById("buttonreplacement").style.display = ""; // to display
   return true;
}
var FirstLoading = true;
function RestoreSubmitButton()
{
   if( FirstLoading )
   {
      FirstLoading = false;
      return;
   }
   document.getElementById("formsubmitbutton").style.display = ""; // to display
   document.getElementById("buttonreplacement").style.display = "none"; // to undisplay
}
// To disable restoring submit button, disable or delete next line.
document.onfocus = RestoreSubmitButton;
</script>


<div id="formsubmitbutton">
<input type="submit" name="buton" value="YÜKLE" class="btn btn-primary mb-1" onclick="ButtonClicked()" />
</div>
<div id="buttonreplacement" style="margin-left:30px; display:none;">
<img src="//www.willmaster.com/images/preload.gif" alt="loading...">
</div>







</form>

<p class="card-text text-left text-danger border-top">
* İzin verilen formatlar :jpg-png <br/>
* İzin verilen max.boyut :5 MB
</p>
</div>
</div>
</div>

<?php


endif;
echo '</div></div></div>';


}

///////////////////////////////////////////////////////////////////////////////////////////////////////

public function resimgüncelle ($vt) {
    @$buton = $_POST["buton"];
    @$resimid=$_GET["resimid"];

    echo '<div class="row text-center">
    <div class="col-lg-12">
      ';
      echo '<div class="row tect-center">';
    if($buton):
    
    
    
    
    if( $_FILES["dosya"]["name"]==""):
    
    echo '<div class="alert alert-danger mt-1">Dosya Yüklenmedi.Boş olamaz</div>';
    header("refresh:2,url=ayarlar.php?islem=resimgüncelle");
    else:
    
    if( $_FILES["dosya"]["size"]>(1024*1024*5)):
    
    echo '<div class="alert alert-danger mt-1">Dosya boyutu çok fazla.<div>';
    header("refresh:2,url=ayarlar.php?islem=resimgüncelle");
    
    
    
    else:
    
    
    
    $izinverilen=array("image/png","image/jpeg");
    
    
    if(!in_array( $_FILES["dosya"]["type"],$izinverilen)):
    
    echo '<div class="alert alert-danger mt-1">İzin verilen uzantı değil.</div>';
    header("refresh:2,url=ayarlar.php?islem=resimgüncelle");
    
    else:
    
    $dosyaminyolu='../../resim/'.$_FILES["dosya"]["name"];
    
    move_uploaded_file($_FILES["dosya"]["tmp_name"],$dosyaminyolu);
    echo '<div style="margin:auto" class="alert alert-success mt-1">DOSYA BAŞARIYLA GÜNCELLENDİ.</div>';
    header("refresh:2,url=ayarlar.php?islem=resimyon");
    $dosyaminyolu2=str_replace('../../','',$dosyaminyolu);
    $baglanti=mysqli_connect("localhost", "root", "", "eser");
$sql=mysqli_query($baglanti,"select * from resim where id=$resimid");
while($row=mysqli_fetch_assoc($sql)) {
@$kupe=$row["kupeno"];
unlink("../../".$row["resimyol"]);
}
    $this->sorgum3($vt,"update resim set resimyol='$dosyaminyolu2' where id='$resimid'");
    $this->sorgum3($vt,"update tip set resimyolu='$dosyaminyolu2' where saseno='$kupe'");

    endif;
    endif;
    endif;
    
    
    else:
    ?>
    
    <div class="col-lg-4 mx-auto mt-2">
    <div class="card card-bordered">
    <div class="card-body">
    <h5 class="title border-bottom">Resim Güncelleme Formu</h5>
    <form action="" method="post" enctype="multipart/form-data">
    <p class="card-text"><input class="col-lg-12" type="file" name="dosya" /></p>
    
    <script type="text/javascript">
    /*
       Replacing Submit Button with 'Loading' Image
       Version 2.0
       December 18, 2012
    
       Will Bontrager Software, LLC
       https://www.willmaster.com/
       Copyright 2012 Will Bontrager Software, LLC
    
       This software is provided "AS IS," without 
       any warranty of any kind, without even any 
       implied warranty such as merchantability 
       or fitness for a particular purpose.
       Will Bontrager Software, LLC grants 
       you a royalty free license to use or 
       modify this software provided this 
       notice appears on all copies. 
    */
    function ButtonClicked()
    {
       document.getElementById("formsubmitbutton").style.display = "none"; // to undisplay
       document.getElementById("buttonreplacement").style.display = ""; // to display
       return true;
    }
    var FirstLoading = true;
    function RestoreSubmitButton()
    {
       if( FirstLoading )
       {
          FirstLoading = false;
          return;
       }
       document.getElementById("formsubmitbutton").style.display = ""; // to display
       document.getElementById("buttonreplacement").style.display = "none"; // to undisplay
    }
    // To disable restoring submit button, disable or delete next line.
    document.onfocus = RestoreSubmitButton;
    </script>
    
    
    
    
    
    <div id="formsubmitbutton">
    <input type="submit" name="buton" value="GÜNCELLE" class="btn btn-primary mb-1" onclick="ButtonClicked()" />
    </div>
    <div id="buttonreplacement" style="margin-left:30px; display:none;">
    <img src="//www.willmaster.com/images/preload.gif" alt="loading...">
    </div>
    
    
    
    
    
    
    
    </form>
    
    <p class="card-text text-left text-danger border-top">
    * İzin verilen formatlar :jpg-png <br/>
    * İzin verilen max.boyut :5 MB
    </p>
    </div>
    </div>
    </div>
    
    <?php
    
    
    endif;
    echo '</div></div></div>';

    
}



}


?>

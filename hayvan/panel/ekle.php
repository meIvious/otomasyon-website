<?php 
include("vt.php"); // veritabanı bağlantımızı sayfamıza ekliyoruz. 
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Veritabanı İşlemleri</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<script>
function meşaz(){
    alert("Veri Eklendi")
}
function sil()
{
alert("Veri Silindi")
}
</script>
<div class="container">
<div class="col-md-6">
<form action="" method="post">
    
    <table class="table">
        <h4>Basit Kayıt Gönderme-Veritabanı Kaydı</h4>
        <tr>
            <td>Konum</td>
            <td><input type="text" name="konum" class="form-control" value="<?php echo $sonuc['konum']; 
                 // Veritabanından verileri çekip inputların içine yazdırıyoruz. ?>">
            </td>
        </tr>

        <tr>
            <td>Araç Tipi</td>
            <td><input type="text" name="tip" class="form-control" value="<?php echo $sonuc['tip']; 
                 // Veritabanından verileri çekip inputların içine yazdırıyoruz. ?>">
            </td>
        </tr>

        <tr>
            <td>Başlangıç Tarihi</td>
            <td><input type="text" name="bastar" class="form-control" value="<?php echo $sonuc['bastar']; 
                 // Veritabanından verileri çekip inputların içine yazdırıyoruz. ?>">
            </td>
        </tr>

        <tr>
            <td>Bitiş Tarihi</td>
            <td><input type="text" name="bittar" class="form-control" value="<?php echo $sonuc['bittar']; 
                 // Veritabanından verileri çekip inputların içine yazdırıyoruz. ?>">
            </td>
        </tr>

        <tr>
            <td>Adsoyad</td>
            <td><input type="text" name="adsoyad" class="form-control" value="<?php echo $sonuc['adsoyad']; 
                 // Veritabanından verileri çekip inputların içine yazdırıyoruz. ?>">
            </td>
        </tr>

        <tr>
            <td>Tel NO</td>
            <td><input type="text" name="telno" class="form-control" value="<?php echo $sonuc['telno']; 
                 // Veritabanından verileri çekip inputların içine yazdırıyoruz. ?>">
            </td>
        </tr>

        <tr>
            <td>Mesaj</td>
            <td><textarea name="mesaj"  cols="30" rows="7" class="form-control" placeholder=""><?php echo $sonuc['mesaj']; ?></textarea></td>
        </tr>

        <tr>
            <td></td>
            <td><input class="btn btn-success" onclick="meşaz()"  type="submit" value="Ekle"></td>
        </tr>

    </table>

</form>

<!-- Öncelikle HTML düzenimizi oluşturuyoruz. Daha sonra girdiğimiz verileri veritabanına eklemesi için PHP kodlarına geçiyoruz. -->

<?php 

if ($_POST) { // Sayfada post olup olmadığını kontrol ediyoruz.

    // Sayfa yenilendikten sonra post edilen değerleri değişkenlere atıyoruz
    $konum = $_POST['konum']; 
    $tip = $_POST['tip'];
	$bastar = $_POST['bastar'];
    $bittar = $_POST['bittar'];
    $adsoyad = $_POST['adsoyad'];
    $eposta = $_POST['eposta'];
    $telno = $_POST['telno'];
    $mesaj = $_POST['mesaj'];

    if ($konum<>"" && $tip<>""  && $bastar<>""  && $bittar<>""  && $adsoyad<>""  && $eposta<>""  && $telno<>""  && $mesaj<>"") { 
    // Veri alanlarının boş olmadığını kontrol ettiriyoruz. Başka kontrollerde yapabilirsiniz.
        
         // Veri ekleme sorgumuzu yazıyoruz.
        if ($baglanti->query("INSERT INTO eser (konum,tip,bastar,bittar,adsoyad,eposta,telno,mesaj) VALUES ('$konum','$tip','$bastar','$bittar','$adsoyad','$eposta',,'$telno''$eposta')")) 
        {
            echo "Veri Eklendi"; // Eğer veri eklendiyse eklendi yazmasını sağlıyoruz.
        }
 
        else
        {
            echo "Hata oluştu";
        }

    }

}

?>
</div>
<!-- ############################################################## -->

<!-- Veritabanına eklenmiş verileri sıralamak için önce üst kısmı hazırlayalım. -->
<div class="col-md-7">
<table class="table">
    
    <tr>
        <th>#</th>
        <th>Ad-Soyad</th>
        <th>E-mail</th>
		<th>Tel no</th>
		<th>Mesaj</th>
    </tr>

<!-- Şimdi ise verileri sıralayarak çekmek için PHP kodlamamıza geçiyoruz. -->

<?php 

$sorgu = $baglanti->query("SELECT * FROM eser"); // Makale tablosundaki tüm verileri çekiyoruz.

while ($sonuc = $sorgu->fetch_assoc()) { 

$id = $sonuc['id']; // Veritabanından çektiğimiz id satırını $id olarak tanımlıyoruz.
$konum = $sonuc['konum'];
$tip = $sonuc['tip'];
$bastar = $sonuc['bastar'];
$bittar = $sonuc['bittar'];
$adsoyad = $sonuc['adsoyad'];
$eposta = $sonuc['eposta'];
$telno = $sonuc['telno'];
$mesaj = $sonuc['mesaj'];



// While döngüsü ile verileri sıralayacağız. Burada PHP tagını kapatarak tırnaklarla uğraşmadan tekrarlatabiliriz. 
?>
    
    <tr>
        <td><?php echo $id; // Yukarıda tanıttığımız gibi alanları dolduruyoruz. ?></td>
        <td><?php echo $konum; ?></td>
        <td><?php echo $tip; ?></td>
		<td><?php echo $bastar; ?></td>
		<td><?php echo $bittar; ?></td>
        <td><?php echo $adsoyad; ?></td>
        <td><?php echo $eposta; ?></td>
        <td><?php echo $telno; ?></td>
        <td><?php echo $mesaj; ?></td>
        <td><a href="duzenle.php?id=<?php echo $id; ?>" class="btn btn-primary">Düzenle</a></td>
        <td><a href="sil.php?id=<?php echo $id; ?>" class="btn btn-danger" onclick="sil()">Sil</a></td>
    </tr>

<?php 
} 
// Tekrarlanacak kısım bittikten sonra PHP tagının içinde while döngüsünü süslü parantezi kapatarak sonlandırıyoruz. 
?>

</table>
</div>
</div>
</body>
</html>
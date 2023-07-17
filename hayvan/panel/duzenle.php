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

<?php 

$sorgu = $baglanti->query("SELECT * FROM eser WHERE id =".(int)$_GET['id']); 
//id değeri ile düzenlenecek verileri veritabanından alacak sorgu

$sonuc = $sorgu->fetch_assoc(); //sorgu çalıştırılıp veriler alınıyor

?>

<div class="container">
<div class="col-md-6">

<form action="" method="post">
    
    <table class="table">
        

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
            <td><input type="submit" class="btn btn-primary" value="Kaydet"></td>
        </tr>

    </table>

</form>
</div>
<div>
<?php 

if ($_POST) { // Post olup olmadığını kontrol ediyoruz.
    
    $konum = $_POST['konum']; // Post edilen değerleri değişkenlere aktarıyoruz
    $tip= $_POST['tip'];
    $bastar = $_POST['bastar'];
    $bittar = $_POST['bittar'];
    $adsoyad = $_POST['adsoyad'];
    $eposta = $_POST['eposta'];
    $telno = $_POST['telno'];
    $mesaj = $_POST['mesaj'];

    if ($konum<>"" && $tip<>""  && $bastar<>""  && $bittar<>""  && $adsoyad<>""  && $eposta<>""  && $telno<>""  && $mesaj<>"") { // Veri alanlarının boş olmadığını kontrol ettiriyoruz.
        
        // Veri güncelleme sorgumuzu yazıyoruz.
        if ($baglanti->query("UPDATE eser SET konum = '$konum', tip = '$tip',bastar= '$bastar',bittar = '$bittar',adsoyad= '$adsoyad',eposta = '$eposta',telno = '$telno',mesaj = '$mesaj',WHERE id =".$_GET['id'])) 
        {
            header("location:ekle.php"); 
            // Eğer güncelleme sorgusu çalıştıysa ekle.php sayfasına yönlendiriyoruz.
        }
        else
        {
            echo "Hata oluştu"; // id bulunamadıysa veya sorguda hata varsa hata yazdırıyoruz.
        }
    }
}
?>
</body>
</html
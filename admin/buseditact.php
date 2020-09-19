<?php
include('includes/config.php');
error_reporting(0);
$nama=$_POST['nama'];
$merek=$_POST['merek'];
$id=$_POST['id'];
$nopol=$_POST['nopol'];
$deskripsi=$_POST['deskripsi'];
$harga8=$_POST['harga8'];
$harga12=$_POST['harga12'];
$harga16=$_POST['harga16'];
$harga24=$_POST['harga24'];
$hargaluar=$_POST['hargaluar'];
$seats=$_POST['seats'];

$sql="UPDATE bus SET nama_bus='$nama',id_merek='$merek',nopol='$nopol',harga_8='$harga8',harga_12='$harga12',harga_16='$harga16',harga_24='$harga24',harga_luar='$hargaluar',deskripsi='$deskripsi',seating='$seats' WHERE id_bus='$id'";
$query 	= mysqli_query($koneksidb,$sql);
if($query){
	echo "<script type='text/javascript'>
			alert('Berhasil edit data.'); 
			document.location = 'bus.php'; 
		</script>";
}else {
			echo "No Error : ".mysqli_errno($koneksidb);
			echo "<br/>";
			echo "Pesan Error : ".mysqli_error($koneksidb);

	echo "<script type='text/javascript'>
			alert('Terjadi kesalahan, silahkan coba lagi!.'); 
			document.location = 'busedit.php?id=$id'; 
		</script>";
}
?>
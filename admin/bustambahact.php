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
$img1=$_FILES["img1"]["name"];
$str1 = substr($img1,-5);
$vimage1 = date('dmYHis').$str1;
$img2=$_FILES["img2"]["name"];
$str2 = substr($img2,-5);
$vimage2 = date('dmYHis').$str2;
$img3=$_FILES["img3"]["name"];
$str3 = substr($img3,-5);
$vimage3 = date('dmYHis').$str3;
$sql 	= "INSERT INTO bus (nama_bus,id_merek,nopol,harga_8,harga_12,harga_16,harga_24,harga_luar,deskripsi,seating,foto_1,foto_2,foto_3,id_adm)
		   VALUES ('$nama','$merek','$nopol','$harga8','$harga12','$harga16','$harga24','$hargaluar','$deskripsi','$seats','$vimage1','$vimage2','$vimage3','$id')";
$query 	= mysqli_query($koneksidb,$sql);
if($query){
	move_uploaded_file($_FILES["img1"]["tmp_name"],"img/".$vimage1);
	move_uploaded_file($_FILES["img2"]["tmp_name"],"img/".$vimage2);
	move_uploaded_file($_FILES["img3"]["tmp_name"],"img/".$vimage3);
	echo "<script type='text/javascript'>
			alert('Berhasil tambah data.'); 
			document.location = 'bus.php'; 
		</script>";
}else {
			echo "No Error : ".mysqli_errno($koneksidb);
			echo "<br/>";
			echo "Pesan Error : ".mysqli_error($koneksidb);

	echo "<script type='text/javascript'>
			alert('Terjadi kesalahan, silahkan coba lagi!.'); 
			document.location = 'bustambah.php'; 
		</script>";
}

?>
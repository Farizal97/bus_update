<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/format_rupiah.php');
include('includes/library.php');

if(strlen($_SESSION['ulogin'])==0){ 
	header('location:index.php');
}else{

if(isset($_POST['submit'])){
$tglsewa=$_POST['tgl'];
$durasi=$_POST['durasi'];
$vid=$_POST['vid'];
$email=$_POST['email'];
$bus=$_POST['bus'];
$drv=$_POST['drv'];
$tujuan=$_POST['tujuan'];
$kode = buatKode("booking", "TRX");
$status = "Menunggu Pembayaran";
$bukti = "";
$cek=0;
$tgl=date('Y-m-d');
//insert
$sql 	= "INSERT INTO booking(kode_booking,id_bus,tgl,durasi,tujuan,biaya_bus,biaya_drv,status,email,tgl_booking)
			VALUES('$kode','$vid','$tglsewa','$durasi','$tujuan','$bus','$drv','$status','$email','$tgl')";
$query 	= mysqli_query($koneksidb,$sql);
if($query){
/*	for($cek;$cek<$durasi;$cek++){
		$tglmulai = strtotime($fromdate);
		$jmlhari  = 86400*$cek;
		$tgl	  = $tglmulai+$jmlhari;
		$tglhasil = date("Y-m-d",$tgl);
		$sql1	="INSERT INTO cek_booking (kode_booking,id_bus,tgl_booking,status)VALUES('$kode','$vid','$tglhasil','$status')";
		$query1 = mysqli_query($koneksidb,$sql1);
	}*/
	echo " <script> alert ('Bus berhasil disewa.'); </script> ";
	echo "<script type='text/javascript'> document.location = 'booking_detail.php?kode=$kode'; </script>";
	}else{
		echo " <script> alert ('Ooops, terjadi kesalahan. Silahkan coba lagi.'); </script> ";
		echo "<script type='text/javascript'> document.location = 'booking.php?vid=$vid'; </script>";
	}
}
?>

  <!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title><?php echo $pagedesc;?></title>
<!--Bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
<link href="assets/css/slick.css" rel="stylesheet">
<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all" data-default-color="true" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="admin/img/fav.png">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet"> 
</head>
<body>

<!-- Start Switcher -->
<?php include('includes/colorswitcher.php');?>
<!-- /Switcher -->  
        
<!--Header-->
<?php include('includes/header.php');?>
<!--Page Header-->
<!-- /Header --> 

<div>
	<br/>
	<center><h3>Detail Penyewaan.</h3></center>
	<hr>
</div>
<?php
$email=$_SESSION['ulogin']; 
$vid=$_POST['vid'];
$durasi=$_POST['durasi'];
$tujuan=$_POST['tujuan'];
$tgl=$_POST['tgl'];
/*$selesai=$_GET['selesai'];
$start = new DateTime($mulai);
$finish = new DateTime($selesai);
$int = $start->diff($finish);
$dur = $int->days;
$durasi = $dur+1;
*/
$sql1 	= "SELECT bus.*,merek.* FROM bus,merek WHERE merek.id_merek=bus.id_merek and bus.id_bus='$vid'";
$query1 = mysqli_query($koneksidb,$sql1);
$result = mysqli_fetch_array($query1);
$bus	= "";
if($durasi==8){
	$bus = $result['harga_8'];
}else if($durasi==12){
	$bus = $result['harga_12'];
}else if($durasi==16){
	$bus = $result['harga_16'];
}else if($durasi==24){
	$bus = $result['harga_24'];
}

$luar=$result['harga_luar'];

$sqldrv 	= "SELECT * FROM tblpages WHERE id_page='7'";
$querydrv = mysqli_query($koneksidb,$sqldrv);
$resdrv = mysqli_fetch_array($querydrv);
$drv ="";
$newbus="";
if($tujuan=="Dalam"){
	$newbus=$bus;
	$drv = $resdrv['type'];
}else{
	$drv = $resdrv['detail'];
	$newbus=$bus+$luar;	
}

$total = $newbus+$drv;
?>
	<section class="user_profile inner_pages">
	<div class="container">
	<div class="col-md-6 col-sm-8">
	      <div class="product-listing-img"><img src="admin/img/<?php echo htmlentities($result['foto_1']);?>" class="img-responsive" alt="Image" /> </a> </div>
          <div class="product-listing-content">
            <h5><?php echo htmlentities($result['nama_merek']);?> , <?php echo htmlentities($result['nama_bus']);?></a></h5>
            <!--<p class="list-price"><?php echo htmlentities(format_rupiah($result['harga']));?>/ Hari</p>-->
            <ul>
              <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result['seating']);?> Seats</li>
            </ul>
          </div>	
	</div>
	
	<div class="user_profile_info">	
		<div class="col-md-12 col-sm-10">
        <form method="post" name="sewa" onSubmit="return valid();"> 
			<input type="hidden" class="form-control" name="vid"  value="<?php echo $vid;?>"required>
 			<input type="hidden" class="form-control" name="email"  value="<?php echo $email;?>"required>
            <div class="form-group">
			<label>Tanggal</label>
				<input type="date" class="form-control" name="tgl" placeholder="From Date(dd/mm/yyyy)" value="<?php echo $tgl;?>"readonly>
            </div>
            <div class="form-group">
			<label>Durasi</label>
				<input type="text" class="form-control" name="durasi" value="<?php echo $durasi;?> Jam"readonly>
            </div>
            <div class="form-group">
			<label>Tujuan</label>
				<input type="text" class="form-control" name="tujuan" value="<?php echo $tujuan;?> Kota"readonly>
            </div>
            <div class="form-group">
			<label>Biaya Bus</label><br/>
				<input type="text" class="form-control" name="bbus" value="<?php echo format_rupiah($newbus);?>"readonly>
				<input type="hidden" class="form-control" name="bus" value="<?php echo $newbus;?>"readonly>
            </div>
            <div class="form-group">
			<label>Biaya Driver+Kernet</label><br/>
				<input type="text" class="form-control" name="bdrv" value="<?php echo format_rupiah($drv);?>"readonly>
				<input type="hidden" class="form-control" name="drv" value="<?php echo $drv;?>"readonly>
            </div>
            <div class="form-group">
			<label>Total Biaya</label><br/>
				<input type="text" class="form-control" name="total" value="<?php echo format_rupiah($total);?>"readonly>
            </div>
			<br/>			
			<div class="form-group">
                <input type="submit" name="submit" value="Sewa" class="btn btn-block">
            </div>
        </form>
		</div>
		</div>
      </div>
</section>
<!--/my-vehicles--> 
<?php include('includes/footer.php');?>

<!-- Scripts --> 
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<!--Switcher-->
<script src="assets/switcher/js/switcher.js"></script>
<!--bootstrap-slider-JS--> 
<script src="assets/js/bootstrap-slider.min.js"></script> 
<!--Slider-JS--> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>
</body>
</html>
<?php } ?>
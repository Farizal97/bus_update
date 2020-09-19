<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/format_rupiah.php');

if(strlen($_SESSION['ulogin'])==0){ 
	header('location:index.php');
}else{
	$tglnow   = date('Y-m-d');
	$tglmulai = strtotime($tglnow);
	$jmlhari  = 86400*1;
	$tglplus	  = $tglmulai+$jmlhari;
	$now = date("Y-m-d",$tglplus);
	
/*if(isset($_POST['submit'])){
	$durasi=$_POST['durasi'];
	$tujuan=$_POST['tujuan'];
	$vid=$_POST['vid'];

$sql 	= "SELECT kode_booking FROM cek_booking WHERE tgl_booking between '$fromdate' AND '$todate' AND id_bus='$vid' AND status!='Cancel'";
$query 	= mysqli_query($koneksidb,$sql);

if(mysqli_num_rows($query)>0){
		echo " <script> alert ('Bus tidak tersedia di tanggal yang anda pilih, silahkan pilih tanggal lain!'); 
		</script> ";
	}else{
		echo "<script type='text/javascript'> document.location = 'booking_ready.php?vid=$vid&mulai=$fromdate&selesai=$todate'; </script>";
	}
}
*/
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

<?php 
$vid=$_GET['vid'];
$useremail=$_SESSION['login'];
$sql1 = "SELECT bus.*,merek.* FROM bus,merek WHERE merek.id_merek=bus.id_merek and bus.id_bus='$vid'";
$query1 = mysqli_query($koneksidb,$sql1);
$result = mysqli_fetch_array($query1);
?>
<script type="text/javascript">
function valid()
{
	if(document.sewa.tgl.value < document.sewa.now.value){
		alert("Tanggal sewa minimal H-1!");
		return false;
	}

return true;
}
</script>

	<section class="user_profile inner_pages">
	<div class="container">
	<div class="col-md-6 col-sm-8">
	      <div class="product-listing-img"><img src="admin/img/<?php echo htmlentities($result['foto_1']);?>" class="img-responsive" alt="Image" /> </a> </div>
          <div class="product-listing-content">
            <h5><?php echo htmlentities($result['nama_merek']);?> , <?php echo htmlentities($result['nama_bus']);?></a></h5>
            <!--<p class="list-price"><?php echo htmlentities(format_rupiah($result['harga']));?> / Hari</p>-->
            <ul>
              <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result['seating']);?> Seats</li>
            </ul>
          </div>	
	</div>
	
	<div class="user_profile_info">	
		<div class="col-md-12 col-sm-10">
        <form method="post" action="booking_ready.php" name="sewa" onSubmit="return valid();"> 
			<input type="hidden" class="form-control" name="vid"  value="<?php echo $vid;?>"required>
            <!--<div class="form-group">
			<label>Tanggal Mulai</label>
				<input type="date" class="form-control" name="fromdate" placeholder="From Date(dd/mm/yyyy)" required>
				<input type="hidden" name="now" class="form-control" value="<?php echo $now;?>">
            </div>
            <div class="form-group">
			<label>Tanggal Selesai</label>
				<input type="date" class="form-control" name="todate" placeholder="To Date(dd/mm/yyyy)" required>
            </div>-->
            <div class="form-group">
			<label>Tanggal</label>
				<input type="date" class="form-control" name="tgl" placeholder="To Date(dd/mm/yyyy)" required>
				<input type="hidden" name="now" class="form-control" value="<?php echo $now;?>">
            </div>
            <div class="form-group">
				<label>Durasi Sewa</label>
					<select class="form-control" name="durasi" required="" data-parsley-error-message="Field ini harus diisi" >
						<option value="">-- Pilih Durasi Sewa --</option>
						<option value="8">8 Jam (<?php echo format_rupiah($result['harga_8']);?>)</option>
						<option value="12">12 Jam (<?php echo format_rupiah($result['harga_12']);?>)</option>
						<option value="16">16 Jam (<?php echo format_rupiah($result['harga_16']);?>)</option>
						<option value="24">1 Hari (<?php echo format_rupiah($result['harga_24']);?>)</option>
					</select>
            </div>
            <div class="form-group">
				<label>Pilih Tujuan (Tujuan Luar Kota akan dikenakan biaya sebesar <?php echo format_rupiah($result['harga_luar']);?>)</label>
					<select class="form-control" name="tujuan" required="" data-parsley-error-message="Field ini harus diisi" >
						<option value="">-- Pilih Tujuan --</option>
						<option value="Dalam">Dalam Kota</option>
						<option value="Luar">Luar Kota</option>
					</select>
            </div>
			<br/>			
			<div class="form-group">
                <input type="submit" name="kirim" value="Submit" class="btn btn-block">
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
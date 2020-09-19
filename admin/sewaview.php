<!-- Printing -->
	<link rel="stylesheet" href="css/printing.css">
		
<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/format_rupiah.php');
include('includes/library.php');
if($_GET) {
	$Kode = $_GET['code'];
	$sqlsewa = "SELECT booking.*,bus.*,merek.*,users.* FROM booking,bus,merek,users WHERE booking.id_bus=bus.id_bus
				AND merek.id_merek=bus.id_merek AND users.email=booking.email AND booking.kode_booking='$Kode'";
	$querysewa = mysqli_query($koneksidb,$sqlsewa);
	$result = mysqli_fetch_array($querysewa);
	$total=$result['biaya_bus']+$result['biaya_drv'];
	$bukti=$result['bukti_bayar'];
}
else {
	echo "Nomor Transaksi Tidak Terbaca";
	exit;
}
?>
<html>
<head>
</head>
<body>
<div id="section-to-print">
<div id="only-on-print">
	<h2>Detail Sewa</h2>
</div>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
	<h4 class="modal-title" id="myModalLabel">Detail Sewa</h4>
</div>
<div><br/></div>
<table width="100%">
	<tr>
		<td width="20%"><b>Kode Sewa</b></td>
		<td width="2%"><b>:</b></td>
		<td width="78%"><?php echo $result['kode_booking'];?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%"><b>Bus</b></td>
		<td width="2%"><b>:</b></td>
		<td width="78%"><?php echo $result['nama_merek'];?>, <?php echo $result['nama_bus'];?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%"><b>Tanggal</b></td>
		<td width="2%"><b>:</b></td>
		<td width="78%"><?php echo IndonesiaTgl($result['tgl']);?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%"><b>Durasi</b></td>
		<td width="2%"><b>:</b></td>
		<td width="78%"><?php echo $result['durasi'];?> Jam</td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%"><b>Tujuan</b></td>
		<td width="2%"><b>:</b></td>
		<td width="78%"><?php echo $result['tujuan'];?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%"><b>Penyewa</b></td>
		<td width="2%"><b>:</b></td>
		<td width="78%"><?php echo $result['nama_user'];?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%"><b>Total Biaya</b></td>
		<td width="2%"><b>:</b></td>
		<td width="78%"><?php echo format_rupiah($total);?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%"><b>Status</b></td>
		<td width="2%"><b>:</b></td>
		<td width="78%"><?php echo $result['status'];?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%"><b>Bukti Pembayaran</b></td>
		<td width="2%"><b>:</b></td>
		<?php
			if($bukti==""){
		?>
			<td width="78%">Belum ada bukti pembayaran.</td>
			<?php
			}else{
			?>
			<td width="78%"><img src="../image/<?php echo htmlentities($result['bukti_bayar']);?>" width="120" height="150"></td>
			<?php
			}
			?>
	</tr>
</table>
	<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>

</div>

</body>
</html>
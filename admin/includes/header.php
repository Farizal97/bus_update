<div class="brand clearfix"><span class="menu-btn"><i class="fa fa-bars"></i></span>
		<ul class="ts-profile-nav">
            <?php
				$id = $_SESSION['id'];
				$sql = "SELECT * FROM admin WHERE id_adm='$id'";
				$query = mysqli_query($koneksidb,$sql);
				$result = mysqli_fetch_array($query);
				$nama=$result['nama_adm'];
				$img=$result['foto_adm'];
			?>
			<li class="ts-account">
				<a href="#">
				<img src="img/<?php echo $img;?>" width="20px" height="20px" padding="0px">&nbsp;
				<?php echo $nama; ?> 
                <span class="fa fa-angle-down"></span>
				</a>
				<ul>
					<li><a href="change-password.php"><i class="fa fa-key pull-right"></i>Ganti Password</a></li>
					<li><a href="profile.php"><i class="fa fa-user pull-right"></i>Profil</a></li>
					<li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i>Keluar</a></li>
				</ul>
			</li>
  </ul>
	</div>

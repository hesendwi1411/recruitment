<?php
	include ("../db.php");
	include ("../fungsi_indotgl.php");
    $no_ktp=$_GET['no_ktp'];
	$lokasi=$_GET['location'];
	$nama=$_GET['nama'];
	
	?>
<!doctype html>
<html>
	<head>
		<title>Biodata Karyawan</title>
		
		<link rel="shortcut icon" href="../img/laporan.png">
		<link rel="stylesheet" type="text/css" href="../css/laporan.css">
	</head>
	<body>
		<div class="page">
		<div class="kop">
	
				<img src="<?php
				
                if($lokasi == "1"){
                     echo "../img/ameya.png";
                }
                else{
                   echo "../img/anggun.png";
                }
                ?>" id="kop">
				
           
            <div class="header">
				<h2><?php
				
					if ($lokasi == "1") {
						echo 'PT. Ameya Livingstyle Indonesia';
					}
					else {
						echo 'PT. Anggun Kreasi Garmen';
						
					}
							?>
				</h2>
                <h1>BIODATA KARYAWAN</h1>
            
            
                </div>
		</div>
		
            <div class="batas"></div>
           <table class="table" class="ttd">
			
			
			<?php										
					$query=mysqli_query($conn,"SELECT * FROM karyawan WHERE no_ktp='$no_ktp' ");
					
					while($row=mysqli_fetch_array($query)){
					?>					
						<tr bgcolor="#fff" >
                            <td width="200">NAMA</td>
                           <td>:</td>
						   <td width="500"><?php echo $row['nama']; ?></td>
						</tr>
						<tr bgcolor="#fff" >
                            <td width="150">TEMPAT / TGL LAHIR</td>
                           <td>:</td>
						   <td width="500"><?php echo $row['tempat_lahir']; ?> / <?php echo  tgl_indo($row['dob']); ?></td>
						</tr>
						<tr bgcolor="#fff" >
                            <td width="150">AGAMA</td>
                           <td>:</td>
						   <td width="500"><?php echo $row['agama']; ?></td>
						</tr>
						<tr bgcolor="#fff" >
                            <td width="150">ALAMAT</td>
                           <td>:</td>
						   <td width="500"><?php echo $row['address']; ?>    </td>
						</tr>
						<tr bgcolor="#fff" >
                            <td width="150"></td>
                           <td></td>
						   <td width="500">RT: <?php echo $row['rt']; ?> RW: <?php echo $row['rw']; ?>  </td>
						</tr>
						<tr bgcolor="#fff" >
                            <td width="150"></td>
                           <td></td>
						   <td width="500"><?php echo $row['desa']; ?> - <?php echo $row['kabupaten']; ?> - <?php echo $row['provinsi']; ?>  </td>
						</tr>

						<tr bgcolor="#fff" >
                            <td width="150">NO TLP / HP</td>
                           <td>:</td>
						   <td width="500"><?php echo $row['contactno']; ?> </td>
						</tr>
						<tr bgcolor="#fff" >
                            <td width="150">PEKERJAAN / JABATAN</td>
                           <td>:</td>
						   <td width="500"><?php echo $row['nama_perusahaan']; ?> / <?php echo $row['jabatan']; ?></td>
						</tr>
						<tr bgcolor="#fff" >
                            <td width="200"colspan="3">ORANG TUA / SUAMI / ISTRI</td> 
						</tr>
						<tr bgcolor="#fff" >
                            <td width="150">HUBUNGAN</td>
                           <td>:</td>
						   <td width="500"><?php echo $row['keluarga']; ?></td>
						</tr>
						<tr bgcolor="#fff" >
                            <td width="150">NAMA</td>
                           <td>:</td>
						   <td width="500"><?php echo $row['nama_keluarga']; ?></td>
						</tr>
						<tr bgcolor="#fff" >
                            <td width="150">AGAMA</td>
                           <td>:</td>
						   <td width="500"><?php echo $row['agama_keluarga']; ?></td>
						</tr>
						<tr bgcolor="#fff" >
                            <td width="150">ALAMAT</td>
                           <td>:</td>
						   <td width="500"><?php echo $row['address_keluarga']; ?></td>
						</tr>
						<tr bgcolor="#fff" >
                            <td width="150">PEKERJAAN</td>
                           <td>:</td>
						   <td width="500"><?php echo $row['pekerjaan_keluarga']; ?></td>
						</tr>
						<tr bgcolor="#fff" >
                             <td></td>
						</tr>
						<tr bgcolor="#fff">
                            <td width="150" colspan="3" style="font-weight:bold"> Dalam keadaan Darurat bisa dihubungi melalui :</td>
                            
						</tr>
						<tr bgcolor="#fff" >
                            <td width="150">NAMA</td>
                           <td>:</td>
						   <td width="500"><?php echo $row['nama_kerabat']; ?></td>
						</tr>
						<tr bgcolor="#fff" >
                            <td width="150">HUBUNGAN</td>
                           <td>:</td>
						   <td width="500"><?php echo $row['hubungan_kerabat']; ?></td>
						</tr>
						<tr bgcolor="#fff" >
                            <td width="150">ALAMAT</td>
                           <td>:</td>
						   <td width="500"><?php echo $row['address_kerabat']; ?></td>
						</tr>
						<tr bgcolor="#fff" >
                            <td width="150">NO TELP</td>
                           <td>:</td>
						   <td width="500"><?php echo $row['contactno_kerabat']; ?></td>
						</tr>
						<tr bgcolor="#fff" >
                            <td></td>
						</tr>
						<tr bgcolor="#fff" >
                             <td></td>
						</tr>
						<tr bgcolor="#fff" >
                             <td></td>
						</tr>
						<tr bgcolor="#fff" >
                            <td></td>
						</tr>
						<tr bgcolor="#fff" >
                             <td></td>
						</tr>
						<tr bgcolor="#fff" >
                             <td></td>
						</tr>
						<tr bgcolor="#fff" >
                            <td></td>
						</tr>
						<tr bgcolor="#fff" >
                             <td></td>
						</tr>
						<tr bgcolor="#fff" >
                             <td></td>
						</tr>
						<tr bgcolor="#fff" >
                            <td></td>
						</tr>
						<tr bgcolor="#fff" >
                             <td></td>
						</tr>
						<tr bgcolor="#fff" >
                             <td></td>
						</tr>
					<?php
					
					}
					?>
                
					
		</table>
            
                      
			
            <table border="0px" style="float:left;" class="ttd">
			  <tr>
                <td>Demikian Biodata ini saya isi dengan sebenar-benarnya</td>    
            </tr>
            <tr>
                <td>Yogyakarta, <?php echo tgl_indo(date('Y-m-d')); ?></td>    
            </tr>
            <tr>
                    
            </tr>
            <tr>
                <td></td>    
            </tr>
            <tr>
                <td></td>    
            </tr>
                 <tr>
                <td></td>    
            </tr>
			 <tr>
                <td></td>    
            </tr>
			 <tr>
                <td></td>    
            </tr>
			 <tr>
                <td>...........................................</td>    
            </tr>
            <tr>
                <td><?php echo $nama;?> </td>    
            </tr>
			<tr>
                <td></td>    
            </tr>
			<tr>
                <td></td>    
            </tr>
			<tr>
                <td>NB: Apabila ada perubahan data karyawan harap lapor ke bagian personalia 3 (tiga) hari sebelumnya</td>    
            </tr>
            </table>
			
		</div>
	</body>
</html>
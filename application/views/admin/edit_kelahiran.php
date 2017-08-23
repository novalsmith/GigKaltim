<h3 style="border-bottom:dashed 1px #AAB2BD">Tambah Kelahiran Baru
<small>
<a href="<?=base_url().'kelahiran'  ?>" title="" class="btn btn-info pull-right">
<i class="icon  icon-arrow-left icon-white"></i> Kembali</a>
</small>
</h3>

<?=form_open('kelahiran/proses_edit_nomor_kk'); ?>


<div class="span4">
<?=form_hidden('id_kelahiran',$tampil->id_kelahiran); ?>


<?php if ($tampil->id_kelahiran ==''){ ?>


	<input type="text" name="nomor_registrasi" 
class="span3"
 placeholder="Nomor Registrasi" value="<?='474/1/4416.317.4/'.date('Y') ?>">
<?= form_error('nomor_registrasi', '<p class="text-error">', '</p>');
 ?>
	
	<?php }else{ ?>

<input type="text" name="nomor_registrasi" 
class="span3"
 placeholder="Nomor Registrasi" value="<?='474/'.$tampil->id_kelahiran.'/416.317.4'.'/'.date('Y') ?>">
<?= form_error('nomor_registrasi', '<p class="text-error">', '</p>');
 ?>



<?php } ?>








<?php 
$tgl_laporan = array(
								'name'			=>	'tgl_laporan' ,
								'class'			=>	'span4',
								'required'		=>	'harap masukan data',
													
								'placeholder'	=>	'yy-mm-dd',
								'value'			=>	$tampil->tgl_laporan
							);

echo form_label('Tanggal Laporan Kelahiran');
echo form_input($tgl_laporan);
echo '<small class="text text-error">Contoh Pengisian Tanggal : '.date('Y-m-d').'</small>';
 echo form_error('tgl_laporan', '<p class="text-error">', '</p>');


 ?>

<?php 
$tgl_lahir = array(
								'name'			=>	'tgl_lahir' ,
								'class'			=>	'span4',
								'required'		=>	'harap masukan data',
								'placeholder'	=>	'yy-mm-dd',
								'value'			=>	$tampil->tgl_lahir
							);

echo form_label('Tanggal Kelahiran');
echo form_input($tgl_lahir);
echo '<small class="text text-error">Contoh Pengisian Tanggal : '.date('Y-m-d').'</small>';
 echo form_error('tgl_lahir', '<p class="text-error">', '</p>');

 ?>



<?php 
$nama_bayi = array(
								'name'			=>	'nama_bayi' ,
								'class'			=>	'span4',
								'required'		=>	'harap masukan data',					
								'placeholder'	=>	'Masukan Nama Bayi',
								'value'			=>	$tampil->nama_bayi
							);

echo form_label('Nama Bayi');
echo form_input($nama_bayi);
 echo form_error('nama_bayi', '<p class="text-error">', '</p>');

 ?>

 <?php 
$tempat_lhr = array(
								'name'			=>	'tempat_lhr' ,
								'class'			=>	'span4',
								'required'		=>	'harap masukan data',					
								'placeholder'	=>	'Masukan Tempat Lahir',
								'value'			=>	$tampil->tempat_lhr
							);

echo form_label('Tempat Lahir');
echo form_input($tempat_lhr);
 echo form_error('tempat_lhr', '<p class="text-error">', '</p>');

 ?>

 <?php 
$nama_ayah = array(
								'name'			=>	'nama_ayah' ,
								'class'			=>	'span4',
								'required'		=>	'harap masukan data',					
								'placeholder'	=>	'Masukan Nama Ayah',
								'value'			=>	$tampil->nama_ayah
							);

echo form_label('Nama Ayah');
echo form_input($nama_ayah);
 echo form_error('nama_ayah', '<p class="text-error">', '</p>');

 ?>



 <?php 
$nama_ibu = array(
								'name'			=>	'nama_ibu' ,
								'class'			=>	'span4',
								'required'		=>	'harap masukan data',					
								'placeholder'	=>	'Masukan Nama Ibu',
								'value'			=>	$tampil->nama_ibu
							);

echo form_label('Nama Ibu');
echo form_input($nama_ibu);
 echo form_error('nama_ibu', '<p class="text-error">', '</p>');

 ?>


</div>











<div class="span4">
	
 <?php 
$pekerjaan_ayah = array(
								'name'			=>	'pekerjaan_ayah' ,
								'class'			=>	'span4',
								'required'		=>	'harap masukan data',					
								'placeholder'	=>	'Masukan Pekerjaan Ayah',
								'value'			=>	$tampil->pekerjaan_ayah
							);

echo form_label('Pekerjaan Ayah');
echo form_input($pekerjaan_ayah);
 echo form_error('pekerjaan_ayah', '<p class="text-error">', '</p>');

 ?>


  <?php 
$pekerjaan_ibu = array(
								'name'			=>	'pekerjaan_ibu' ,
								'class'			=>	'span4',
								'required'		=>	'harap masukan data',					
								'placeholder'	=>	'Masukan Pekerjaan Ibu',
								'value'			=>	$tampil->pekerjaan_ibu
							);

echo form_label('Pekerjaan Ibu');
echo form_input($pekerjaan_ibu);
 echo form_error('pekerjaan_ibu', '<p class="text-error">', '</p>');

 ?>

 <?php 
$alamat = array(
								'name'			=>	'alamat',
								'class'			=>	'span4',
								'required'		=>	'harap masukan data',					
								'placeholder'	=>	'Masukan Alamat',
								'rows'			=>	'3',
								'value'			=>	$tampil->alamat_dusun
							);

echo form_label('Alamat Dusun');
echo form_textarea($alamat);
 echo form_error('alamat', '<p class="text-error">', '</p>');

 ?>
 <?php 
$keterangan = array(
								'name'			=>	'keterangan',
								'class'			=>	'span4',
								'required'		=>	'harap masukan data',					
								'placeholder'	=>	'Masukan Keterangan Kelahiran',
								'rows'			=>	'3',
								'value'			=>	$tampil->keterangan
							);

echo form_label('Keterangan');
echo form_textarea($keterangan);
 echo form_error('keterangan', '<p class="text-error">', '</p>');

 ?>

</div>




<div class="span12">
	

<button type="submit" class="btn btn-primary">
	<i class="icon icon-hdd icon-white"></i>
	Simpan
</button>

<button type="reset" class="btn">
	<i class="icon  icon-refresh"></i>
	Reset
</button>




</div>






<?=form_close(); ?>








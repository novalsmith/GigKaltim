<h3 style="border-bottom:dashed 1px #AAB2BD">Tambah Kelahiran Baru
<small>
<a href="<?=base_url().'kelahiran'  ?>" title="" class="btn btn-info pull-right">
<i class="icon  icon-arrow-left icon-white"></i> Kembali</a>
</small>
</h3>

<?=form_open('kelahiran/proses_tambah'); ?>


<div class="span4">
<?=form_hidden('id_kelahiran'); ?>

<?= 'Nomor Registrasi'  ?>
<?php if ($tampil->id_kelahiran ==''){ ?>


	<input type="hidden" name="nomor_registrasi" 
class="span3"
 placeholder="Nomor Registrasi" value="<?='474/1/4416.317.4/'.date('Y') ?>" >
 <h4 class="well"><?='474/1/4416.317.4/'.date('Y') ?></h4>
<?= form_error('nomor_registrasi', '<p class="text-error">', '</p>');
 ?>
	
	<?php }else{ ?>

<input type="hidden" name="nomor_registrasi" 
class="span3"
 placeholder="Nomor Registrasi" value="<?='474/'.$tampil->id_kelahiran.'/416.317.4'.'/'.date('Y') ?>">
<h4 class="well"><?='474/'.$tampil->id_kelahiran.'/416.317.4'.'/'.date('Y') ?></h4>

<?= form_error('nomor_registrasi', '<p class="text-error">', '</p>');
 ?>



<?php } ?>


<?=form_label('Nomor KK');  ?>

 		<select name="nomor_kk" class="span3" required>

<?php if ($join->num_rows()	 == ''){ ?>
<option value="" selected="selected">Maaf Data kosong</option>
<option value="" >Silahkan Mengisi data Penduduk terlebih dahulu</option>

 	<p class="text text-error"></p>
 <?php }else{ ?>
 		<option value="">Pilih Nomor KK Penduduk</option>
<?php foreach ($join->result() as $key){ ?>

		<option value="<?=$key->id_nomor_kk ?>"><?=$key->nomor_kk ?></option>
			
<?php } ?>
 <?php } ?> 
 </select>



<?php 
$tgl_laporan = array(
								'name'			=>	'tgl_laporan' ,
								'class'			=>	'span4',
								'required'		=>	'harap masukan data',
													
								'placeholder'	=>	'yy-mm-dd'
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
													
						'placeholder'	=>	'yy-mm-dd'
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
								'placeholder'	=>	'Masukan Nama Bayi'
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
								'placeholder'	=>	'Masukan Tempat Lahir'
							);

echo form_label('Tempat Lahir');
echo form_input($tempat_lhr);
 echo form_error('tempat_lhr', '<p class="text-error">', '</p>');

 ?>

 




</div>





<div class="span3">
	

<?php
echo form_label('Nama Ayah');
?>


 		<select name="nama_ayah" class="span3" required>

<?php if ($join_p->num_rows()	 == ''){ ?>
<option value="" selected="selected">Maaf Data kosong</option>
<option value="" >Silahkan Mengisi data Penduduk terlebih dahulu</option>

 	<p class="text text-error"></p>
 <?php }else{ ?>
 		<option value="">Pilih Nama Ayah</option>
<?php foreach ($join_p->result() as $key){ ?>

		<option value="<?=$key->ayah ?>"><?=$key->ayah ?></option>
			
<?php } ?>
 <?php } ?> 
 </select>

<?php
 echo form_error('nama_ayah', '<p class="text-error">', '</p>');

 ?>

<?php
echo form_label('Nama Ibu');
?>


 		<select name="nama_ibu" class="span3" required>

<?php if ($join_p->num_rows()	 == ''){ ?>
<option value="" selected="selected">Maaf Data kosong</option>
<option value="" >Silahkan Mengisi data Penduduk terlebih dahulu</option>

 	<p class="text text-error"></p>
 <?php }else{ ?>
 		<option value="">Pilih Nama Ibu</option>
<?php foreach ($join_p->result() as $key){ ?>

		<option value="<?=$key->ibu ?>"><?=$key->ibu ?></option>
			
<?php } ?>
 <?php } ?> 
 </select>

<?php
 echo form_error('nama_ibu', '<p class="text-error">', '</p>');

 ?>



<?php
echo form_label('Pekerjaan Ayah');
?>


 		<select name="pekerjaan_ayah" class="span3" required>

<?php if ($p_ayah->num_rows()	 == ''){ ?>
<option value="" selected="selected">Maaf Data kosong</option>
<option value="" >Silahkan Mengisi data Penduduk terlebih dahulu</option>

 	<p class="text text-error"></p>
 <?php }else{ ?>
 		<option value="">Pilih Pekerjaan Ayah</option>
<?php foreach ($p_ayah->result() as $key){ ?>

		<option value="<?=$key->pekerjaan ?>"><?=$key->pekerjaan ?></option>
			
<?php } ?>
 <?php } ?> 
 </select>

<?php
 echo form_error('pekerjaan_ayah', '<p class="text-error">', '</p>');

 ?>


 <?php
echo form_label('Pekerjaan Ibu');
?>


 		<select name="pekerjaan_ibu" class="span3" required>

<?php if ($p_ibu->num_rows()	 == ''){ ?>
<option value="" selected="selected">Maaf Data kosong</option>
<option value="" >Silahkan Mengisi data Penduduk terlebih dahulu</option>

 	<p class="text text-error"></p>
 <?php }else{ ?>
 		<option value="">Pilih Pekerjaan Ibu</option>
<?php foreach ($p_ibu->result() as $key){ ?>

		<option value="<?=$key->pekerjaan ?>"><?=$key->pekerjaan ?></option>
			
<?php } ?>
 <?php } ?> 
 </select>

<?php
 echo form_error('pekerjaan_ibu', '<p class="text-error">', '</p>');

 ?>



 <?php 
$alamat = array(
								'name'			=>	'alamat',
								'class'			=>	'span4',
								'required'		=>	'harap masukan data',					
								'placeholder'	=>	'Masukan Alamat',
								'rows'			=>	'3'
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
								'rows'			=>	'3'
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








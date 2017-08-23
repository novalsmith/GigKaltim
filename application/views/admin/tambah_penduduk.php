<h3 style="border-bottom:dashed 1px #AAB2BD">Tambah Penduduk Baru
<small>
<a href="<?=base_url().'penduduk'  ?>" title="" class="btn btn-info pull-right">
<i class="icon  icon-arrow-left icon-white"></i> Kembali</a>
</small>
</h3>

<form action="<?=base_url().'penduduk/proses_tambah_penduduk'  ?>" method="post" accept-charset="utf-8">
	
	




	<?=$this->session->flashdata('message');  ?>

<div class="span3 " style="font-weight: bold;">

<?=form_label('Nomor Penduduk'); ?>

<?php if ($tampil_nomor == ''){ ?>
 	<p class="text text-error">Maaf Data Nomor Penduduk Kosong</p>
 <?php }else{ ?>
 		<select name="id_nomor_kk" class="span3" required>
 		<option value="">Pilih Nomor KK Penduduk</option>
<?php foreach ($tampil_nomor->result() as $key){ ?>

		<option value="<?=$key->id_nomor_kk ?>"><?=$key->nomor_kk ?></option>
			
<?php } ?>
</select>
 <?php } ?> 



<?php

$nik = array(
			'name' 		=> 'nik',
			'class'		=> 'span3',
		
			'placeholder' => ' Masukan NIK Penduduk',
			'required'  => 'masukan');

echo form_label('NIK');
echo form_input($nik);
 echo form_error('nik', '<p class="text-error">', '</p>');
 ?>



<?php

$nama = array(
			'name' 		=> 'nama',
			'class'		=> 'span3',
		
			'placeholder' => ' Masukan Nama Penduduk',
			'required'  => 'masukan');

echo form_label('Nama Penduduk');
echo form_input($nama);
 echo form_error('nama', '<p class="text-error">', '</p>');
 ?>


<?php

$gol_darah = array(
			'name' 		=> 'gol_darah',
			'class'		=> 'span3',
		
			'placeholder' => ' Masukan Gol. Darah Penduduk',
			'required'  => 'masukan');

echo form_label('Golongan Darah Penduduk');
echo form_input($gol_darah);
 echo form_error('gol_darah', '<p class="text-error">', '</p>');
 ?>



<?= form_label('Status Harian dalam Rumah Tangga'); ?>
<select name="shdrt" class="span3" required>
	
	<option value=""> Pilih Status HDRT </option>
<option value="Kepala Keluarga">Kepala Keluarga</option>
<option value="Istri">Istri</option>
<option value="Anak">Anak</option>

</select>



</div>


<div class="span4 " style="font-weight: bold;">
	

<?php

$pendidikan = array(
			'name' 		=> 'pendidikan',
			'class'		=> 'span4',
		
			'placeholder' => ' Masukan Jenjang Pendidikan ',
			'required'  => 'masukan');

echo form_label('Pendidikan');
echo form_input($pendidikan);
 echo form_error('pendidikan', '<p class="text-error">', '</p>');
 ?>


<?=form_label('Jenis Kelamin'); ?>
<select name="jk" class="span4" required>
	<option value="">Pilih Jenis Kelamin Penduduk</option>
	<option value="laki-laki">Laki-Laki</option>
	<option value="perempuan">Perempuan</option>

</select>





<?=form_label('Agama'); ?>
<select name="agama" class="span4" required>
	<option value="">Pilih Agama Penduduk</option>
	<option value="Kristen">Kristen</option>
	<option value="Islam">Islam</option>
		<option value="Hindu">Hindu</option>
	<option value="Budha">Budha</option>

</select>


<?=form_label('Status Perkawinan'); ?>
<select name="status_perkawinan" class="span4" required>
	<option value="">Pilih Status Perkawinan Penduduk</option>
	<option value="Kawin">Kawin</option>
	<option value="Belum">Belum Kawin</option>


</select>




<div class="span1">
	


<?=form_label('RT'); ?>
<select name="rt"  required class="span1">
	<option value=""></option>
	
	<?php 
	for ($i=1; $i < 10 ; $i++) { 
		?>
<option value="<?='00'.$i ?>"><?='00'.$i  ?></option>
		<?php
	}
	 ?>


</select>
</div>
<div class="span1">
	

<?=form_label('RW'); ?>
<select name="rw"  required class="span1">
	<option value=""></option>
	
	<?php 
	for ($i=1; $i < 10 ; $i++) { 
		?>
<option value="<?='00'.$i ?>"><?='00'.$i  ?></option>
		<?php
	}
	 ?>


</select>


</div>

</div>

<div class="span4 " style="font-weight: bold;">
<?php

$pekerjaan = array(
			'name' 		=> 'pekerjaan',
			'class'		=> 'span3',
		
			'placeholder' => ' Masukan Jenis Pekerjaan Pendidikan ',
			'required'  => 'masukan');

echo form_label('Pekerjaan');
echo form_input($pekerjaan);
 echo form_error('pekerjaan', '<p class="text-error">', '</p>');
 ?>

 <?php

$ibu = array(
			'name' 		=> 'ibu',
			'class'		=> 'span3',
		
			'placeholder' => 'Masukan Nama Ibu ',
			'required'  => 'masukan');

echo form_label('IBU');
echo form_input($ibu);
 echo form_error('ibu', '<p class="text-error">', '</p>');
 ?>

 <?php

$ayah = array(
			'name' 		=> 'ayah',
			'class'		=> 'span3',
		
			'placeholder' => ' Masukan Nama Ayah ',
			'required'  => 'masukan');

echo form_label('Ayah');
echo form_input($ayah);
 echo form_error('ayah', '<p class="text-error">', '</p>');
 ?>
<br>



 <?php

$desa = array(
			'name' 		=> 'desa',
			'class'		=> 'span3',
		
			'placeholder' => ' Masukan Desa Penduduk ',
			'required'  => 'masukan');

echo form_label('Desa');
echo form_input($desa);
 echo form_error('desa', '<p class="text-error">', '</p>');
 ?>

 <?php

$kecamatan = array(
			'name' 		=> 'kecamatan',
			'class'		=> 'span3',
		
			'placeholder' => ' Masukan Kecamatan ',
			'required'  => 'masukan');

echo form_label('Kecamatan');
echo form_input($kecamatan);
 echo form_error('kecamatan', '<p class="text-error">', '</p>');
 ?>


 <?=form_label('Kewarga Negaraan'); ?>
<select name="wn" class="span3" required>
	<option value="">Pilih Kewarga Negaraan Penduduk</option>
	<option value="Wni">WNI</option>
	<option value="Wna">WNA</option>


</select>


</div>

<div class="span4 ">
</div>


<div class="span4 ">
	

<button type="submit" class="btn btn-primary btn-medium"><i class="icon icon-white icon-hdd"></i> Simpan</button>
<button type="reset" class="btn btn-default btn-medium"><i class="icon icon-refresh"></i> Bersihkan Form</button>

</div>

<div class="span4 ">
</div>




</form>











<h3 style="border-bottom:dashed 1px #AAB2BD">Edit Data Penduduk 
<small>
<a href="<?=base_url().'penduduk'  ?>" title="" class="btn btn-info pull-right">
<i class="icon  icon-arrow-left icon-white"></i> Kembali</a>
</small>
</h3>

<form action="<?=base_url().'penduduk/proses_edit_penduduk' ?>" method="post" accept-charset="utf-8">
	
	




	<?=$this->session->flashdata('message');  ?>

<div class="span3 " style="font-weight: bold;">

<?=form_label('Nomor Penduduk'); ?>

<?php if ($tampil_nomor == ''){ ?>
 	<p class="text text-error">Maaf Data Nomor Penduduk Kosong</p>
 <?php }else{ ?>
 		<select name="id_nomor_kk" class="span3" required>
<?php foreach ($tampil_nomor->result() as $key){ ?>

		<option
		<?php if ($edit->id_nomor_kk == $key->id_nomor_kk){ ?>
			selected="selected" 
		<?php } ?>

		 value="<?=$key->id_nomor_kk ?>"><?=$key->nomor_kk ?></option>
			
<?php } ?>
</select>
 <?php } ?> 



<?php

$nik = array(
			'name' 		=> 'nik',
			'class'		=> 'span3',
		
			'placeholder' => ' Masukan NIK Penduduk',
			'value'		=>	$edit->nik,
			'required'  => 'masukan');

echo form_label('NIK');
echo form_input($nik);
echo form_hidden('id', $edit->id_penduduk);
 echo form_error('nik', '<p class="text-error">', '</p>');
 ?>



<?php

$nama = array(
			'name' 		=> 'nama',
			'class'		=> 'span3',
		'value'		=>	$edit->nama,
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
		'value'		=>	$edit->gol_darah,
			'placeholder' => ' Masukan Gol. Darah Penduduk',
			'required'  => 'masukan');

echo form_label('Golongan Darah Penduduk');
echo form_input($gol_darah);
 echo form_error('gol_darah', '<p class="text-error">', '</p>');
 ?>





<?php

$shdrt = array(
			'name' 		=> 'shdrt',
			'class'		=> 'span3',
		'value'		=>	$edit->status_hdrt,
			'placeholder' => ' Masukan Status HDRT',
			'required'  => 'masukan');

echo form_label('Status Harian dalam Rumah Tangga');
echo form_input($shdrt);
 echo form_error('shdrt', '<p class="text-error">', '</p>');
 ?>


<div class="span1">
	


<?=form_label('RT'); ?>
<select name="rt"  required class="span1">
		<option		selected="selected"  value="<?=$edit->rt ?>"><?=$edit->rt ?></option>

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

	<option		selected="selected"  value="<?=$edit->rw ?>"><?=$edit->rw ?></option>

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

$pendidikan = array(
			'name' 		=> 'pendidikan',
			'class'		=> 'span4',
		'value'		=>	$edit->pendidikan,
			'placeholder' => ' Masukan Jenjang Pendidikan ',
			'required'  => 'masukan');

echo form_label('Pendidikan');
echo form_input($pendidikan);
 echo form_error('pendidikan', '<p class="text-error">', '</p>');
 ?>


<?=form_label('Jenis Kelamin'); ?>
<select name="jk" class="span4" required>
	<option		selected="selected"  value="<?=$edit->jenis_kelamin ?>"><?=$edit->jenis_kelamin ?></option>


	<option  value="laki-laki">Laki-Laki</option>
	<option value="perempuan">Perempuan</option>

</select>





<?=form_label('Agama'); ?>
<select name="agama" class="span4" required>
		<option		selected="selected"  value="<?=$edit->agama ?>"><?=$edit->agama ?></option>

	<option value="Kristen">Kristen</option>
	<option value="Islam">Islam</option>
		<option value="Hindu">Hindu</option>
	<option value="Budha">Budha</option>

</select>


<?=form_label('Status Perkawinan'); ?>
<select name="status_perkawinan" class="span4" required>
	<option		selected="selected"  value="<?=$edit->status_pernikahan ?>"><?=$edit->status_pernikahan ?></option>
	<option value="Kawin">Kawin</option>
	<option value="Belum">Belum Kawin</option>


</select>



</div>

<div class="span4 " style="font-weight: bold;">
<?php

$pekerjaan = array(
			'name' 		=> 'pekerjaan',
			'class'		=> 'span3',
		'value'		=>	$edit->pekerjaan,
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
		'value'		=>	$edit->ibu,
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
		'value'		=>	$edit->ayah,
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
		'value'		=>	$edit->desa,
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
		'value'		=>	$edit->kecamatan,
			'placeholder' => ' Masukan Kecamatan ',
			'required'  => 'masukan');

echo form_label('Kecamatan');
echo form_input($kecamatan);
 echo form_error('kecamatan', '<p class="text-error">', '</p>');
 ?>


 <?=form_label('Kewarga Negaraan'); ?>
<select name="wn" class="span3" required>
	<option		selected="selected"  value="<?=$edit->k_negaraan ?>"><?=$edit->k_negaraan ?></option>

	<option value="WNI">WNI</option>
	<option value="WNA">WNA</option>


</select>

</div>

<div class="span4 ">
</div>


<div class="span4 ">
	
<button type="submit" class="btn btn-primary btn-medium"><i class="icon icon-white icon-hdd"></i> Simpan</button>

</div>

<div class="span4 ">
</div>




</form>











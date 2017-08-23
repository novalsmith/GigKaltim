<h3 style="border-bottom:dashed 1px #AAB2BD">Tambah Alumni Baru
<small>
<a href="<?=base_url().'alumni'  ?>"  class="btn btn-primary btn-small pull-right tip"
data-placement="top" title="Klik disini untuk Kembali ke daftar Alumni" data-toggle="tooltip">
<i class="icon  icon-arrow-left icon-white"></i> Kembali</a>
</small>
</h3>


	
   <?php 

	

            $data = array(
              'name'    =>  'tambah',
              'class'   =>  'form-signin',
              'method'  =>  'POST',
              'enctype' =>  'multipart/form-data'

              ); 

            echo   form_open('alumni/proses_tambah_alumni', $data);
            ?>


<?php echo $this->session->flashdata('message');   ?>

<div class="span4 " style="font-weight: bold;">


<?=form_label('Nomor Anggota Alumni'); ?>
<select name="id_anggota" class="form-control span4 tip"
required
data-toggle="tooltip" 
data-placement="right" 
title="Pilih Salah satu Untuk Menentukan Nomor dan Nama Alumni">

  <option value="">--Pilih Nomor Anggota Alumni--</option>
 <?php 
if ($tampil=='') {
  ?>
  <option value="">--Maaf Data Alumni Kosong--</option>

  <?php
}else{
?>

<?php foreach ($tampil->result() as $tampil): ?>
    <option value="<?=$tampil->id_anggota ?>"><?=$tampil->no_anggota.' - '.$tampil->nama_lengkap ?></option>

<?php endforeach ?>



<?php
}

  ?>



</select>
 <?php  echo form_error('no_anggota', '<p class="text-error">', '</p>'); ?>




 <?=form_label('Tahun Lulus'); ?>
<select name="lulus" class="span4 tip" required title="Silahkan Memilih Tahun Lulus Anggota" data-placement="right">
  <option value="">Pilih Tahun Lulus</option>

<?php 
for ($i=2001; $i <= 2090 ; $i++) { 
  ?>
  <option value="<?php echo  $i ?>"><?php echo $i ?></option>
  <?php
}
 ?>



</select>

<?php  echo form_error('lulus', '<p class="text-error">', '</p>');
 ?>


<?php

$gelar = array(
			'name' 		=> 'gelar',
			'class'		=> 'span4 tip',
		  'type'		=>	'text',

		      'data-toggle'   =>  'tooltip',
              'data-placement'  =>  'right',
              'title'         =>  '*Harap Memasukan Gelar yang Valid',
			'placeholder' => ' Masukan Gelar',
			'required'  => 'masukan');

echo form_label('Gelar');
echo form_input($gelar);
echo form_label('<p class="text text-info">*Penulisan Gelar Harus yang valid dan benar</p>');

 echo form_error('gelar', '<p class="text-error">', '</p>');
 ?>


<?=form_label('Cumlaude'); ?>
<select name="cumlaude" class="form-control span4 tip"
required
data-toggle="tooltip" 
data-placement="right" 
title="Pilih Salah satu Untuk Menentukan Gelar Anggota">

  <option value="">--Pilih Status Cumlaude Anggota--</option>
  <option value="cumlaude">cumlaude</option>
  <option value="tidak">tidak</option>

</select>
 <?php  echo form_error('cumlaude', '<p class="text-error">', '</p>'); ?>


          <button type="submit" class="btn btn-primary btn-medium"><i class="icon icon-white icon-hdd"></i> Simpan</button>
<button type="reset" class="btn btn-default btn-medium"><i class="icon icon-refresh"></i> Bersihkan Form</button>


</div>



<?=form_close() ?>











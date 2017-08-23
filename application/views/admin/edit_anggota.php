<h3 style="border-bottom:dashed 1px #AAB2BD">Tambah Anggota Baru
<small>
<a href="<?=base_url().'anggota'  ?>"  class="btn btn-primary btn-small pull-right tip"
data-placement="top" title="Kembali Untuk Melihat Daftar Anggota" data-toggle="tooltip">
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

            echo   form_open('anggota/proses_update_anggota', $data);
            ?>





<?php echo $this->session->flashdata('message');   ?>



<div class="span3 " style="font-weight: bold;">

<!--nomor anggota-->


<?php

$no_anggota = array(
			'name' 					=> 'no_anggota',
			'class'					=> 'span3 tip',
		
		      'data-toggle'   		=>  'tooltip',
              'data-placement'  	=>  'right',
              'title'         		=>  '*Masukan Sesuai dengan format : tahun.kode-aplikasi.nomor-aplikasi.nomor-urut',
			'placeholder' 			=> ' Masukan Nama Panggilan',
			'value'					=>	$edit->no_anggota,
			'required'  			=> 'masukan');

echo form_label('Nomor Anggota');
echo form_input($no_anggota);
echo form_label('<p class="text text-error">Format diatas dilarang untuk mengubah.
 * Tahun Angkatan.kode-aplikasi.nomor-aplikasi.nomor-urut. <i>Jika Nomor Anggota tidak di ubah Kosongkan saja</i></p>');
 echo form_error('no_anggota', '<p class="text-error">', '</p>');
 ?>






<?php

$nama_panggilan = array(
			'name' 					=> 'nama_panggilan',
			'class'					=> 'span3 tip',
		
		      'data-toggle'   		=>  'tooltip',
              'data-placement'  	=>  'right',
              'title'         		=>  'Silahkan Memasukan Nama Panggilan Anggota',
			'placeholder' 			=> ' Masukan Nama Panggilan',
			'value'					=>	$edit->nama_panggilan,
			'required'  			=> 'masukan');

echo form_label('Nama Panggilan');
echo form_input($nama_panggilan);
 echo form_error('nama_panggilan', '<p class="text-error">', '</p>');
 ?>



<?php

$nama_lengkap = array(
			'name' 					=> 'nama_lengkap',
			'class'					=> 'span3 tip',
			'value'					=>	$edit->nama_lengkap,
		      'data-toggle'   		=>  'tooltip',
              'data-placement'  	=>  'right',
              'title'         		=>  'Silahkan Memasukan Nama Lengkap Anggota',
		
			'placeholder' 			=> ' Masukan Nama Lengkap',
			'required'  			=> 'masukan');

echo form_label('Nama Lengkap');
echo form_input($nama_lengkap);
 echo form_error('nama_lengkap', '<p class="text-error">', '</p>');
 ?>


<?=form_label('Kota Asal Anggota'); ?>
<select name="kota_asal" class="form-control span3 tip"
required
data-toggle="tooltip" 
data-placement="right" 
title="Pilih Salah satu Untuk Menentukan Kota Asal Anggota">

  <option value="">--Pilih Kota Asal Anggota--</option>

  <option value="<?=$edit->kota_asal  ?>" selected="selected"><?=$edit->kota_asal  ?></option>

  <option value="sorong">sorong</option>
  <option value="manokwari">manokwari</option>
  <option value="biak">biak</option>
  <option value="serui">serui</option>
  <option value="jayapura">jayapura</option>
  <option value="wamena">wamena</option>
  <option value="timika">timika</option>



</select>
 <?php  echo form_error('kota_asal', '<p class="text-error">', '</p>'); ?>

<?php

$email = array(
			'name' 					=> 'email',
			'class'					=> 'span3 tip',
		  'type'					=>	'email',
			'value'					=>	$edit->email,

		      'data-toggle'   		=>  'tooltip',
              'data-placement'  	=>  'right',
              'title'         		=>  '*Harap Memasukan Email yang aktif',
			'placeholder'		    => ' Masukan Email',
			'required'  			=> 'masukan');

echo form_label('Email');
echo form_input($email);
echo form_label('<p class="text text-info">*Harap Gunakan Email yang Sedang Aktif</p>');

 echo form_error('email', '<p class="text-error">', '</p>');
 ?>



<?php

$tlp = array(
			'name' 		=> 'tlp',
			'class'		=> 'span3 tip',
		    'type'		=>	'text',
			'value'					=>	$edit->tlp,

		      'data-toggle'   =>  'tooltip',
              'data-placement'  =>  'right',
              'title'         =>  'Silahkan Memasukan Nomor Telepon (Hp) Anggota',
			'placeholder' => ' Masukan Nomor Telepon',
			'required'  => 'masukan');

echo form_label('Telepon');
echo form_input($tlp);
 echo form_error('tlp', '<p class="text-error">', '</p>');
 ?>


<?=form_label('Agama'); ?>
<select name="agama" class="form-control span3 tip"
required
data-toggle="tooltip" 
data-placement="right" 
title="Pilih Salah satu Untuk Menentukan Agama Anggota">

  <option value="">--Pilih Agama Anggota--</option>
    <option value="<?=$edit->agama  ?>" selected="selected"><?=$edit->agama  ?></option>

  <option value="kristen">kristen</option>
  <option value="islam">islam</option>
  <option value="hindu">hindu</option>
  <option value="budha">budha</option>



</select>
 <?php  echo form_error('agama', '<p class="text-error">', '</p>'); ?>


</div>


<div class="span4 " style="font-weight: bold;">


<?=form_label('Asal Kampus'); ?>
<select name="kampus" class="form-control span3 tip"
required
data-toggle="tooltip" 
data-placement="right" 
title="Pilih Salah satu Untuk Menentukan Asal Kampus Anggota">

  <option value="">--Pilih Kampus Anggota--</option>
    <option value="<?=$edit->kampus  ?>" selected="selected"><?=$edit->kampus  ?></option>

  <option value="unitomo">unitomo</option>
  <option value="untag">untag</option>
  <option value="itats">itats</option>
  <option value="unair">unair</option>
  <option value="widia_mandala">widia_mandala</option>
  <option value="widia_kusuma">widia_kusuma</option>
  <option value="uph">uph</option>
  <option value="petra">petra</option>
  <option value="stie_abi">stie abi</option>
  <option value="stikom">stikom</option>
  <option value="upn">upn</option>
  <option value="unesa">unesa</option>
  <option value="ubaya">ubaya</option>


 
</select>
 <?php  echo form_error('kampus', '<p class="text-error">', '</p>'); ?>


 <?php

$jurusan = array(
			'name' 		=> 'jurusan',
			'class'		=> 'span4 tip',
			'value'					=>	$edit->jurusan,

              'data-toggle'   =>  'tooltip',
              'data-placement'  =>  'right',
              'title'         =>  'Silahkan Memasukan Jurusan Pada Kampus Anggota',
			'placeholder' => 'Masukan Jurusan ',
			'required'  => 'masukan');

echo form_label('Jurusan');
echo form_input($jurusan);
 echo form_error('jurusan', '<p class="text-error">', '</p>');
 ?>





 <?=form_label('Angkatan'); ?>
<select name="angkatan" class="span4 tip" required title="Silahkan Memilih Tahun Angkatan Anggota" data-placement="right">
	<option value="">Pilih Tahun Angkatan</option>
    <option value="<?=$edit->angkatan  ?>" selected="selected"><?=$edit->angkatan  ?></option>

<?php 
for ($i=2001; $i <= 2090 ; $i++) { 
	?>
	<option value="<?php echo  $i ?>"><?php echo $i ?></option>
	<?php
}
 ?>



</select>

<?php 
echo form_label("<p class='text text-error'>Tahun Angkatan Harus Sesuai dengan Tahun angkatan yang ada pada <b>Nomor Anggota</b></p>");
 echo form_error('angkatan', '<p class="text-error">', '</p>');
 ?>



<?php 
         $gambar    = array(
              'name'          			=> 'imagefile',
              'class'         			=>  'form-control span3 tip',
               'type'       			=>  'file',
              'value'					=>	$edit->jurusan,

              'data-toggle'   			=>  'tooltip',
              'data-placement'  		=>  'right',
              'title'         			=>  'Silahkan Kosongkan Foto Jika Foto Tidak Di Ubah'
             );
            echo form_label('Masukan Gambar');
            echo form_input($gambar);
            echo img('asset/upload/anggota/gambarkecil/'.$edit->gambar_kecil);
          echo form_label('<p class="text-error">*Silahkan Kosongkan Foto Jika Foto tidak di Ubah.</p>'); 
          echo form_label('<p class="text-info">*Foto Anggota di anjurkan 3x4 / 4x6.</p>'); 

            echo form_hidden('waktu',namahari($nohari).' '.$tgl.' '.namabulan($bln).' '.$thn);
            echo form_error('imagefile', '<p class="text-error">', '</p>');
           echo form_hidden('id_anggota',$edit->id_anggota);
              echo form_hidden('g_besar',$edit->gambar_besar);
              echo form_hidden('g_kecil',$edit->gambar_kecil);
          ?>


<?=form_label('<strong class="text-info">Status Anggota</strong>'); ?>
<select name="status" class="form-control span4 tip"
required
data-toggle="tooltip" 
data-placement="right" 
title="Pilih Salah satu Untuk Menentukan Status Anggota">

  <option value="">--Pilih Status Anggota--</option>
      <option value="<?=$edit->status  ?>" selected="selected"><?=$edit->status  ?></option>

  <option value="aktif">aktif</option>
  <option value="tidak">tidak</option>



</select>
 <?php  echo form_error('status', '<p class="text-error">', '</p>'); ?>
 <?php echo br().br(); ?>










          <button type="submit" class="btn btn-primary btn-medium"><i class="icon icon-white icon-hdd"></i> Simpan</button>
<button type="reset" class="btn btn-default btn-medium"><i class="icon icon-refresh"></i> Bersihkan Form</button>

</div>

<div class="span4 " style="font-weight: bold;">
	

<?php



echo form_label('Alamat Tempat Tinggal ');
echo form_textarea('alamat_kelurahan',$edit->alamat_kelurahan);
 echo form_error('alamat_kelurahan', '<p class="text-error">', '</p>');
 ?>



</div>







<?=form_close() ?>











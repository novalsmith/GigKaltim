<h3 style="border-bottom:dashed 1px #AAB2BD">Edit Kerajinan Khas 
<small>
<a href="<?=base_url().'kerajinan'  ?>"  class="btn btn-primary btn-small pull-right tip"
data-placement="top" title="Kembali Untuk Melihat Daftar Tempat Kerajinan Khas" data-toggle="tooltip">
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

            echo   form_open('kerajinan/proses_update_kerajinan', $data);
            ?>





<?php echo $this->session->flashdata('message');   ?>



<div class="span4 " style="font-weight: bold;">

 <?=form_label('Tempat Wisata'); ?>
<select name="judulberita" class="form-control span4 tip"
required
data-toggle="tooltip" 
data-placement="top" 
title="Pilih Tempat Wisata yang memiliki informasi Hotel ini">

<option value="">--Pilih Tempat Wisata--</option>

  <?php 

            if (!empty($berita)) {
              ?>



                <?php 

                    foreach ($berita->result() as $key) {
                      ?>


                  <option 


                  <?php if ($key->idberita == $edit->idberita){ ?>
                    selected="selected"
                  <?php }?>


                  value="<?=$key->idberita  ?>"><?=$key->judulberita ?></option>
              
                      

                      <?php
                    }
                 ?>




<?php
    } 

    else
    {
      ?>
         <option value="">--Maaf Tempat Wisata Kosong--</option>
    <?php
    }
           echo form_error('idberita', '<p class="text-danger">', '</p>');

  ?>


</select>


<?php

$nama_kerajinan = array(
			'name' 		=> 'nama_kerajinan',
			'class'		=> 'span4 tip',
		
		      'data-toggle'   =>  'tooltip',
              'data-placement'  =>  'right',
              'title'         =>  'Silahkan Memasukan Nama Kerajinan Khas yang ada di tempat wisata',
			'placeholder' => ' Masukan Nama Kerajinan Khas',
      'value'       => $edit->nama_kerajinan,
			'required'  => 'masukan');

echo form_label('Nama Kerajinan Khas');
echo form_input($nama_kerajinan);
 echo form_error('nama_kerajinan', '<p class="text-error">', '</p>');
 ?>

<?php

$latitude = array(
      'name'    => 'latitude',
      'class'   => 'span4 tip',
    
          'data-toggle'   =>  'tooltip',
              'data-placement'  =>  'right',
              'title'         =>  'Silahkan Memasukan Latitude Kordinat - X tempat wisata',
      'placeholder' => ' Masukan Latitude',
       'value'       => $edit->lat_kerajinan,
      'required'  => 'masukan');

echo form_label('Latitude -X');
echo form_input($latitude);
 echo form_error('latitude', '<p class="text-error">', '</p>');
 ?>
<?php

$longitude = array(
      'name'    => 'longitude',
      'class'   => 'span4 tip',
    
          'data-toggle'   =>  'tooltip',
              'data-placement'  =>  'right',
              'title'         =>  'Silahkan Memasukan Latitude Kordinat - Y tempat wisata',
      'placeholder' => ' Masukan Longitude',
       'value'       => $edit->long_kerajinan,
      'required'  => 'masukan');

echo form_label('Longitude -Y');
echo form_input($longitude);
 echo form_error('longitude', '<p class="text-error">', '</p>');
 ?>



<?php 
         $gambar    = array(
              'name'          => 'imagefile',
              'class'         =>  'form-control span4 tip',
               'type'       =>  'file',
              'data-toggle'   =>  'tooltip',
              'data-placement'  =>  'right',
              'title'         =>  'Silahkan Memilih Sala-satu Gambar Hotel'
             );
            echo form_label('Masukan Gambar');
            echo form_input($gambar);

            echo form_hidden('waktu',namahari($nohari).' '.$tgl.' '.namabulan($bln).' '.$thn);
             echo form_hidden('id_kerajinan',$edit->id_kerajinan);
            echo img('asset/upload/kerajinan/gambarkecil/'.$edit->gambar_kecil_k);
              echo form_hidden('g_besar', $edit->gambar_besar_k);
              echo form_hidden('g_kecil', $edit->gambar_kecil_k);
            echo form_error('imagefile', '<p class="text-error">', '</p>');
echo br().br();
          ?>



           <button type="submit" class="btn btn-primary btn-medium"><i class="icon icon-white icon-hdd"></i> Simpan</button>
<button type="reset" class="btn btn-default btn-medium"><i class="icon icon-refresh"></i> Bersihkan Form</button>

</div>




<div class="span6 " style="font-weight: bold;">
	

<?php



echo form_label('Keterangan Hotel ');
echo form_textarea('ket_kerajinan',$edit->ket_kerajinan);
 echo form_error('ket_kerajinan', '<p class="text-error">', '</p>');
 ?>



</div>







<?=form_close() ?>










